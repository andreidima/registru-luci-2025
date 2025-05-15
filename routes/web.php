<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcasaController;
use App\Http\Controllers\RegistruController;
use App\Http\Controllers\RegistruImportController;

Auth::routes(['register' => false, 'password.request' => false, 'reset' => false]);

Route::redirect('/', '/acasa');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/acasa', [AcasaController::class, 'acasa'])->name('acasa');

    Route::post('/registru/import', [RegistruImportController::class, 'import'])->name('registru.import');
    Route::get('/registru/export/{tip}/{sector}/{view_type}', [RegistruController::class, 'pdfExportRegistreToate'])->name('registru.export');
    Route::post('/registru/export/{tip}/{sector}/{view_type}', [RegistruController::class, 'pdfExportRegistreLimitatPerGrup'])->name('registru.export');
    Route::delete('/registru/all', [RegistruController::class, 'destroyAll'])->name('registru.destroyAll');
    Route::resource('/registru', RegistruController::class)->parameters(['registru' => 'registru']);


    Route::get('/pdf-test', function () {
        // either via the facade…
        $pdf = PDF::loadHTML('<h1>✅ Snappy is working!</h1><p>Generated at {{ now() }}</p>')
                ->setPaper('a4', 'portrait');

        // …or via the container alias:
        // $pdf = app('snappy.pdf.wrapper')->loadHTML('…');

        return $pdf->inline('test.pdf');
    });
});
