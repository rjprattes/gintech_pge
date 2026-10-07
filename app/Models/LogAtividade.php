<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAtividade extends Model
{
    use HasFactory;
    
    protected $table = 'logs_atividade';

    protected $fillable = ['funcionario_ti_id', 'tipo_acao', 'detalhes'];

    public function autor() { return $this->belongsTo(Funcionario::class, 'funcionario_ti_id'); }
}