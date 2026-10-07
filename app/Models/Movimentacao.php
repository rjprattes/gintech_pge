<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimentacao extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'movimentacoes';

    protected $fillable = [
        'tipo_movimentacao_id', 'solicitante_id', 'cadastrador_id',
        'data_disponibilizacao', 'hora_disponibilizacao', 
        'data_entrega', 'hora_entrega', 'status'
    ];

    public function tipo() { return $this->belongsTo(TipoMovimentacao::class, 'tipo_movimentacao_id'); }
    public function solicitante() { return $this->belongsTo(Funcionario::class, 'solicitante_id'); }
    public function cadastrador() { return $this->belongsTo(Funcionario::class, 'cadastrador_id'); }
    public function itens() { return $this->hasMany(ItemMovimentacao::class); }
}