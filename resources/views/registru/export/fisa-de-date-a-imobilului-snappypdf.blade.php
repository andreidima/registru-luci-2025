@php
    $fontData = base64_encode(
        file_get_contents(base_path('resources/fonts/DejaVuSans.ttf'))
    );
@endphp

<!DOCTYPE  html>
<html lang="ro">

<head>
    <title>Fise de date</title>
    <style type="text/css">
        /* 1) Embed the font */
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('data:font/truetype;base64,{{ $fontData }}')
                 format('truetype');
            /* font-weight: normal; */
            /* font-style: normal; */
        }

        /* 2) Zero-margin A4 portrait */
        @page {
            size: A4 portrait;
            margin: 0;
        }

        @page {
            margin: 0px 0px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
            margin: 0px;
        }

        * {
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        table{
            border-collapse:collapse;
            border-style: solid;
            border-width:1px;
            width: 100%;
        }

        th, td {
            padding: 3px 3px 3px 3px;
        }

        /* .header,
        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }
        .header {
            top: 0px;
        }
        .footer {
            bottom: 100px;
        } */
        .footer {
            /* position: fixed;
            bottom: 10;
            left: 0;
            right: 0; */
            /* height: 50px; */
            /* text-align: center; */
            /* optional styling */
            /* font-size: 12px; */
            /* color: #555; */
        }
    </style>
</head>

<body>
    {{-- <div class="footer" style="text-align:left; padding:0px 20px; font-size:9px"> --}}
    {{-- <div class="footer" style="text-align:left; padding:0px 20px; font-size:9px">
        <p style="text-align:left; padding:0px 20px; font-size:11px">
            Actul original la ID .....................................
        </p>
            Nota:
            <br>
            - Pentru a prelua toate datele constatate la teren, in cazul situatiilor complexe, Prestatorul poate modifica formatul fisei de date a imobilului, cu acordul ANCPI
            <br>
            - Declaratia titularului dreptului de proprietate se completeaza in cazul sectoarelor cadastrale cu deficit de suprafata.  Fisa de date este semnata in mod obligatoriu de catre titularii dreptului de proprietate.
            <br>
            - In cazul imobilelor cu posesori, fisa de date este semnata in mod obligatoriu de catre posesori
    </div> --}}

    @foreach ($registre->groupBy('C') as $registru)
    <div style="margin-left:20px; margin-top:10px;">
        <p>Anexa nr. 4 - FISA DE DATE A IMOBILULUI</p>
        <h2 style="text-align:center; font-weight:bold;">FISA DE DATE A IMOBILULUI</h2>
        <p> {{ $registru->first()->D }} </p>
        <p>Sector cadastral {{ $registru->first()->B }} </p>
        <p>ID imobil {{ $registru->first()->C }}</p>

        <p>&nbsp;</p>
        <p style="margin-left:20px;"><strong>1. DATE TEREN</strong></p>

        <table class="center" style="border-collapse:collapse;" cellspacing="0" border="1">
            <tr style="text-align:center;">
                <td>Nr. Tarla / Strada</td>
                <td>Nr. parcela / Nr. postal</td>
                <td>Suprafata masurata</td>
                <td>Nr. CF</td>
                <td>Nr cad / Nr top</td>
                <td>Imprejmuit / Neimprejmuit (I/N)</td>
                <td>Zona cooperativizata/ necooperativizata(Co/Coo)</td>
            </tr>
            <tr style="text-align:center;">
                <td>{{ $registru->first()->E }}</td>
                <td>{{ $registru->first()->F }}</td>
                <td>{{ $registru->first()->G }}</td>
                <td>{{ $registru->first()->P }}</td>
                <td>{{ $registru->first()->O }}</td>
                <td>N</td>
                <td>Co</td>
            </tr>
        </table>

        {{-- <p>&nbsp;</p> --}}
        <p style="margin-left:20px;">Observatii:</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        {{-- <p>&nbsp;</p> --}}


        <p style="margin-left:20px;"><strong>2.	DATE CONSTRUCTII PERMANENTE</strong></p>

        <table class="center" style="border-collapse:collapse;" cellspacing="0" border="1">
            <tr style="text-align:center;">
                <td>Identificator constructie</td>
                <td>Cod grupa destinatie</td>
                <td>Numar niveluri</td>
                <td>Constr. cu acte (DA/NU)</td>
                <td>Constructie condominiu (DA/NU)</td>
                <td>Nr. bloc</td>
                <td>Nr. total UI</td>
                <td>Suprafata construita masurata</td>
            </tr>
            <tr style="text-align:;">
                <td>C1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="text-align:;">
                <td>C2</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="text-align:;">
                <td>...</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="text-align:;">
                <td>Cn</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        {{-- <p>&nbsp;</p> --}}
        <p style="margin-left:20px;">Partile comune:</p>
        <p style="margin-left:20px;">Observatii:</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        {{-- <p>&nbsp;</p> --}}


        <p style="margin-left:20px;"><strong>3. PROPRIETATEA / POSESIA</strong></p>

        <table class="center" style="border-collapse:collapse;" cellspacing="0" border="1">
            <tr style="text-align:center;">
                <td>Nr. Crt</td>
                <td>Nume si prenume detinator /<br> Denumire persoana juridica</td>
                <td>CNP / CUI</td>
                <td>Nr. act de proprietate/ posesie</td>
                <td>Observatii</td>

            @foreach ($registru as $persoana)
                @if ($loop->first)
                    <tr style="text-align: center;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $persoana->I }} {{ $persoana->J }} {{ $persoana->K }}</td>
                        <td>{{ $persoana->L }}</td>
                        <td rowspan="{{ $registru->count() }}">{{ $persoana->M }}</td>
                        <td rowspan="{{ $registru->count() }}">{{ $persoana->N }}</td>
                    </tr>
                @else
                    <tr style="text-align: center;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $persoana->I }} {{ $persoana->J }} {{ $persoana->K }}</td>
                        <td>{{ $persoana->L }}</td>
                    </tr>
                @endif
            @endforeach
            </table>

        <p style="margin-left:20px;">
            In aplicarea prevederilor art. 12 alin.(1) si (2) ale Legii nr. 677/2001 pentru protectia persoanelor
            cu privire la prelucrarea datelor cu caracter personal si libera circulatie a acestor date,
            titularul declara ca este de acord cu prelucrarea si publicarea datelor cu caracter personal colectate si prelucrate
            in cadrul procesului de inregistrare  sistematica.
        </p>
        <p>&nbsp;</p>
        <p style="margin-left:20px;">
            Declaratia titularului dreptului de proprietate:
            <br />
            Subsemnatul ....................................................... domiciliat in ................................................................................
            posesor al CI seria ..... nr ...............
            eliberat de ........................................ la data ............... declar ca sunt de accord  cu inregistrarea in cartea funciara
            a dreptului de proprietate asupra imobilului cu ID nr ..... reprezentand ........................................
            cu suprafata diminuata de .......... mp si cu amplasamentul stabilit conform intelegerii dintre proprietarii imobilelor
            din sectorul cadastral nr. {{ $registru->first()->B }}
        </p>

        <p>&nbsp;</p>
        <p>&nbsp;</p>

        <div style="float:left;width:300px; margin-left:20px;">
            Posesor/Titular drept de proprietate
            <br>
            <br>
        </div>
        <div style="float:right;width:200px;">
            Reprezentantul Prestatorului
            <br>
            Antochi Stefan Lucian
            <br>
            <img src="{{public_path('/images/Semnatura-Antochi-Stefan-Lucian.jpg')}}" style="width:150px">
        </div>
    </div>

    @if (!$loop->last)
        <div style="page-break-after: always;"></div>
    @endif
    @endforeach

</body>
</html>
