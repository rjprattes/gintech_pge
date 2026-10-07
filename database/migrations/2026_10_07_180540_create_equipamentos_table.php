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
        Schema::create('equipamentos', function (Blueprint $table) {
        $table->id();
        
        $table->foreignId('tipo_equipamento_id')->constrained('tipos_equipamento')->onDelete('restrict');
        $table->foreignId('status_equipamento_id')->constrained('status_equipamento')->onDelete('restrict');
        $table->foreignId('cadastrador_id')->constrained('funcionarios')->onDelete('restrict'); // Técnico TI que cadastrou[cite: 31]
        
        $table->string('nome');
        $table->text('descricao')->nullable();
        $table->string('situacao')->default('ativo'); // ativo ou excluido[cite: 31]
        
        // Específicos (podem ser nulos dependendo do tipo)
        $table->string('num_patrimonio')->unique()->nullable(); // Para permanentes
        $table->integer('quantidade_estoque')->nullable(); // Para consumíveis
        
        $table->timestamps();
        $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
