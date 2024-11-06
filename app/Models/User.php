<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "user"; // Nome da tabela de usuários

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

    /**
     * Relacionamento com o modelo de sapatos.
     */
    public function shoes()
    {
        return $this->hasMany(Shoe::class);
    }

    /**
     * Relacionamento com o modelo de favoritos.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Relacionamento: Usuários que este usuário está seguindo.
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    /**
     * Relacionamento: Usuários que estão seguindo este usuário.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }
}


