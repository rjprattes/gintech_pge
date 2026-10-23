<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipamentoController;

// Rota pública de login
Route::post('/login', [AuthController::class, 'login']);

// Grupo de rotas protegidas (Exigirá o Token no Postman)
Route::middleware('auth:sanctum')->group(function () {
    // Aqui entrarão as rotas de Organização, Equipamentos, etc.
    Route::apiResource('/equipamentos', EquipamentoController::class);
    Route::get('/equipamentos', [EquipamentoController::class, 'index']);
    Route::post('/equipamentos', [EquipamentoController::class, 'store']);
    Route::put('/equipamentos/{equipamento}', [EquipamentoController::class, 'update']);
    Route::delete('/equipamentos/{equipamento}', [EquipamentoController::class, 'destroy']);
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});