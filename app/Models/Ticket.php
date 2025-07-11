<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'product_image_path',
    ];

    // Relacionamento: um chamado pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
