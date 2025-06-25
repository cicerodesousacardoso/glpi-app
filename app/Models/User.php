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
        'role_id', // Agora usamos role_id!
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relacionamento com o papel (role)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Chamados criados pelo usuário
    public function chamadosCriados()
    {
        return $this->hasMany(Chamado::class, 'user_id');
    }

    // Chamados atribuídos ao técnico
    public function chamadosRecebidos()
    {
        return $this->hasMany(Chamado::class, 'tecnico_id');
    }

    // Verifica se é administrador
   public function isAdmin()
{
    return optional($this->role)->name === 'admin';
}

public function isTecnico()
{
    return optional($this->role)->name === 'tecnico';
}

public function isUsuario()
{
    return optional($this->role)->name === 'user';
}
}