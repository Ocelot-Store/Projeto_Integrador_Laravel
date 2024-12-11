<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shoe;


class ShoeSize extends Model
{
    use HasFactory;

    protected $table = 'shoe_sizes';

    protected $fillable = ['shoe_id', 'size', 'quantity'];

    public function shoe()
    {
        return $this->belongsTo(Shoe::class, 'shoe_id');
    }
    
}
