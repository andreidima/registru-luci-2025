<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcasaController;
use App\Http\Controllers\RegistruController;
use App\Http\Controllers\RegistruImportController;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Str;

Auth::routes(['register' => false, 'password.request' => false, 'reset' => false]);

Route::redirect('/', '/acasa');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/acasa', [AcasaController::class, 'acasa'])->name('acasa');

    Route::post('/registru/import', [RegistruImportController::class, 'import'])->name('registru.import');
    Route::get('/registru/export/{tip}/{sector}/{view_type}', [RegistruController::class, 'pdfExportRegistreToate'])->name('registru.export');
    Route::post('/registru/export/{tip}/{sector}/{view_type}', [RegistruController::class, 'pdfExportRegistreLimitatPerGrup'])->name('registru.export');
    Route::delete('/registru/all', [RegistruController::class, 'destroyAll'])->name('registru.destroyAll');
    Route::resource('/registru', RegistruController::class)->parameters(['registru' => 'registru']);

    //
    Route::get('/flush', function(){
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        return 'Cleared caches';
    });

    Route::get('/pdf-test', function () {
        // 1) Render your Blade to an HTML string
        $html = view('pdf-test')->render();

        // 2) Write it to a temp file
        //    we're putting it in storage/app so it's readable by PHP
        $filename = Str::random(16).'.html';
        $path = storage_path("app/{$filename}");
        file_put_contents($path, $html);

        // 3) Build the PDF by pointing at file:// URI
        $pdf = SnappyPdf::loadFile('file://'.$path)
            ->setOption('enable-local-file-access', true)
            ->setOption('load-error-handling', 'ignore')
            ->setOption('load-media-error-handling', 'ignore')
            ->setPaper('A4', 'portrait');

        // 4) Stream it back
        $response = $pdf->inline('test.pdf');

        // (Optional) delete the temp file so you don't fill up storage
        @unlink($path);

        return $response;
    });
});
