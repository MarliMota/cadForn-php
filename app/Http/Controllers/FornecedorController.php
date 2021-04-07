<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use GrahamCampbell\ResultType\Result;
use Mockery\Undefined;
use mysqli;

//funções crud
class FornecedorController extends Controller
{
    //salva os dados do novo fornecedor
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
            'IsArchived' => $request->IsArchived, //variavel criada para o softdelete
        ]);

        $this->sendNewRowCreatedEmail($fornecedor); //envia e-mail com as informações do fornecedor cadastrado
    }

    //função que preenche a tabela das paginas
    public function ReadAll()
    {
        $providersList = Fornecedor::select("*")->where('isArchived', 0) //seleciona todos os fornecedores com isArchived = 0, ou seja, fornecedores ativos (não arquivados)
            ->orderBy('id', 'DESC') //ordena por id de forma decrescente (do mais novo para o mais antigo)
            ->get(); //função get de dentro da classe fornecedor - informações do banco de dados
        return $providersList;
    }

    //função de busca
    public function Search()
    {
        $providersList = Fornecedor::select("*")
            ->where('isArchived', 0) //busca apenas os fornecedores ativos
            ->where(function ($query) { //query avançada que contem um conjunto de querys
                $textToSearch = $_POST['textToSearch']; //recebe o texto que foi digitado

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

            ->orderBy('id', 'DESC') //ordena do mais novo para o mais velho
            ->get(); //função get de dentro da classe fornecedor - informações do banco de dados

        return $providersList;
    }

    //função que le um fornecedor pelo id(usada para preencher o overlay para detalhes ou editar)
    public function Read($id)
    {
        return Fornecedor::findOrFail($id); //acessa o banco de dados e encontra um elemento pelo id
    }

    //função para excluir - não está sendo usada, pois é usada a função softdelete
    public function Delete()
    {
        $id = $_POST['id'];
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
    }

    //função que arquiva fornecedor pelo id
    public function SoftDelete()
    {
        $id = $_POST['id']; //pega uma variavel especifica dentro do objeto global POST
        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->Update([ //ponteiro que aponta para uma variavel no banco de dados, para que essa variavel seja alterada
            'IsArchived' => 1, //muda o valor para um, arquivando o fornecedor
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

    //função para envio de e-mail
    public function sendNewRowCreatedEmail($fornecedor)
    {
        $to_email = 'root@localhost.com'; //email criado e configurado para receber os emails locais - configurado no mercury e recebido no thunderbird
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
        mail($to_email, $subject, $message, $headers); //função de email
    }

    //retorna a pagina inicial - rota view login
    public function HomePage()
    {
        return view('login', []);
    }

    //retorna a pagina inicial - rota view fornecedor
    public function DashBoard()
    {
        return view('dashboard', []);
    }

    public function GetResponsibleList()
    {
        $servername = "localhost"; //padrão - server local
        $database = "crud"; //nome do banco de dados
        $username = "root"; //padrão - root
        $password = ""; //senha de conexão com o bd

        //cria a conexão
        $conexao = mysqli_connect($servername, $username, $password, $database);
        $sql = "SELECT * FROM responsavel order by nome_responsavel ASC";
        $result = mysqli_query($conexao, $sql);

        $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $array;
    }

    public function ValidateLogin()
    {
        include 'password.php';

        $servername = "localhost"; //padrão - server local
        $database = "crud"; //nome do banco de dados
        $username = "root"; //padrão - root
        $password = ""; //senha de conexão com o bd

        //cria a conexão
        $conexao = mysqli_connect($servername, $username, $password, $database);

        $usuario = $_POST['usuario'];
        $senha_usuario = $_POST['senha'];

        $sql = "SELECT user_name, password FROM users WHERE user_name = '$usuario'";
        $buscar = mysqli_query($conexao, $sql);

        $total = mysqli_num_rows($buscar);

        while ($array = mysqli_fetch_array($buscar)) {
            $senha = $array['password'];

            $senhaDecodificada = sha1($senha_usuario);
            if ($total > 0) {
                if ($senhaDecodificada == $senha) {
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    //header('Location: /paineldecontrole');
                    return 0;
                } else {
                    return 1;
                }
            }
        }
        return 2;
    }

    public function RegisterLogin()
    {
        include 'password.php';
        $servername = "localhost"; //padrão - server local
        $database = "crud"; //nome do banco de dados
        $username = "root"; //padrão - root
        $password = ""; //senha de conexão com o bd

        //cria a conexão
        $conexao = mysqli_connect($servername, $username, $password, $database);

        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (user_name, email, password) values ('$user_name', '$email', sha1('$password'))";

        $sql2 = "SELECT user_name FROM users WHERE user_name = '$user_name'";
        $buscar = mysqli_query($conexao, $sql2);

        $total = mysqli_num_rows($buscar);

        if ($total > 0) {
            return 0;
        }

        mysqli_query($conexao, $sql);
        return 1;
    }

    public function Logout()
    {
        // remove all session variables
        session_unset();
        // destroy the session
        //session_destroy();
        //header('Location: login.blade.php');
        return true;
    }
}