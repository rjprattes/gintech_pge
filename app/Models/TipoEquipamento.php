<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEquipamento extends Model
{
    protected $table = 'tipos_equipamento';
    protected $fillable = ['nome'];
}
