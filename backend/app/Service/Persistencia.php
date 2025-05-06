<?php

namespace App\Service;

class Persistencia
{
    private $classe;

    public function __construct($classe)
    {
        $this->classe = $classe;
    }

    // cadastra um objeto
    public function cadastrar(array $array): object
    {
        return $this->classe::create($array);
    }
    // atualiza um objeto
    public function atualizar(array $array, int $id): bool
    {
        return $this->classe::findOrFail($id)->update($array);
    }
    // realiza o retorno de um objeto
    public function consultarPorId(int $id): object
    {
        return $this->classe::where('id', $id)->first();
    }
    // deleta um objeto de forma logica
    public function deletar(int $id): int
    {
        return $this->classe::findOrFail($id)->delete();
    }
    // realiza a listagem
    public function listar(): object
    {
        return $this->classe::all();
    }
}
