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
        Schema::create('logs_atividade', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('funcionario_ti_id')->constrained('funcionarios')->onDelete('restrict'); // Autor da ação[cite: 31, 33]
            
            $table->string('tipo_acao'); // Inclusão, alteração, exclusão lógica, logon[cite: 31, 33]
            $table->text('detalhes'); // Descrição do objeto afetado[cite: 31, 33]
            
            $table->timestamps(); // Já fornece data e hora da ocorrência automaticamente[cite: 33]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_atividades');
    }
};
