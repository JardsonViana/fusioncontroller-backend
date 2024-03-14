<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CircuitController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CpeController;
use App\Http\Controllers\API\EquipamentController;
use App\Http\Controllers\API\ProviderController;
use App\Models\Client;
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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/user/new', [AuthController::class, 'newUsuario']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/client/list', [ClientController::class, 'list']);
    Route::get('/client/{id}', [ClientController::class, 'client']);
    Route::post('/client/new', [ClientController::class, 'newClient']);
    Route::put('/client/{id}', [ClientController::class, 'clientEdit']);
    Route::delete('/client/{id}', [ClientController::class, 'clientDelete']);

    Route::post('/provider/new', [ProviderController::class, 'newProvider']);
    Route::get('/provider/{id}', [ProviderController::class, 'provider']);
    Route::put('/provider/{id}', [ProviderController::class, 'providerEdit']);
    Route::delete('/provider/{id}', [ProviderController::class, 'providerDelete']);

    Route::get('/equipament/list', [EquipamentController::class, 'list']);
    Route::post('/equipament/new', [EquipamentController::class, 'newEquipament']);
    Route::get('/equipament/{id}', [EquipamentController::class, 'equipament']);

    Route::get('/cpe/list', [CpeController::class, 'list']);
    Route::post('/cpe/new', [CpeController::class, 'newCpe']);
    Route::get('/cpe/{id}', [CpeController::class, 'cpe']);
    Route::put('cpe/{id}', [CpeController::class, 'cpeEdit']);
    Route::delete('/cpe/{id}', [CpeController::class, 'cpeDelete']);

    Route::post('/circuit/new', [CircuitController::class, 'newCircuit']);
    Route::get('/circuit/{id}', [CircuitController::class, 'circuit']);
    Route::put('/circuit/{id}', [CircuitController::class, 'circuitEdit']);
    Route::delete('/circuit/{id}', [CircuitController::class, 'circuitDelete']);
});



/**
 * Rota de utilidade
 * [x] - /ping - Responde PONG
 * 
 *  - Rotas de Autenticação * Autenticação via TOKEN
 * [x] - /user/signin -- Login
 * [x] - /user/new    -- Cadastro de usuario no sistema
 * [x] - /user        -- Informação do usuario
 * 
 * - Rotas de clientes
 * [x] - /client/list - Listar todos os clientes cadastrados
 * [x] - /client/:id  - Dados de um cliente especifico
 * [x] - /client/new  - Adicionar um cliente novo
 * [x] - /client/:id(PUT) - Alterar um cliente cadastrado
 * [x] - /client/:id(DELETE) - Deletar um cliente cadastrado
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