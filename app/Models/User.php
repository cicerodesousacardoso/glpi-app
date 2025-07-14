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
        'role_id', // FK para tabela roles
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relacionamento: cada usuário pertence a um papel (role).
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Chamados criados pelo usuário (relacionamento com tickets).
     */
    public function chamadosCriados()
    {
        return $this->hasMany(Chamado::class, 'user_id');
    }

    /**
     * Chamados atribuídos a um técnico (se for técnico).
     */
    public function chamadosRecebidos()
    {
        return $this->hasMany(Chamado::class, 'tecnico_id');
    }

    /**
     * Verifica se o usuário tem papel de administrador.
     */
    public function isAdmin(): bool
    {
        return optional($this->role)->name === 'admin';
    }

    /**
     * Verifica se o usuário tem papel de técnico.
     */
    public function isTecnico(): bool
    {
        return optional($this->role)->name === 'tecnico';
    }

    /**
     * Verifica se o usuário é usuário comum.
     */
    public function isUsuario(): bool
    {
        return optional($this->role)->name === 'user';
    }
}
