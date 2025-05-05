<?php

namespace App\Http\Controllers\Api\Admin\Movimentacao;

use App\Http\Controllers\Api\Admin\BaseController;
use App\Service\Persistencia;
use App\Models\Movimentacao;


class MovimentacaoController extends BaseController
{
    public function __construct()
    {
        $this->validacaoCampos = $this->validarCampos();
        $this->persistencia = new Persistencia(Movimentacao::class);
    }

    public function validarCampos()
    {
        return [
            'nome' => 'required|max:255|min:3',
            'produto_id' => 'required',
            'tipo' => 'required',
            'quantidade' => 'required',
            'user_id' => 'required'
        ];
    }
}
