<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organizacao_id',
        'nome',
        'tipo',
    ];

    /**
     * Relacionamento: Uma Unidade pertence a exatamente uma Organização.
     */
    public function organizacao()
    {
        return $this->belongsTo(Organizacao::class);
    }
}