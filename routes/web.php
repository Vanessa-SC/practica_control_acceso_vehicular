<?php

use App\Http\Controllers\AccesoController;
use Illuminate\Support\Facades\Route;

Route::controller(AccesoController::class)->group(function(){
    Route::get('/', 'index')->name('accesos.index');
    Route::get('registrar_entrada', 'entrada')->name('accesos.entrada');
    Route::post('registrar_entrada', 'store_entrada')->name('accesos.entrada_registrar');

    Route::get('registrar_salida', 'salida')->name('accesos.salida');
    Route::post('registrar_salida', 'store_salida')->name('accesos.salida_registrar');

    Route::get('reporte', 'reporte')->name('accesos.reporte');
    Route::post('reporte', 'reporte')->name('accesos.reporte');
});
