<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdentitasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Identitas', [IdentitasController::class, 'index'])->name('Data.index');
Route::get('/Identitas/{id}', [IdentitasController::class, 'destroy'])->name('Identitas.destroy');
Route::put('/Identitas/{id}', [IdentitasController::class, 'update'])->name('Identitas.update');
Route::get('/Identitas/{id}/edit', [IdentitasController::class, 'edit'])->name('Identitas.edit');
Route::post('/Identitas/save', [IdentitasController::class, 'save'])->name('Identitas.save');

Route::get('/search', [IdentitasController::class, 'search'])->name('search');

 