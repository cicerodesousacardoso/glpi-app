<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Chamados criados pelo usuário (user_id)
    public function chamadosCriados()
    {
        return $this->hasMany(Chamado::class, 'user_id');
    }

    // Chamados atribuídos ao técnico (tecnico_id)
    public function chamadosRecebidos()
    {
        return $this->hasMany(Chamado::class, 'tecnico_id');
    }

    // Verifica se é administrador
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Verifica se é técnico
    public function isTecnico()
    {
        return $this->role === 'tecnico';
    }

    // Verifica se é usuário comum
    public function isUsuario()
    {
        return $this->role === 'user';
    }
}
