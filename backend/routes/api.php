<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\Usuario\UsuarioController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Admin\Categoria\CategoriaController;
use App\Http\Controllers\Api\Admin\Produto\ProdutoController;
use App\Http\Controllers\Api\Admin\Movimentacao\MovimentacaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// cadastra um novo usuario
Route::group(['prefix' => 'registrar_usuario'], function () {
    Route::post('cadastrar', [UsuarioController::class, 'cadastrarUsuario']);
});


Route::group(['prefix' => 'auth'], function () { //usuarioLogado
    Route::post('login', [AuthController::class, 'login']);
});
// proteção no grupo de rotas
Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'usuario'], function () {
        Route::put('atualizar/{id}', [UsuarioController::class, 'atualizarUsuario']);
        Route::get('consultar/{id}', [UsuarioController::class, 'consultar']);
        Route::get('listar', [UsuarioController::class, 'listar']);
        Route::delete('deletar/{id}', [UsuarioController::class, 'deletar']);
    });

    Route::group(['prefix' => 'categoria'], function () {
        Route::post('cadastrar', [CategoriaController::class, 'cadastrar']);
        Route::put('atualizar/{id}', [CategoriaController::class, 'atualizar']);
        Route::get('consultar/{id}', [CategoriaController::class, 'consultar']);
        Route::get('listar', [CategoriaController::class, 'listar']);
        Route::delete('deletar/{id}', [CategoriaController::class, 'deletar']);
    });

    Route::group(['prefix' => 'produto'], function () {
        Route::post('cadastrar', [ProdutoController::class, 'cadastrar']);
        Route::put('atualizar/{id}', [ProdutoController::class, 'atualizar']);
        Route::get('consultar/{id}', [ProdutoController::class, 'consultar']);
        Route::get('por_categoria/{id}', [ProdutoController::class, 'listarProdutosPorCategoria']);
        Route::get('movimentacao/{id}', [ProdutoController::class, 'listarProdutoPorMovimentacao']);
        Route::get('sem_estoque', [ProdutoController::class, 'listarProdutosSemEstoque']);
        Route::get('com_estoque', [ProdutoController::class, 'listarProdutosComEstoque']);
        Route::get('listar', [ProdutoController::class, 'listar']);
    });

    Route::group(['prefix' => 'movimentacao'], function () {
        Route::post('gerar', [MovimentacaoController::class, 'registrarMovimentacaoEstoque']);
        Route::get('movimentacaoes/{id}', [MovimentacaoController::class, 'mostrarMovimentacaoPorProduto']);
        Route::get('listar', [MovimentacaoController::class, 'listar']);
        Route::delete('deletar/{id}', [MovimentacaoController::class, 'deletar']);
    });
});
