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

//rota para envio de dados do novo fornecedor
Route::post('/criar', [FornecedorController::class, 'Create']);

//rota detalhes
Route::get('/ler/{id}', [FornecedorController::class, 'Read']);

//rota para atualização de página - preenche a tabela
Route::get('/', [FornecedorController::class, 'ReadAll']);

//rota exclusão
Route::post('/atualizar/{id}', [FornecedorController::class, 'Update']);

//rota exclusão
Route::post('/deletar/{id}', [FornecedorController::class, 'Delete']);

//rota para mudança de lista de fornecedores
Route::post('/{changeBy}', [FornecedorController::class, 'ChangePageBy']);
