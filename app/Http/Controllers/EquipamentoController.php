<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
    // 1. LISTAR EQUIPAMENTOS (GET /api/equipamentos)
    public function index()
    {
        // Traz todos os equipamentos e já junta com o nome da organização (PGE)
        $equipamentos = Equipamento::with('organizacao')->get();
        return response()->json($equipamentos, 200);
    }

    // 2. CADASTRAR NOVO EQUIPAMENTO (POST /api/equipamentos)
    public function store(Request $request)
    {
        // Regras de validação (Não deixa salvar sem os dados obrigatórios)
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:equipamentos,numero_serie',
            'tipo' => 'required|string',
            'organizacao_id' => 'required|exists:organizacoes,id'
        ]);

        // Se a validação passar, salva no banco
        $equipamento = Equipamento::create($request->all());

        return response()->json([
            'message' => 'Equipamento cadastrado com sucesso!',
            'equipamento' => $equipamento
        ], 201);
    }
    // 3. ATUALIZAR UM EQUIPAMENTO (PUT /api/equipamentos/{id})
    public function update(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);

        if (!$equipamento) {
            return response()->json(['message' => 'Equipamento não encontrado.'], 404);
        }

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            // Na validação de unique, ignoramos o ID do equipamento atual para não dar erro ao salvar o mesmo número
            'numero_serie' => 'sometimes|required|string|unique:equipamentos,numero_serie,' . $id,
            'tipo' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
            'organizacao_id' => 'sometimes|required|exists:organizacoes,id'
        ]);

        $equipamento->update($request->all());

        return response()->json([
            'message' => 'Equipamento atualizado com sucesso!',
            'equipamento' => $equipamento
        ], 200);
    }

    // 4. APAGAR UM EQUIPAMENTO (DELETE /api/equipamentos/{id})
    public function destroy($id)
    {
        $equipamento = Equipamento::find($id);

        if (!$equipamento) {
            return response()->json(['message' => 'Equipamento não encontrado.'], 404);
        }

        $equipamento->delete();

        return response()->json([
            'message' => 'Equipamento removido com sucesso!'
        ], 200);
    }
}