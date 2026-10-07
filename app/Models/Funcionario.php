<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Funcionario extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'unidade_id', 'nome', 'cpf', 'tipo_usuario', 'situacao', 
        'email', 'data_nascimento', 'senha'
    ];

    // Oculta a senha e o token em retornos de API por segurança
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}