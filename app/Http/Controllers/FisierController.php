<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fisier;
use Illuminate\Support\Facades\Storage;

class FisierController extends Controller
{
    /**
     * A mapping of owner aliases to fully qualified model classes.
     * You can move this to a config file if you prefer.
     */
    protected $ownerMap = [
        'proiect' => \App\Models\Proiect::class,
        'user'    => \App\Models\User::class,
        // add more mappings as needed
    ];

    /**
     * Store newly uploaded files for a given owner.
     *
     * Expects the request to have 'owner_type' and 'owner_id'.
     */
    public function store(Request $request)
    {
        // Validate the files and also require owner info.
        $request->validate([
            'owner_type' => 'required|string',
            'owner_id'   => 'required|integer',
            'fisiere'      => 'required',
            'fisiere.*'    => 'required|file|max:10000', // adjust types/sizes as needed
        ]);

        // Resolve the owner model
        $owner = $this->resolveOwner($request->input('owner_type'), $request->input('owner_id'));

        if ($request->hasFile('fisiere')) {
            $map = [
                'Proiect' => 'proiecte',
                // Add other models and their plural forms as needed
            ];
            $base = class_basename($owner);

            foreach ($request->file('fisiere') as $uploadedFile) {
                $ownerFolder = $map[$base] ?? strtolower($base);
                $directory = "fisiere/{$ownerFolder}/{$owner->id}";
                $path = $uploadedFile->store($directory, 'public');

                // Attach the file via the polymorphic relationship.
                $owner->fisiere()->create([
                    'cale_fisier' => $path,
                    'nume_fisier' => $uploadedFile->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Fișierele au fost încărcate cu succes!');
    }

    /**
     * Remove the specified file.
     */
    public function destroy(Request $request, Fisier $fisier)
    {
        // Remove the physical file from storage.
        Storage::disk('public')->delete($fisier->cale_fisier);

        // Delete the database record.
        $fisier->delete();

        return redirect()->back()->with('success', 'Fișierul a fost șters cu succes!');
    }

    /**
     * Resolve the owner model instance from an alias and ID.
     *
     * @param string $ownerTypeAlias
     * @param int $ownerId
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function resolveOwner(string $ownerTypeAlias, int $ownerId)
    {
        if (!array_key_exists($ownerTypeAlias, $this->ownerMap)) {
            abort(404, 'Tip de resursă necunoscut');
        }

        $ownerClass = $this->ownerMap[$ownerTypeAlias];

        return $ownerClass::findOrFail($ownerId);
    }

    public function manage(Request $request)
    {
        $request->session()->get('returnUrl') ?: $request->session()->put('returnUrl', url()->previous());

        $ownerType = $request->input('owner_type');
        $owner = $this->resolveOwner($request->input('owner_type'), $request->input('owner_id'));
        $fisiere = $owner->fisiere()->latest()->get();

        // Return the view that combines file list and upload form
        return view('fisiere.manage', compact('ownerType', 'owner', 'fisiere'));
    }

    public function view(Fisier $fisier)
    {
        $path = storage_path('app/public/' . $fisier->cale_fisier);
        if (!file_exists($path)) {
            abort(404, 'Fișierul nu a fost găsit.');
        }

        // Determine the MIME type of the file.
        $mime = mime_content_type($path);

        // Set headers to display inline if possible.
        $headers = [
            'Content-Type'        => $mime,
            'Content-Disposition' => 'inline; filename="' . $fisier->nume_fisier . '"'
        ];

        return response()->file($path, $headers);
    }
}
