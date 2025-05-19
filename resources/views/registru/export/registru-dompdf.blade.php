<!DOCTYPE  html>
<html lang="ro">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registru</title>
    <style type="text/css">
        @page {
            margin: 0px 0px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 11px;
            margin: 0px;
        }

        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        table{
            border-collapse:collapse;
            border-style: solid;
            border-width:1px;
            width: 1080px;
        }

        th, td {
            padding: 2px 0px 2px 0px;
            border-style: solid;
            border-width:1px;
        }
        tr {
            text-align:center;
            border-style: solid;
            border-width:1px;
        }
        #header,
        #footer {
        position: fixed;
        text-align:center;
        font-size: 0.9em;
        }
        #header {
        top: 0;
            border-bottom: 0.1pt solid #aaa;
        }
        #footer {
        bottom: 20;
        }
        /* .page-number:before {
        content: "Pagina " counter(page);
        } */
    </style>
</head>

<body>
    {{-- <div id="footer">
        <div class="page-number"></div>
    </div> --}}
    {{-- <div class="footer" style="text-align:left; padding:0px 20px; font-size:9px">
        {{ $loop->iteration }}
    </div> --}}
    @foreach ($registre->groupBy('C') as $registru)
    <div style="width:1080px; margin-left:20px; margin-top:50px;">
        <div>
            <div style="float:left; width:500px;">
                <p>{{ $registru->first()->first()->D }}, JUDETUL VRANCEA</p>
                <p>Zona cooperativizata (Co)</p>
            </div>
            <div style="float:left; width:580px; text-align:right;">
                <p>Anexa nr.2</p>
            </div>
        </div>

        <div>
            &nbsp;
        </div>
        <div>
            <h3 style="text-align:center; margin:0; padding:0;">
                REGISTRUL CADASTRAL AL IMOBILELOR
            </h3>
        </div>


        <p style="clear:both">&nbsp;</p>
        <p style="margin-left:20px;"><strong>1. DESCRIEREA IMOBILULUI</strong></p>

        <table>
            <tr>
                <td colspan="11">DATE TEREN</td>
                <td colspan="6">DATE CONSTRUCTII</td>
            </tr>
            <tr>
                <td>Identificator teren</td>
                <td style="width:100px;">Adresa imobil</td>
                <td>Nr. cadastral</td>
                <td>Nr. CF</td>
                <td>Suprafata masurata</td>
                <td>Intravilan/ Extravilan (I/E)</td>
                <td>Nr. top.</td>
                <td>Nr. tarla</td>
                <td>Nr. parcela</td>
                <td>Categorie folosinta</td>
                <td>Suprafata parcela</td>
                <td>Identificator constructie</td>
                <td>Cod grupa destinatie</td>
                <td>Suprafata construita</td>
                <td>Nr.niveluri</td>
                <td>Nr. CF</td>
                <td>Constr. cu acte (DA/NU)</td>
            </tr>
            <tr>
                <td>{{ $registru->first()->C }}</td>
                <td>{{ $registru->first()->D }}</td>
                <td>{{ $registru->first()->O }}</td>
                <td>{{ $registru->first()->P }}</td>
                <td>{{ $registru->first()->G }}</td>
                <td>{{ $registru->first()->Q }}</td>
                <td>{{ $registru->first()->O }}</td>
                <td>{{ $registru->first()->E }}</td>
                <td>{{ $registru->first()->F }}</td>
                <td>{{ $registru->first()->R }}</td>
                <td>{{ $registru->first()->G }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <p>&nbsp;</p>

        <p style="margin-left:20px;"><strong>2. PROPRIETATEA / POSESIA</strong></p>

        <table>
            <tr>
                <td colspan="3">Titularul dreptului/ posesiei</td>
                <td rowspan="2">Data nasterii/ <br> CUI</td>
                <td rowspan="2" style="width:100px;">Domiciliu/ Sediu</td>
                <td rowspan="2">Cota parte</td>
                <td rowspan="2">Identificator<br>entitate<br>asociata</td>
                <td rowspan="2">Cota<br>parte<br>teren UI</td>
                <td rowspan="2">Mod de<br>dobandire</td>
                <td colspan="3">Act juridic</td>
                <td rowspan="2">Observatii<br>privitoare la<br>proprietar</td>
            </tr>
            <tr>
                <td>Nume/ Denumire</td>
                <td>Initiala tatalui</td>
                <td>Prenume</td>
                <td>Tip act</td>
                <td>Nr. act/ data</td>
                <td>Emitent</td>
            </tr>
{{-- @php
    dd($registru, $registru->count())
@endphp --}}
        @foreach ($registru as $persoana)
            @if ($loop->first)
                <tr>
                    <td>{{ $persoana->I }}</td>
                    <td>{{ $persoana->J }}</td>
                    <td>{{ $persoana->K }}</td>
                    <td>{{ $persoana->W }}</td>
                    <td>{{ $persoana->S }}</td>
                    <td rowspan="{{ $registru->count() }}">1/1</td>
                    <td rowspan="{{ $registru->count() }}">TEREN</td>
                    <td rowspan="{{ $registru->count() }}"></td>
                    <td rowspan="{{ $registru->count() }}">{{ $persoana->T}}</td>
                    <td rowspan="{{ $registru->count() }}">{{ $persoana->U}}</td>
                    <td rowspan="{{ $registru->count() }}">{{ $persoana->M}}</td>
                    <td rowspan="{{ $registru->count() }}">{{ $persoana->V}}</td>
                    <td rowspan="{{ $registru->count() }}"></td>
                </tr>
            @else
                <tr>
                    <td>{{ $persoana->I }}</td>
                    <td>{{ $persoana->J }}</td>
                    <td>{{ $persoana->K }}</td>
                    <td>{{ $persoana->W }}</td>
                    <td>{{ $persoana->S }}</td>
                </tr>
            @endif
        @endforeach
        </table>


        <div style="page-break-inside: avoid;">
            <p>&nbsp;</p>
            <p style="margin-left:20px;"><strong>3. SARCINI / DEZMEMBRAMINTE</strong></p>

            <table>
                <tr>
                    <td colspan="3">Titular</td>
                    <td rowspan="2">Data nasterii/ CUI</td>
                    <td rowspan="2">Domiciliu/ Sediu</td>
                    <td rowspan="2">Tipul sarcinii sau al dezmembramintelor dreptului de proprietate</td>
                    <td rowspan="2">Cota parte</td>
                    <td rowspan="2">Identificator entitate asociata</td>
                    <td colspan="3">Act juridic</td>
                    <td rowspan="2">Valoare ipoteca</td>
                    <td rowspan="2">Tip moneda</td>
                </tr>
                <tr><td>Nume/ Denumire</td>
                    <td>Initiala tatalui</td>
                    <td>Prenume</td>
                    <td>Tip act</td>
                    <td>Nr. act/ data</td>
                    <td>Emitent</td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </table>


        </div>

        <div style="page-break-inside: avoid;">
            <p>&nbsp;</p>
            <p style="margin-left:20px;"><strong>4. NOTARI, PROCESE, INTERDICTII 5. OBSERVATII</strong></p>

            <table>
                <tr>
                    <td>Tipul notarii</td>
                    <td>Tip act</td>
                    <td>Nr. act/ data</td>
                    <td>Emitent</td>
                    <td>Identificator entitate asociata</td>
                    <td>Imobil imprejmuit / neimprejmuit</td>
                    <td>Imobil contestat / necontestat</td>
                    <td>Alte observatii</td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </table>


            <p>&nbsp;</p>

            <p style="text-align:right;"><strong>Inregistrare sistematica {{ $registru->first()->D }}, Sector cadastral nr. {{ $registru->first()->B }}</strong></p>
            <p style="text-align:right;"><strong>Anul realizarii {{ $registru->first()->A }}.</strong></p>

        </div>
    </div>

    @if (!$loop->last)
        <div style="page-break-after: always;"></div>
    @endif

    @endforeach

        {{-- Here's the magic. This MUST be inside body tag. Page count / total, centered at bottom of page --}}
        <script type="text/php">
            if (isset($pdf)) {
                $text = "Pagina {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("helvetica");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 25;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
</body>

</html>
