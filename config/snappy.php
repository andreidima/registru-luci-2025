<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    | Enabled:
    |
    |    Whether to load PDF / Image generation.
    |
    | Binary:
    |
    |    The file path of the wkhtmltopdf / wkhtmltoimage executable.
    |
    | Timeout:
    |
    |    The amount of time to wait (in seconds) before PDF / Image generation is stopped.
    |    Setting this to false disables the timeout (unlimited processing time).
    |
    | Options:
    |
    |    The wkhtmltopdf command options. These are passed directly to wkhtmltopdf.
    |    See https://wkhtmltopdf.org/usage/wkhtmltopdf.txt for all options.
    |
    | Env:
    |
    |    The environment variables to set while running the wkhtmltopdf process.
    |
    */

    // 'pdf' => [
    //     'enabled' => true,
    //     'binary'  => env('WKHTML_PDF_BINARY', '/usr/local/bin/wkhtmltopdf'),
    //     'timeout' => false,
    //     'options' => [],
    //     'env'     => [],
    // ],

    // 'image' => [
    //     'enabled' => true,
    //     'binary'  => env('WKHTML_IMG_BINARY', '/usr/local/bin/wkhtmltoimage'),
    //     'timeout' => false,
    //     'options' => [],
    //     'env'     => [],
    // ],

    'pdf' => [
        'enabled' => true,
        'binary'  => storage_path('bin/wkhtmltox/bin/wkhtmltopdf'),
        'timeout' => 60,
        'options' => [
            'margin-bottom' => '20mm',
            // … your other options …
        ],
        'env' => [
            // point at the private lib folder so all .so files can be found
            'LD_LIBRARY_PATH' => storage_path('bin/wkhtmltox/lib'),
            // and point at its fonts so fontconfig finds them:
            'FONTCONFIG_PATH' => storage_path('bin/wkhtmltox/fonts'),
        ],
    ],

];
