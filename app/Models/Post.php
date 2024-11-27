<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts'; // Garantindo a tabela correta

    protected $fillable = [
        'user_id',
        'shoe_id',
        'content',
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com o tênis
    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    // Relacionamento com os comentários
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc'); // Ordenando por data
    }
}

