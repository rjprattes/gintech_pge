<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Movimentacao;
use App\Models\ItemMovimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipamentoController extends Controller
{
    // 1. LISTAR EQUIPAMENTOS
    public function index(Request $request)
    {
        // Pega o valor de 'per_page' enviado pelo Angular, ou usa 15 como padrão
        $perPage = $request->query('per_page', 15); 
        
        // Pagina os resultados em vez de usar get()
        $paginacao = Equipamento::with('organizacao')->paginate($perPage);

        // Calcula os totais globais para a Dashboard Lateral
        $totalGeral = Equipamento::count();
        $totalAtivos = Equipamento::where('status', 'Ativo')->count();
        $totalManutencao = Equipamento::where('status', 'Em Manutenção')->count();

        // Devolve tudo num único pacote JSON
        return response()->json([
            'paginacao' => $paginacao,
            'resumo' => [
                'total' => $totalGeral,
                'ativos' => $totalAtivos,
                'manutencao' => $totalManutencao
            ]
        ], 200);
    }

    // 2. CADASTRAR NOVO EQUIPAMENTO COM HISTÓRICO
    public function store(Request $request)
    {
        // 1. O validate já devolve apenas os campos validados e seguros
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:equipamentos,numero_serie',
            'tipo' => 'required|string',
            'organizacao_id' => 'required|exists:organizacoes,id'
        ]);

        DB::beginTransaction();
        try {
            // 2. Cria o equipamento usando os dados validados (agora inclui a organizacao_id enviada pelo Angular)
            $equipamento = Equipamento::create($dados);

            // 3. Cria o cabeçalho da Movimentação (Mestre)
            $movimentacao = Movimentacao::create([
                'tipo_movimentacao_id' => 1, // Assumindo que 1 é "Entrada/Cadastro"
                'cadastrador_id' => 1,       // Fixo por agora (depois será o usuário logado)
                'solicitante_id' => 1,       // Fixo por agora
                'status' => 'Finalizado',
                'data_disponibilizacao' => now()->toDateString(),
                'hora_disponibilizacao' => now()->toTimeString(),
            ]);

            // 4. Associa o equipamento à movimentação (Detalhe)
            $movimentacao->itens()->create([
                'equipamento_id' => $equipamento->id,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Equipamento e histórico cadastrados com sucesso!',
                'equipamento' => $equipamento
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Erro ao salvar o equipamento e o histórico.',
                'erro' => $e->getMessage()
            ], 500);
        }
    }

    // 3. ATUALIZAR UM EQUIPAMENTO
    public function update(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);

        if (!$equipamento) {
            return response()->json(['message' => 'Equipamento não encontrado.'], 404);
        }

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
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

    // 4. APAGAR UM EQUIPAMENTO
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