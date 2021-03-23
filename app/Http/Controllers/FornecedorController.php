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
            'inicioDoContrato' => $request->inicioDoContrato,
            'fimDoContrato' => $request->fimDoContrato,
            'observacao' => $request->observacao,
            'IsArchived' => $request->IsArchived,
        ]);
    }

    //função que preenche a tabela
    public function ReadAll()
    {
        $providersList = Fornecedor::select("*")->where('isArchived', 0)
            ->orderBy('id', 'DESC')
            ->get(); //função get de dentro da classe fornecedor - informações do banco de dados
        return $providersList;
    }

    public function Search()
    {
        $textToSearch = $_POST['textToSearch'];
        $providersList = Fornecedor::select("*")
            ->where('nomeFantasia', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('razaoSocial', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('cnpj', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('telefone', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('celular', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('endereco', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('email', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('site', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('produto', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('contrato', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('inicioDoContrato', 'LIKE', '%' . $textToSearch . '%')
            ->orWhere('fimDoContrato', 'LIKE', '%' . $textToSearch . '%')
            ->orderBy('id', 'DESC')
            ->get(); //função get de dentro da classe fornecedor - informações do banco de dados//função get de dentro da classe fornecedor - informações do banco de dados
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
            'inicioDoContrato' => $fornecedor->inicioDoContrato,
            'fimDoContrato' => $fornecedor->inicioDoContrato,
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
            'inicioDoContrato' => $request->inicioDoContrato,
            'fimDoContrato' => $request->fimDoContrato,
            'observacao' => $request->observacao,
            'IsArchived' => $request->IsArchived,
        ]);
    }

    public function HomePage()
    {
        return view('fornecedor', []);
    }
}