<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcasaController;
use App\Http\Controllers\MembruController;
use App\Http\Controllers\SubcontractantController;
use App\Http\Controllers\ProiectController;
use App\Http\Controllers\FisierController;

Auth::routes(['register' => false, 'password.request' => false, 'reset' => false]);

Route::redirect('/', '/acasa');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/acasa', [AcasaController::class, 'acasa'])->name('acasa');

    Route::resource('membri', MembruController::class)->parameters(['membri' => 'membru']);
    Route::resource('subcontractanti', SubcontractantController::class)->parameters(['subcontractanti' => 'subcontractant']);
    Route::resource('proiecte', ProiectController::class)->parameters(['proiecte' => 'proiect']);

    // Custom route for managing files (using query parameters for owner info)
    Route::get('/fisiere/manage', [FisierController::class, 'manage'])->name('fisiere.manage');
    Route::get('/fisiere/{fisier}/view', [FisierController::class, 'view'])->name('fisiere.view');
    Route::resource('fisiere', FisierController::class)->only(['store', 'destroy'])->parameters(['fisiere' => 'fisier']);
});
