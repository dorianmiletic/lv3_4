<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    
   
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');       // prikaz svih projekata
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create'); // forma za novi projekt
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');       // spremanje novog projekta
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show'); // prikaz pojedinačnog projekta
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit'); // uređivanje projekta
    Route::patch('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update'); // update projekta
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy'); // brisanje projekta
});


require __DIR__.'/auth.php';
