<?php

namespace App\Http\Controllers\Api\Estoque;

use App\Http\Controllers\Controller;
use App\Service\Persistencia;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;

abstract class BaseController extends Controller
{
    // responsavel por receber os campos que serão validados
    protected array $validacaoCampos;
    // cria um para pegar o atributo de persistencia que esta dentro de service
    protected Persistencia $persistencia;

    public function cadastrar(Request $request): object
    {
        try {

            $this->validate($request, $this->validacaoCampos);

            $dados = $this->persistencia->cadastrar($request->all());
            if ($dados) {

                // retorna a resposta
                return response()
                    ->json([
                        'resposta' => $dados,
                        'mensagem' => 'Success',
                        'status' => Response::HTTP_CREATED
                    ]);
            }

            // retorna a resposta vazia
            return response()
                ->json([
                    'resposta' => 'Erro ao cadastrar',
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

    public function atualizar(Request $request, int $id): object
    {
        try {

            $this->validate($request, $this->validacaoCampos);

            // realiza a auteração
            $dados = $this->persistencia->atualizar($request->all(), $id);
            // em caso de sucesso na atualização
            if ($dados) {

                // retorna a resposta
                return response()
                    ->json([
                        'resposta' => $this->persistencia->consultarPorId($id),
                        'mensagem' => 'Success',
                        'status' => Response::HTTP_OK
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

    public function deletar(int $id): object
    {
        try {

            // deleta de forma logica o cadastro
            $data = $this->persistencia->deletar($id);
            if ($data) {

                return response()->json([
                    'resposta' => $data,
                    'mensagem' => 'Success',
                    'status' => Response::HTTP_OK
                ]);
            }
            return response()->json([
                'resposta' => [],
                'mensagem' => 'Erro ao deletar',
                'status' => Response::HTTP_NO_CONTENT
            ]);
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function consultar(int $id): object
    {
        try {

            // retorna a resposta
            return response()
                ->json([
                    'resposta' => $this->persistencia->consultarPorId($id),
                    'mensagem' => 'Success',
                    'status' => Response::HTTP_OK
                ]);
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function listar(): object
    {
        try {

            $dados = $this->persistencia->listar();

            if ($dados->count() > 0) {
                return response()
                    ->json([
                        'resposta' => $dados,
                        'mensagem' => 'Success',
                        'status' => Response::HTTP_OK
                    ]);
            }

            return response()
                ->json([
                    'resposta' => [],
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
}
