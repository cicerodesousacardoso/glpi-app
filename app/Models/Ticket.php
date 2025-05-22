<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',  // importante para preencher o user_id via create()
    ];

    // Relacionamento opcional com User (se desejar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
