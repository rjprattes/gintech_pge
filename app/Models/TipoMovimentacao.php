<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimentacao extends Model
{
    protected $table = 'tipos_movimentacao';
    protected $fillable = ['nome'];
}
