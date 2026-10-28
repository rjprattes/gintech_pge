<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemMovimentacao extends Model
{
    protected $table = 'itens_movimentacao';

    protected $fillable = [
        'movimentacao_id',
        'equipamento_id',
        'quantidade'
    ];

    public function movimentacao()
    {
        return $this->belongsTo(Movimentacao::class, 'movimentacao_id');
    }

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }
}