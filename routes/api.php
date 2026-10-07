<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rota pública de login
Route::post('/login', [AuthController::class, 'login']);

// Grupo de rotas protegidas (Exigirá o Token no Postman)
Route::middleware('auth:sanctum')->group(function () {
    // Aqui entrarão as rotas de Organização, Equipamentos, etc.
    
    // Rota de teste para ver quem está logado
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});