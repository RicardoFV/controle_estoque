<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'user_id'
    ];

    // coloca a primeira letra de cada palavra em maiusculo
    public function setNomeAttribute(string $nome)
    {
        $this->attributes['nome'] = ucfirst($nome);
    }

    // Um usuário para varios categorias
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Varios Produtos para uma Categoria
    public function produtosCategoria()
    {
        return $this->hasMany(Categoria::class, 'categoria_id');
    }
}
