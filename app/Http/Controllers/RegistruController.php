<?php

namespace App\Http\Controllers;

use App\Models\Registru;
use Illuminate\Http\Request;

class RegistruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registru = Registru::all();

        return view('registru.index', compact('registru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registru  $registru
     * @return \Illuminate\Http\Response
     */
    public function show(Registru $registru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registru  $registru
     * @return \Illuminate\Http\Response
     */
    public function edit(Registru $registru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registru  $registru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registru $registru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registru  $registru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registru $registru)
    {
        //
    }

    public function destroyAll()
    {
        Registru::truncate();

        return redirect()->back()->with('success', 'Toate înregistrările din registru au fost șterse cu succes!');
    }

    public function pdfExportRegistre(Request $request)
    {
        $registre = Registru::all()
            // ->where('B', $request->sector);
            ->take(4000);

        if ($request->tip === "registrul-cadastral-al-imobilelor") {
            if ($request->view_type === 'export-html') {
                return view('registru.export.registru-pdf', compact('registre'));
            } elseif ($request->view_type === 'export-pdf') {
                $pdf = \PDF::loadView('registru.export.registru-pdf', compact('registre'))
                    // ->setOption('footer-right', '[page]')
                    ->setPaper('a4', 'landscape');
                $pdf->getDomPDF()->set_option("enable_php", true);
                return $pdf->stream();
            }
        } elseif ($request->tip === "fisa-de-date-a-imobilului") {
            if ($request->view_type === 'export-html') {
                return view('registru.export.fisa-de-date-a-imobilului-pdf', compact('registre'));
            } elseif ($request->view_type === 'export-pdf') {
                $pdf = \PDF::loadView('registru.export.fisa-de-date-a-imobilului-pdf', compact('registre'))
                    ->setPaper('a4', 'portrait');
                $pdf->getDomPDF()->set_option("enable_php", true);
                return $pdf->stream();
            }
        }
    }
}
