<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//rotas que apontam para as funções, ou seja, o js usa essas rotas para acessar as funções do php(que por sua vez acessam e alteram o banco de dados)

//rota para envio de dados do novo fornecedor
Route::post('/criar', [FornecedorController::class, 'Create']);

//rota detalhes
Route::get('/ler/{id}', [FornecedorController::class, 'Read']);

//rota para atualização de página - preenche a tabela
Route::get('/', [FornecedorController::class, 'HomePage']);

//rota para atualização de página - informada uma página específica
Route::get('/lertodos', [FornecedorController::class, 'ReadAll']);

//rota de busca
Route::post('/buscar', [FornecedorController::class, 'Search']);

//rota de atualização
Route::post('/atualizar', [FornecedorController::class, 'Update']);

//rota de exclusão
Route::post('/deletar', [FornecedorController::class, 'SoftDelete']);

//Rota para ler a tabela de responsavel
Route::get('/lerresponsaveis', [FornecedorController::class, 'GetResponsibleList']);

//rota para mudança de lista de fornecedores
Route::post('/{changeBy}', [FornecedorController::class, 'ChangePageBy']);