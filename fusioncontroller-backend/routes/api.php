<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

/* Rotas de utilidade: */
Route::get('/ping', function(): JsonResponse {
    return response()->json(['Pong' => true]);
});

/* Rotas de Autenticação * Autenticação via TOKEN */
Route::post('/user/signin', [AuthController::class, 'login']);
Route::post('/user/new', [AuthController::class, 'newUsuario']);
Route::get('/user', [AuthController::class, 'usuario']);
Route::get('/user/logout', [AuthController::class, 'logout']);

/**
 * Rota de utilidade
 * [ ] - /ping - Responde PONG
 * 
 *  - Rotas de Autenticação * Autenticação via TOKEN
 * [ ] - /user/signin -- Login
 * [ ] - /user/new    -- Cadastro de usuario no sistema
 * [ ] - /user        -- Informação do usuario
 * 
 * - Rotas de clientes
 * [ ] - /client/list - Listar todos os clientes cadastrados
 * [ ] - /client/:id  - Dados de um cliente especifico
 * [ ] - /client/new  - Adicionar um cliente novo
 * [ ] - /client/:id(PUT) - Alterar um cliente cadastrado
 * [ ] - /client/:id(DELETE) - Deletar um cliente cadastrado
 * 
 * - Rotas de Provedores
 * [ ] - /provider/:id - Dados de um provider especifico
 * [ ] - /provider/new - Adicionar um provider
 * [ ] - /provider/:id(PUT) - Alterar um provider
 * [ ] - /provider/:id(del) - Deleter um provider
 * 
 * - Rotas de Circuito
 * [ ] - ??
 * 
 * - Rotas de Equipaments
 * [ ] - /equipament/list - Lista todos os equipamentos homologados
 * [ ] - /equipament/new  - Cadastra um novo equipamento
 * [ ] - /equipament/:id  - Dados de um equipamento
 * 
 * - Rotas de CPE
 * [ ] - /cpe/list - Listar todas as CPEs
 * [ ] - /cpe/new  - Adicionar nova CPE
 * [ ] - /cpe/:id  - Dados de uma CPE
 * [ ] - /cpe/:id(PUT) - Alterar CPE
 * [ ] - /cpe/:id(del) - Deletar CPE
 * 
 * - Rotas de configuração 
 * [ ] - /config/new - Gerar nova config
 * [ ] - /config/list - Visualizar a config
 * [ ] - /config/send - Enviando config
 * [ ] - /config/status - Validando config
 * 
 * 
 * 
 */