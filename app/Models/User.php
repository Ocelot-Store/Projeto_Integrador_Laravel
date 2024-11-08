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

    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'name',
        'address',
        'email',
        'password',
        'PasswordConfirmation',
        'profileImage', // Adicionado o campo de imagem de perfil
        'profileCover', // Adicionado o campo de capa do perfil
    ];

    /**
     * Campos ocultos para arrays e JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversão de tipos de atributos.
     */
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
     * Relacionamento: usuários que seguem este usuário.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    /**
     * Relacionamento: usuários que este usuário segue.
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    /**
     * Acessor para a URL da imagem de perfil do usuário.
     */
    public function getProfileImageUrlAttribute()
    {
        return $this->profileImage ? asset('storage/' . $this->profileImage) : asset('assets/AddImage.png');
    }

    /**
     * Acessor para a URL da capa do perfil do usuário.
     */
    public function getProfileCoverUrlAttribute()
    {
        return $this->profileCover ? asset('storage/' . $this->profileCover) : asset('assets/ProfileCover.png');
    }
    
}
