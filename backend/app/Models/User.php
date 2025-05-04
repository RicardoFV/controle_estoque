<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'password',
    ];


    // coloca a primeira letra de cada palavra em maiusculo
    public function setNomeAttribute(string $nome)
    {
        $this->attributes['nome'] = ucfirst($nome);
    }
    // Varias movimentações para o mesmo usuário
    public function movimentacoesUsuario()
    {
        return $this->hasMany(Movimentacao::class , 'user_id');
    }

    // Varias Produtos para o mesmo usuário
    public function produtosUsuario()
    {
        return $this->hasMany(Produto::class , 'user_id');
    }

    // Varias Categorias para o mesmo usuário
    public function categoriasUsuario()
    {
        return $this->hasMany(Categoria::class , 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
