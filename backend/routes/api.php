<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\Usuario\UsuarioController;
use App\Http\Controllers\Api\Auth\AuthController;

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
Route::group(['prefix' => 'novo_usuario'], function () {
    Route::post('cadastrar', [UsuarioController::class,'cadastrarUsuario']);
});


Route::group(['prefix' => 'auth'], function () { //usuarioLogado
    Route::post('login', [AuthController::class,'login']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::group(['prefix' => 'usuario'], function () {

    });

    Route::group(['prefix' => 'estoque'], function () {

    });

    Route::group(['prefix' => 'movimentacao'], function () {

    });
});
