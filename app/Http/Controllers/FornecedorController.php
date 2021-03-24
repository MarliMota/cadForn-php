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
        $fornecedor = Fornecedor::create([
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
            'responsavel' => $request->responsavel,
            'observacao' => $request->observacao,
            'IsArchived' => $request->IsArchived,
        ]);

        $this->sendNewRowCreatedEmail($fornecedor);
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
        $providersList = Fornecedor::select("*")
            ->where('isArchived', 0)
            ->where(function ($query) {
                $textToSearch = $_POST['textToSearch'];

                $query
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
                    ->orWhere('responsavel', 'LIKE', '%' . $textToSearch . '%');
            })

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
            'responsavel' => $request->responsavel,
            'observacao' => $request->observacao,
        ]);
    }

    public function sendNewRowCreatedEmail($fornecedor)
    {
        $to_email = 'root@localhost.com';
        $subject = 'Novo fornecedor cadastrado';
        $message = "Um novo fornecedor foi cadastrado, essas são as suas informações: \n \n" .
            "ID: " . $fornecedor->id . "\n" .
            "Nome Fantasia: " . $fornecedor->nomeFantasia . "\n" .
            "Razão Social: " . $fornecedor->razaoSocial . "\n" .
            "CNPJ: " . $fornecedor->cnpj . "\n" .
            "Telefone: " . $fornecedor->telefone . "\n" .
            "Celular: " . $fornecedor->celular . "\n" .
            "Endereço: " . $fornecedor->endereco . "\n" .
            "E-mail: " . $fornecedor->email . "\n" .
            "Site: " . $fornecedor->site . "\n" .
            "Produto: " . $fornecedor->produto . "\n" .
            "Contrato: " . $fornecedor->contrato . "\n" .
            "Inicio do contrato: " . $fornecedor->inicioDoContrato . "\n" .
            "Fim do contrato: " . $fornecedor->fimDoContrato . "\n" .
            'Responsavel: ' . $fornecedor->responsavel . "\n" .
            "Observação: " . $fornecedor->observacao . "\n";
        $headers = 'From: noreply@cadforn.com';
        mail($to_email, $subject, $message, $headers);
    }

    public function HomePage()
    {
        return view('fornecedor', []);
    }
}