<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',              // adicione o campo status (open, closed, pending)
        'user_id',
        'product_image_path',  // campo para imagem
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
