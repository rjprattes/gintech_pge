<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;

class Equipamento extends Model
{
    use HasFactory, SoftDeletes;

    // Liberar estas colunas para serem preenchidas via requisição POST
    protected $fillable = [
        'nome',
        'numero_serie',
        'tipo',
        'status',
        'organizacao_id'
    ];
    // Configurações do Spatie Activity Log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable() // Vigia todas as colunas do $fillable acima
            ->logOnlyDirty() // Só salva no log se o valor realmente mudar
            ->dontSubmitEmptyLogs(); // Não cria logs vazios
    }

    // Criar o relacionamento: Um Equipamento pertence a uma Organização
    public function organizacao()
    {
        return $this->belongsTo(Organizacao::class);
    }
}