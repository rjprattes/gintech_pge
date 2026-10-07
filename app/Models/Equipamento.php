<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tipo_equipamento_id', 'status_equipamento_id', 'cadastrador_id',
        'nome', 'descricao', 'situacao', 'num_patrimonio', 'quantidade_estoque'
    ];

    public function tipo() { return $this->belongsTo(TipoEquipamento::class, 'tipo_equipamento_id'); }
    public function status() { return $this->belongsTo(StatusEquipamento::class, 'status_equipamento_id'); }
    public function cadastrador() { return $this->belongsTo(Funcionario::class, 'cadastrador_id'); }
}