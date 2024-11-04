<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "user";

    protected $fillable = [
        'name', 
        'address', 
        'email', 
        'password',
        'PasswordConfirmation',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Adicione este método
    public function shoes()
    {
        return $this->hasMany(Shoe::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
