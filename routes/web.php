<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [NoteController::class, 'dashboard'])->name('dashboard');
    Route::post('store-note', [NoteController::class, 'store'])->name('store.note');
    Route::post('update-note', [NoteController::class, 'update'])->name('update.note');
    Route::post('delete-note', [NoteController::class, 'delete'])->name('delete.note');

    Route::post('upload-file', [NoteController::class, 'uploadFile'])->name('upload.file');
    Route::post('delete-file', [NoteController::class, 'deleteFile'])->name('delete.file');
});

require __DIR__.'/auth.php';
