<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcontractant;
use Carbon\Carbon;

class SubcontractantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget('returnUrl');

        $searchNume = trim($request->searchNume);
        $searchTelefon = trim($request->searchTelefon);

        $subcontractanti = Subcontractant::when($searchNume, function ($query, $searchNume) {
                return $query->where('nume', 'LIKE', "%{$searchNume}%");
            })
            ->when($searchTelefon, function ($query, $searchTelefon) {
                return $query->where('telefon', 'LIKE', "%{$searchTelefon}%");
            })
            ->latest()
            ->simplePaginate(50);

        return view('subcontractanti.index', compact('subcontractanti', 'searchNume', 'searchTelefon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->session()->get('returnUrl') ?: $request->session()->put('returnUrl', url()->previous());

        return view('subcontractanti.save')->with([
            'preFilledFields' => $request->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        $subcontractant = Subcontractant::create($data);

        return redirect($request->session()->get('returnUrl', route('subcontractanti.index')))
            ->with('success', 'Subcontractantul <strong>' . e($subcontractant->nume) . '</strong> a fost adăugat cu succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Subcontractant $subcontractant)
    {
        $request->session()->get('returnUrl') ?: $request->session()->put('returnUrl', url()->previous());

        return view('subcontractanti.show', compact('subcontractant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Subcontractant $subcontractant)
    {
        $request->session()->get('returnUrl') ?: $request->session()->put('returnUrl', url()->previous());

        return view('subcontractanti.save', compact('subcontractant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcontractant $subcontractant)
    {
        $data = $this->validateRequest($request);

        $subcontractant->update($data);

        return redirect($request->session()->get('returnUrl', route('subcontractanti.index')))
            ->with('status', 'Subcontractantul <strong>' . e($subcontractant->nume) . '</strong> a fost modificat cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Subcontractant $subcontractant)
    {
        $subcontractant->delete();

        return back()->with('status', 'Subcontractantul <strong>' . e($subcontractant->nume) . '</strong> a fost șters cu succes!');
    }

    /**
     * Validate the request attributes.
     */
    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'nume' => 'required|string|max:255',
            'tip' => 'nullable|string|max:100',
            'numar_inregistrare' => 'nullable|string|max:100',
            'cod_fiscal' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'telefon' => 'nullable|string|max:50',
            'adresa' => 'nullable|string|max:500',
            'oras' => 'nullable|string|max:100',
            'cod_postal' => 'nullable|string|max:50',
            'tara' => 'nullable|string|max:100',
            'data_inceput_contract' => 'nullable|date',
            'data_sfarsit_contract' => 'nullable|date',
            'tarif_orar' => 'nullable|numeric|between:0,999999.99',
            'pret_fix' => 'nullable|numeric|between:0,999999.99',
            'moneda' => 'nullable|string|max:10',
            'conditii_plata' => 'nullable|string|max:100',
            'specializare' => 'nullable|string|max:255',
            'observatii' => 'nullable|string|max:5000',
        ]);
    }
}
