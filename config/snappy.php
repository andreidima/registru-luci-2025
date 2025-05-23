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
        // read from ENV, or use your existing storage/bin path on Linux
        'binary'  => env('WKHTMLTOPDF_BINARY',
                        storage_path('bin/wkhtmltox/bin/wkhtmltopdf')),
        'timeout' => 60,
        'options' => [
            'enable-local-file-access'   => true,
            'load-error-handling'        => 'ignore',
            'load-media-error-handling'  => 'ignore',
            'margin-bottom'              => '20mm',
        ],
        'env' => [
            'LD_LIBRARY_PATH'   => storage_path('bin/wkhtmltox/lib'),
            'FONTCONFIG_PATH'   => storage_path('bin/wkhtmltox/fonts'),
        ],
    ],

];
