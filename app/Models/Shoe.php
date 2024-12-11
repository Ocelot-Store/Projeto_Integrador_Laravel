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
        'description',
        'color',
        'image',
        'data_upload',
        'category',
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

    public function getCheapestShoe()
    {
        // Busca o tênis com o menor preço
        $cheapestShoe = Shoe::orderBy('price', 'asc')->first(); // Supondo que o campo de preço seja 'price'

        return view('sua_view', compact('cheapestShoe')); // Substitua 'sua_view' pelo nome da sua view
    }

    public function sizes()
    {
        return $this->hasMany(ShoeSize::class, 'shoe_id');
    }
}
