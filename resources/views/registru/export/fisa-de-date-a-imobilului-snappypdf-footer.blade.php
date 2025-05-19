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

    <div style="padding:0 5mm; width:100%; text-align:left;">
        <p style="text-align:left; margin:0; padding:0px 20px; font-size:16px !important">
            Actul original la ID .....................................
        </p>
        <div style="padding:0; margin:0; font-size:12px !important;">
            Nota:
            <br>
            - Pentru a prelua toate datele constatate la teren, in cazul situatiilor complexe, Prestatorul poate modifica formatul fisei de date a imobilului, cu acordul ANCPI
            <br>
            - Declaratia titularului dreptului de proprietate se completeaza in cazul sectoarelor cadastrale cu deficit de suprafata.  Fisa de date este semnata in mod obligatoriu de catre titularii dreptului de proprietate.
            <br>
            - In cazul imobilelor cu posesori, fisa de date este semnata in mod obligatoriu de catre posesori
        </div>
    </div>

</body>
