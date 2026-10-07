<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            
            // Chave estrangeira ligando à tabela de organizações
            $table->foreignId('organizacao_id')->constrained('organizacoes')->onDelete('restrict');
            
            // Atributos definidos nos requisitos
            $table->string('nome');
            $table->string('tipo');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};