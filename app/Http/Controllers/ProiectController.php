<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proiect;
use App\Http\Requests\ProiectRequest;
use App\Models\Membru;
use App\Models\Subcontractant;

class ProiectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->session()->forget('returnUrl');

        $searchDenumire = trim($request->searchDenumire);
        $searchNrContract = trim($request->searchNrContract);
        $searchIntervalDataContract = trim($request->searchIntervalDataContract);
        $searchMembru = trim($request->searchMembru);
        $searchSubcontractant = trim($request->searchSubcontractant);

        $proiecte = Proiect::with('membri', 'subcontractanti', 'fisiere')
            ->when($searchDenumire, function ($query, $searchDenumire) {
                $words = explode(' ', $searchDenumire);
                return $query->where(function ($q) use ($words) {
                    foreach ($words as $word) {
                        $q->orWhere('denumire_contract', 'LIKE', "%{$word}%");
                    }
                });
            })
            ->when($searchNrContract, function ($query, $searchNrContract) {
                return $query->where('nr_contract', 'LIKE', "%{$searchNrContract}%");
            })
            ->when($searchIntervalDataContract, function ($query, $searchIntervalDataContract) {
                $dates = explode(',', $searchIntervalDataContract);
                return $query->whereBetween('data_contract', [$dates[0] ?? null, $dates[1] ?? null]);
            })
            ->when($searchMembru, function ($query, $searchMembru) {
                return $query->whereHas('membri', function ($q) use ($searchMembru) {
                    $q->whereRaw("CONCAT(nume, ' ', prenume) LIKE ?", ["%{$searchMembru}%"])
                    ->orWhereRaw("CONCAT(prenume, ' ', nume) LIKE ?", ["%{$searchMembru}%"]);
                });
            })
            ->when($searchSubcontractant, function ($query, $searchSubcontractant) {
                return $query->whereHas('subcontractanti', function ($q) use ($searchSubcontractant) {
                    $q->where('nume', 'LIKE', "%{$searchSubcontractant}%");
                });
            })

            ->latest()
            ->simplePaginate(50);

        return view('proiecte.index', compact('proiecte', 'searchDenumire', 'searchNrContract', 'searchIntervalDataContract', 'searchMembru', 'searchSubcontractant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->session()->get('returnUrl') ?: $request->session()->put('returnUrl', url()->previous());

        // Get all membri (only the necessary fields)
        $allMembri = Membru::select('id','prenume','nume')->get()
            ->map(function ($membru) {
                $membru->full_name = $membru->prenume . ' ' . $membru->nume;
                return $membru;
            });
        $existingMembri = []; // empty array

        // Get all subcontractanti (only the necessary fields)
        $allSubcontractanti = Subcontractant::select('id','nume')->get();
        $existingSubcontractanti = []; // empty array

        return view('proiecte.save', [
            'allMembri' => $allMembri,
            'existingMembri' => $existingMembri,
            'allSubcontractanti' => $allSubcontractanti,
            'existingSubcontractanti' => $existingSubcontractanti,
            'preFilledFields' => $request->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProiectRequest $request)
    {
        $data = $request->safe()->except(['membri_ids', 'subcontractanti_ids']);
        $proiect = Proiect::create($data);

        // Extract the IDs as plain arrays:
        $membriIds = $request->safe()->only('membri_ids')['membri_ids'] ?? [];
        $subcontractantiIds = $request->safe()->only('subcontractanti_ids')['subcontractanti_ids'] ?? [];

        $proiect->membri()->sync($membriIds);
        $proiect->subcontractanti()->sync($subcontractantiIds);

        return redirect($request->session()->get('returnUrl', route('proiecte.index')))
            ->with('success', 'Proiectul <strong>' . e($proiect->denumire_contract) . '</strong> a fost adăugat cu succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Proiect $proiect)
    {
        $request->session()->get('returnUrl') ?: $request->session()->put('returnUrl', url()->previous());

        return view('proiecte.show', compact('proiect'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Proiect $proiect)
    {
        $request->session()->get('returnUrl') ?: $request->session()->put('returnUrl', url()->previous());

        // Get all membri
        $allMembri = Membru::select('id','prenume','nume')->get()
            ->map(function ($membru) {
                $membru->full_name = $membru->prenume . ' ' . $membru->nume;
                return $membru;
            });
        $existingMembri = $proiect
            ->membri()  // belongsToMany relationship
            ->select('membri.id', 'membri.prenume', 'membri.nume') // note the table name
            ->get()
            ->map(function ($membru) {
                $membru->full_name = $membru->prenume . ' ' . $membru->nume;
                return $membru;
            });

        // Get all subcontractanti
        $allSubcontractanti = Subcontractant::select('id','nume')->get();
        $existingSubcontractanti = $proiect
            ->subcontractanti()  // belongsToMany relationship
            ->select('subcontractanti.id', 'subcontractanti.nume') // note the table name
            ->get();

        return view('proiecte.save', [
            'proiect' => $proiect,
            'allMembri' => $allMembri,
            'existingMembri' => $existingMembri,
            'allSubcontractanti' => $allSubcontractanti,
            'existingSubcontractanti' => $existingSubcontractanti,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProiectRequest $request, Proiect $proiect)
    {
        $data = $request->safe()->except(['membri_ids', 'subcontractanti_ids']);
        $proiect->update($data);

        // Extract the IDs as plain arrays:
        $membriIds = $request->safe()->only('membri_ids')['membri_ids'] ?? [];
        $subcontractantiIds = $request->safe()->only('subcontractanti_ids')['subcontractanti_ids'] ?? [];

        $proiect->membri()->sync($membriIds);
        $proiect->subcontractanti()->sync($subcontractantiIds);

        return redirect($request->session()->get('returnUrl', route('proiecte.index')))
            ->with('status', 'Proiectul <strong>' . e($proiect->denumire_contract) . '</strong> a fost modificat cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Proiect $proiect)
    {
        // Check if the project has any attached files
        if ($proiect->fisiere()->exists()) {
            return redirect()->back()->with('error', 'Proiectul <strong>' . e($proiect->denumire_contract) . '</strong> nu poate fi șters deoarece are fișiere atașate.');
        }

        // Detach all related members and subcontractants from the pivot tables.
        $proiect->membri()->detach();
        $proiect->subcontractanti()->detach();

        // Delete the project.
        $proiect->delete();

        return back()->with('status', 'Proiectul <strong>' . e($proiect->denumire_contract) . '</strong> a fost șters cu succes!');
    }
}
