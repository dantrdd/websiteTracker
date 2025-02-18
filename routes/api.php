<?php

use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::post('/track', [VisitController::class, 'track']);
