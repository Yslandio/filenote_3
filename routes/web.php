<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [NoteController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::post('store-note', [NoteController::class, 'store'])->name('store.note');


require __DIR__.'/auth.php';
