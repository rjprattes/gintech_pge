<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusEquipamento extends Model
{
    protected $table = 'status_equipamento';
    protected $fillable = ['nome'];
}
