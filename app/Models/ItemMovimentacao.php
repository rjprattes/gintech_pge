<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMovimentacao extends Model
{
    use HasFactory;
    
    protected $table = 'itens_movimentacao';

    protected $fillable = ['movimentacao_id', 'equipamento_id', 'quantidade'];

    public function equipamento() { return $this->belongsTo(Equipamento::class); }
}