<?php

namespace App\Http\Controllers\Api\Admin\Movimentacao;

use App\Http\Controllers\Api\Admin\BaseController;
use App\Service\Persistencia;
use App\Models\{Produto, Movimentacao};
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


    public function registrarMovimentacaoEstoque(Request $request): object
    {
        try {

            $this->validate($request, $this->validacaoCampos);

            $produto = $this->persistenciaProduto->consultarPorId($request->post('produto_id'));

            $quantidade = $this->tratarMovimentacao(
                $request->post('tipo'),
                $produto->quantidade,
                $request->post('quantidade')
            );
            if ($quantidade >= 0) {
                $this->persistenciaProduto->atualizar(
                    [
                        'quantidade' => $quantidade
                    ],

                    $produto->id
                );

                $movimentacao = $this->persistencia->cadastrar($request->all());

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
                    'resposta' => 'Erro ao Registrr Movimentação, Verifique o estoque !',
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

    public function mostrarMovimentacaoPorProduto(int $id): object
    {
        return Movimentacao::with('produto')->where('produto_id', $id)->get();

    }

    // trata a movimentação do estoque
    private function tratarMovimentacao(String $tipo, int $quantidadeProduto, int $quantidadeInformada): int
    {
        $quantidade = 0;

        if ($tipo === 'entrada') {

            $quantidade = $quantidadeProduto + $quantidadeInformada;
        }
        if ($tipo == 'saida') {


            $quantidade = $quantidadeProduto - $quantidadeInformada;
        }

        return $quantidade;
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
