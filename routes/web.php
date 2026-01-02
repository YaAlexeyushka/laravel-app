<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DataController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/form', [FormController::class, 'show'])->name('form.show');
Route::post('/form', [FormController::class, 'submit'])->name('form.submit');

Route::get('/data', [DataController::class, 'index'])->name('data.index');
