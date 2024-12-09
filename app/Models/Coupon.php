<?php

// app/Models/Coupon.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'discount', 'expires_at', 'is_active'
    ];

    public function isValid()
    {
        // Verifica se o cupom está ativo
        if (!$this->is_active) {
            return false;
        }

        // Verifica se a data de validade está no futuro
        if ($this->valid_until && $this->valid_until < now()) {
            return false;
        }

        return true;
    }

    public function isExpired()
    {
        return $this->expires_at < now();
    }
}

