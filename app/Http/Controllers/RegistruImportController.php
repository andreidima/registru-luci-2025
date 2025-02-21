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

        Excel::import(new RegistruImport, $request->file('fisier_excel'));

        return redirect()->back()->with('success', 'Registru a fost importat cu succes!');
    }
}
