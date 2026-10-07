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
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('tipo_movimentacao_id')->constrained('tipos_movimentacao')->onDelete('restrict');
            $table->foreignId('solicitante_id')->constrained('funcionarios')->onDelete('restrict'); // Destinatário[cite: 31, 33]
            $table->foreignId('cadastrador_id')->constrained('funcionarios')->onDelete('restrict'); // Técnico TI[cite: 31, 33]
            
            $table->date('data_disponibilizacao')->nullable(); // Agendamento[cite: 33]
            $table->time('hora_disponibilizacao')->nullable(); // Agendamento[cite: 33]
            $table->date('data_entrega')->nullable(); // Efetivação[cite: 33]
            $table->time('hora_entrega')->nullable(); // Efetivação[cite: 33]
            $table->string('status')->default('pendente');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacaos');
    }
};
