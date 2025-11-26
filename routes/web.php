<?php

use Illuminate\Support\Facades\Route;
use App\Models\TipoEquipo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ResponsivaBatchController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/responsiva', function () {
        $tipos = TipoEquipo::all();
        return view('responsiva.form', compact('tipos'));
    })->name('responsiva.form');

    Route::get('/responsivasImport', [ResponsivaBatchController::class, 'index'])
        ->name('responsivas.import');

    Route::post('/responsivasImport', [ResponsivaBatchController::class, 'procesar'])
        ->name('responsivas.import.procesar');
});


Route::post('/responsiva/pdf', function (Request $request) {
    $data = $request->all();

    $pdf = Pdf::loadView('responsiva.pdf', $data);
    return $pdf->download('responsiva.pdf');
})->name('responsiva.pdf');

