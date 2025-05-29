<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'user_id',
        'tecnico_id',
    ];

    // Usuário que criou o chamado
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Técnico responsável
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }
}
