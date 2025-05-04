<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'tipo',
        'quantidade',
        'user_id'
    ];

    // Um usuário para varias Movimentações
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Um Produto esta presente em varias Movimentações
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
