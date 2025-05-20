@php
    $fontData = base64_encode(
        file_get_contents(base_path('resources/fonts/DejaVuSans.ttf'))
    );
@endphp

<!DOCTYPE  html>
<html lang="ro">

<head>
    <title>Registru Cadastral</title>
    <style type="text/css">
        /* 1) Embed the font */
        @font-face {
            font-family: 'DejaVu Sans', sans-serif;
            src: url('data:font/truetype;base64,{{ $fontData }}')
                 format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        /* 2) Zero-margin A4 portrait */
        @page {
            size: A4 portrait;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        html, body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        table{
            width: 100%;
            border-collapse:collapse;
            border-style: solid;
            border-width:1px;
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

        /* 4) A simple clearfix for your header row */
        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
    </style>
</head>

<body>
    @foreach ($registre->groupBy('C') as $registru)
    <div class="clearfix" style="margin:50px 20px 0;">
        <div style="overflow:hidden; gap: 10px;">
            <div style="float:left; width:50%;">
                <p>{{ $registru->first()->first()->D ?? '' }}, JUDETUL VRANCEA</p>
                <p>Zona cooperativizata (Co)</p>
            </div>
            <div style="float:left; width:50%; text-align:right;">
                <p>Anexa nr.2</p>
            </div>
        </div>
        <br>
        <div style="">
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
</body>

</html>
