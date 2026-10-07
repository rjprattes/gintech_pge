<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizacoes', function (Blueprint $table) {
            $table->id();
            
            // Atributos definidos nos requisitos
            $table->string('nome_fantasia');
            $table->string('razao_social');
            $table->string('cnpj', 18)->unique(); // O CNPJ deve ser único no sistema
            
            // Opcional, mas recomendado: timestamps padrão do Laravel para auditar criação (data de inclusão)
            $table->timestamps(); 
            
            // Preparando para a "Exclusão Lógica" (Soft Deletes), uma prática recomendada para todo o sistema
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizacoes');
    }
};