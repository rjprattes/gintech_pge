<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizacao;
use App\Models\Unidade;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;

class InicialSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cria a Organização Principal
        $pge = Organizacao::create([
            'nome_fantasia' => 'PGE-ES',
            'razao_social' => 'Procuradoria Geral do Estado do Espírito Santo',
            'cnpj' => '27471167000135' // CNPJ fictício/padrão para testes
        ]);

        // 2. Cria a Unidade da TI
        $gin = Unidade::create([
            'organizacao_id' => $pge->id,
            'nome' => 'Gerência de Informática (GIN)',
            'tipo' => 'Tecnologia'
        ]);

        // 3. Cria o Usuário Administrador Raiz
        Funcionario::create([
            'unidade_id' => $gin->id,
            'nome' => 'Administrador do Sistema',
            'cpf' => '12345678900', // Login padrão para testes[cite: 3, 22]
            'tipo_usuario' => 'TI',
            'situacao' => 'ativo',
            'email' => 'admin@pge.es.gov.br',
            'senha' => Hash::make('admin123'), // Senha criptografada
        ]);
    }
}