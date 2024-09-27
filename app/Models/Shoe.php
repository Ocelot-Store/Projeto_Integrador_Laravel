<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    // Define o nome da tabela, caso seja diferente do padrão
    protected $table = 'shoe';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'model',
        'brand_id',
        'user_id',
        'price',
        'size',
        'description',
        'color',
        'path',
        'file_name',
        'data_upload',
    ];

    // Define os relacionamentos
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
