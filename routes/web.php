<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
  // Rotas de admin
use App\Http\Controllers\Admin\UserManagementController;

// Página inicial redireciona para login
Route::get('/', function(){
    return 'home';
})->name('home');

// Registro - páginas públicas
Route::get('/register', [UserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [UserController::class, 'store'])->middleware('guest')->name('register.store');

// Login - rotas públicas
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login.store');

// Logout - rota protegida por POST
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {

    // Dashboard após login
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gerenciamento de tickets
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

  

    Route::middleware('can:admin-access')->prefix('admin')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users.index');
        Route::post('/users/{id}/promote-technician', [UserManagementController::class, 'promoteToTechnician'])->name('admin.users.promote-technician');
        Route::post('/users/{id}/promote-admin', [UserManagementController::class, 'promoteToAdmin'])->name('admin.users.promote-admin');
        Route::post('/users/{id}/demote', [UserManagementController::class, 'demote'])->name('admin.users.demote');
    });
});
