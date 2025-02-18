<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'],function (){
    Route::get('/report', [VisitController::class, 'showReport'])->name('report');

    Route::group(['prefix' => 'clients'],function (){
        Route::get('', [ClientController::class, 'index'])->name('clients.index');
        Route::post('', [ClientController::class, 'store'])->name('clients.store');
        Route::delete('{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
    });
});