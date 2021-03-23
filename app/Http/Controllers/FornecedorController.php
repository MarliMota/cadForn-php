<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use GrahamCampbell\ResultType\Result;
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
            'IsArchived' => $request->IsArchived,
        ]);
    }

    //função que preenche a tabela
    public function ReadAll()
    {
        $providersList = Fornecedor::select("*")->where('isArchived', 0)->get(); //função get de dentro da classe fornecedor - informações do banco de dados
        return $providersList;
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

    public function SoftDelete()
    {
        $id = $_POST['id'];
        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->Update([
            'nomeFantasia' => $fornecedor->nomeFantasia,
            'razaoSocial' => $fornecedor->razaoSocial,
            'cnpj' => $fornecedor->cnpj,
            'telefone' => $fornecedor->telefone,
            'celular' => $fornecedor->celular,
            'endereco' => $fornecedor->endereco,
            'email' => $fornecedor->email,
            'site' => $fornecedor->site,
            'produto' => $fornecedor->produto,
            'contrato' => $fornecedor->contrato,
            'observacao' => $fornecedor->observacao,
            'IsArchived' => 1,
        ]);
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
            'IsArchived' => $request->IsArchived,
        ]);
    }

    public function HomePage()
    {
        return view('fornecedor', []);
    }
}