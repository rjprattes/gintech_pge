<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Valida se a requisição enviou os dados obrigatórios
        $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string'
        ]);

        // Busca o funcionário pelo CPF
        $funcionario = Funcionario::where('cpf', $request->cpf)->first();

        // Verifica se o usuário existe, se a senha está correta e se ele está ativo
        if (!$funcionario || !Hash::check($request->senha, $funcionario->senha)) {
            return response()->json(['message' => 'Credenciais inválidas.'], 401);
        }

        if ($funcionario->situacao !== 'ativo') {
            return response()->json(['message' => 'Usuário inativo ou bloqueado. Procure a GIN.'], 403);
        }

        // Gera o token de acesso da API usando o Sanctum
        $token = $funcionario->createToken('gintech_token')->plainTextToken;

        return response()->json([
            'message' => 'Autenticação realizada com sucesso',
            'funcionario' => $funcionario,
            'token' => $token
        ], 200);
    }
}