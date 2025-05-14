<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RegistruImport;
use Maatwebsite\Excel\Facades\Excel;

class RegistruImportController extends Controller
{
    // Handle the import process
    public function import(Request $request)
    {
        $request->validate([
            'fisier_excel' => 'required|mimes:xlsx,xls'
        ]);

        // 1) compute a hash so we can detect re-uploads of the same file
        $contents   = file_get_contents($request->file('fisier_excel')->getRealPath());
        $fileHash   = hash('sha256', $contents);

        // 2) spin up a “pending” record
        $log = \App\Models\UsageLog::create([
            'user_id'     => auth()->id(),
            'file_hash'   => $fileHash,
            'status'      => 'pending',
        ]);

        // 3) launch the import and pass the ImportLog ID in
        Excel::import(new RegistruImport($log->id), $request->file('fisier_excel'));

        if (session('import_failures')) {
            // e.g. pass failures to the view so users can correct real data issues
            return redirect()->back()
                ->with('success', 'Import done, but some rows were skipped.')
                ->with('failures', session('import_failures'));
        }

        return redirect()->back()->with('success', 'Registru a fost importat cu succes!');
    }
}
