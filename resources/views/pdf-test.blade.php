@php
    // $fontData = base64_encode(
    //     file_get_contents(storage_path('app/fonts/DejaVuSans.ttf'))
    // );
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Test</title>
    <style>
        @font-face {
            font-family: 'DejaVuSans';
            /* src: url('data:font/truetype;base64,{{ $fontData }}')
                 format('truetype'); */
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'DejaVuSans', sans-serif;
            margin: 1cm;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 0.5em;
        }
    </style>
</head>
<body>
    <h1>✅ It works!</h1>
    <p>This PDF is rendered with an embedded DejaVuSans font.</p>
</body>
</html>
