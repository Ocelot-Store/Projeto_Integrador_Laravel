<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments'; // Garantindo a tabela correta

    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com o post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

