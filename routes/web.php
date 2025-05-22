<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;  // ADICIONE ISSO
use Illuminate\Support\Facades\Route;

Route::get('/', [TicketController::class, 'index'])->name('tickets.index');

// Rotas públicas para registro
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas protegidas para gerenciamento de tickets
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

    Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});

require __DIR__.'/auth.php';
