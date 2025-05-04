<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'categoria_id',
        'user_id',
        'preco',
        'quantidade'
    ];

    // coloca a primeira letra de cada palavra em maiusculo
    public function setNomeAttribute(string $nome)
    {
        $this->attributes['nome'] = ucfirst($nome);
    }

    // Uma categoria para varios produtos
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    // Um usuário para varios produtos
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Varias Movimentações para um produto
    public function movimentacoesProduto()
    {
        return $this->hasMany(Movimentacao::class, 'produto_id');
    }
}
