<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas RESTful para tickets (CRUD completo)
Route::resource('tickets', TicketController::class);
