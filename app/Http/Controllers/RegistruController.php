<?php

namespace App\Http\Controllers;

use App\Models\Registru;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class RegistruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all records
        $registru = Registru::select('id', 'B', 'C')->orderBy('id')->get();

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
        $map = Registru::query()
            ->select('B', \DB::raw('count(*) as cnt'))
            ->groupBy('B')
            ->pluck('cnt', 'B')
            ->toArray();

        \App\Models\UsageLog::create([
            'user_id'     => auth()->id(),
            'status'      => 'deleted',
            'rows_imported' => Registru::count(),
            'counts_by_b'    => $map,
        ]);

        Registru::truncate();

        return redirect()->back()->with('success', 'Toate înregistrările din registru au fost șterse cu succes!');
    }

    public function pdfExportRegistreToate(Request $request)
    {
        $registre = Registru::
            where('B', $request->sector)
            ->get();

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

    public function pdfExportRegistreLimitatPerGrup(Request $request)
    {
        // Retrieve the 'keys' posted from the form
        $keysString = $request->input('keys');
        $groupKeys = explode(',', $keysString);

        // Retrieve only the records with the given B and the keys in the chunk
        $registre = Registru::where('B', $request->sector)
                            ->whereIn('C', $groupKeys)
                            ->orderBy('id')
                            ->get();

        // Proceed with PDF generation using $registru...
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
