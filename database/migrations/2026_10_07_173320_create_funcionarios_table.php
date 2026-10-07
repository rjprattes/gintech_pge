<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            
            // Vínculo obrigatório com a Unidade
            $table->foreignId('unidade_id')->constrained('unidades')->onDelete('restrict');
            
            // Atributos base de todo Funcionário
            $table->string('nome');
            $table->string('cpf', 14)->unique();
            $table->enum('tipo_usuario', ['PGE', 'TI']); 
            $table->enum('situacao', ['ativo', 'inativo', 'admitido', 'bloqueado'])->default('ativo');
            
            // Atributos exclusivos da especialização Funcionário TI (podem ser nulos para PGE)
            $table->string('email')->unique()->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('senha')->nullable();
            
            $table->timestamps(); // Já contempla a data de inclusão
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
