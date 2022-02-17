<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index'])
    ->name('index');

Route::get('/{pageId}', [MainController::class, 'page'])
    ->where('pageId', '\d+')
    ->name('page');
