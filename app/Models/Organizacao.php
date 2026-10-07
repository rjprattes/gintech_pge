<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizacao extends Model
{
    use HasFactory, SoftDeletes;

    // Define o nome correto da tabela para evitar que o Laravel tente procurar por "organizacaos"
    protected $table = 'organizacoes';

    // Permite que estes campos sejam preenchidos em massa
    protected $fillable = [
        'nome_fantasia',
        'razao_social',
        'cnpj',
    ];

    /**
     * Relacionamento: Uma Organização pode possuir zero ou mais Unidades.
     */
    public function unidades()
    {
        return $this->hasMany(Unidade::class);
    }
}