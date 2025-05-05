<?php

namespace App\Http\Controllers\Api\Admin\Categoria;

use App\Http\Controllers\Api\Admin\BaseController;
use App\Service\Persistencia;
use App\Models\Categoria;

class CategoriaController extends BaseController
{
    public function __construct()
    {
        $this->validacaoCampos = $this->validarCampos();
        $this->persistencia = new Persistencia(Categoria::class);
    }

    public function validarCampos()
    {
        return [
            'nome' => 'required|max:255|min:3'
        ];
    }
}
