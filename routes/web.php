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

//rota para atualização de página - preenche a tabela
Route::get('/', [FornecedorController::class, 'fetchAll'])->name('preenche_lista');

//rota para envio de dados do novo fornecedor
Route::post('/submit', [FornecedorController::class, 'store'])->name('registrar_fornecedor');

//rota exclusão
Route::post('/excluir/{id}', [FornecedorController::class, 'destroy'])->name('excluir_fornecedor');

//rota detalhes
Route::get('/detalhes/{id}', [FornecedorController::class, 'showDetails'])->name('detalhes_fornecedor');
