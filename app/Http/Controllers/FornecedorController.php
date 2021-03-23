<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use Mockery\Undefined;


//funções crud
class FornecedorController extends Controller
{
    //public $providersList;

    public $currentPage = 0;
    public $itemsByPage = 4;

    //salva os dados do fornecedor
    public function Create(Request $request) //request das informações do formulário
    {
        Fornecedor::create([
            'nomeFantasia' => $request->nomeFantasia,
            'razaoSocial' => $request->razaoSocial,
            'cnpj' => $request->cnpj,
            'telefone' => $request->telefone,
            'celular' => $request->celular,
            'endereco' => $request->endereco,
            'email' => $request->email,
            'site' => $request->site,
            'produto' => $request->produto,
            'contrato' => $request->contrato,
            'observacao' => $request->observacao,
        ]);
    }

    //função que preenche a tabela
    public function ReadAll()
    {
        return Fornecedor::get(); //função get de dentro da classe fornecedor - informações do banco de dados
    }


    public function Read($id)
    {
        return Fornecedor::findOrFail($id); //acessa o banco de dados e encontra um elemento pelo id
    }

    //função para excluir
    public function Delete()
    {
        $id = $_POST['id'];
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
    }

    //Função editar
    public function Update(Request $request)
    {
        $fornecedor = Fornecedor::findOrFail($request->ID);

        $fornecedor->Update([
            'nomeFantasia' => $request->nomeFantasia,
            'razaoSocial' => $request->razaoSocial,
            'cnpj' => $request->cnpj,
            'telefone' => $request->telefone,
            'celular' => $request->celular,
            'endereco' => $request->endereco,
            'email' => $request->email,
            'site' => $request->site,
            'produto' => $request->produto,
            'contrato' => $request->contrato,
            'observacao' => $request->observacao,
        ]);
    }

    public function HomePage()
    {
        return view('fornecedor', []);
    }
}