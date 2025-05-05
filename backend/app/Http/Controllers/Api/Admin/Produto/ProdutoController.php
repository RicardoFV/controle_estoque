<?php

namespace App\Http\Controllers\Api\Admin\Produto;

use App\Http\Controllers\Api\Admin\BaseController;
use App\Service\Persistencia;
use App\Models\Produto;

class ProdutoController extends BaseController
{
    public function __construct()
    {
        $this->validacaoCampos = $this->validarCampos();
        $this->persistencia = new Persistencia(Produto::class);
    }

    public function validarCampos()
    {
        return [
            'nome' => 'required|max:255|min:3',
            'categoria_id' => 'required',
            'user_id' => 'required',
            'preco' => 'required',
            'quantidade' => 'required'
        ];
    }
}
