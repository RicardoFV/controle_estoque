<?php

namespace App\Http\Controllers\Api\Admin\Movimentacao;

use App\Http\Controllers\Api\Admin\BaseController;
use App\Service\Persistencia;
use App\Models\{Produto,Movimentacao};
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;

class MovimentacaoController extends BaseController
{
    private  Persistencia $persistenciaProduto;

    public function __construct()
    {
        $this->validacaoCampos = $this->validarCampos();
        $this->persistencia = new Persistencia(Movimentacao::class);
        $this->persistenciaProduto = new Persistencia(Produto::class);
    }


    public function registrarMovimentacaoEstoque(Request $request)
    {
        try {

            $this->validate($request, $this->validacaoCampos);
            $movimentacao = $this->persistencia->cadastrar($request->all());

            $produto = $this->persistenciaProduto->consultarPorId($request->post('produto_id'));

            if ($movimentacao) {

                if ($movimentacao->tipo === 'entrada') {
                    $quantidade = $produto->quantidade + $request->post('quantidade');
                    $this->persistenciaProduto->atualizar(
                        [
                            'quantidade' => $quantidade
                        ],
                        $produto->id
                    );
                }
                if ($movimentacao->tipo == 'saida') {
                    $quantidade = $produto->quantidade - $request->post('quantidade');
                    $this->persistenciaProduto->atualizar(
                        [
                            'quantidade' => $quantidade
                        ],
                        $produto->id
                    );
                }
                // retorna a resposta
                return response()
                    ->json([
                        'resposta' => $movimentacao,
                        'mensagem' => 'Success',
                        'status' => Response::HTTP_CREATED
                    ]);
            }
            // retorna a resposta
            return response()
                ->json([
                    'resposta' => 'Erro ao Atualizar',
                    'mensagem' => 'Success',
                    'status' => Response::HTTP_NO_CONTENT
                ]);
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function validarCampos()
    {
        return [
            'produto_id' => 'required',
            'tipo' => 'required',
            'quantidade' => 'required',
            'user_id' => 'required'
        ];
    }
}
