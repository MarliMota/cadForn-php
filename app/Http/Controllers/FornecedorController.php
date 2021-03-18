<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use Mockery\Undefined;


//funções crud
class FornecedorController extends Controller
{
    //public $providersList;

    public $pageNumber = 0;
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

        return redirect('/'); //recarrega a página 
    }

    //função que preenche a tabela
    public function ReadAll()
    {

        $providersList = Fornecedor::get(); //função get de dentro da classe fornecedor - informações do banco de dados

        $data = ""; //variavel que armeza o código html gerado no js e que no futuro será enviado para dentro do elemento providersTable

        //contador de páginas
        $numberOfPages = ceil(count($providersList) / $this->itemsByPage);

        $numberOfPages = $numberOfPages > 0 ? $numberOfPages : 1;

        //se tiver pelo menos um fornecedor
        if (count($providersList) > 0) {
            //executa de acordo com a quantidade de fornecedores por página
            for ($i = 0; $i < $this->itemsByPage; $i++) {
                //interrompe a função assim que todos os fornecedores da página atual forem adicionados a tabela, mesmo que não tenha atingido o máximo de  fornecedores por páginas
                if (count($providersList) <= $this->pageNumber * $this->itemsByPage + $i) {
                    return view('fornecedor', ['providersList' => $data]);
                }
                //construção da tabela html
                $data .= '<tr>';
                $data .= '<td style="width:9%">' . $providersList[$this->pageNumber * $this->itemsByPage + $i]->nomeFantasia . '</td>';
                $data .= '<td style="width:9%">' . $providersList[$this->pageNumber * $this->itemsByPage + $i]->razaoSocial . '</td>';
                $data .= '<td style="width:9%">' . $providersList[$this->pageNumber * $this->itemsByPage + $i]->cnpj . '</td>';
                $data .= '<td style="width:9%">' . $providersList[$this->pageNumber * $this->itemsByPage + $i]->telefone . '</td>';
                $data .= '<td style="width:9%"> <Button onclick="ShowProviderDetails(' . $providersList[$this->pageNumber * $this->itemsByPage + $i]->id . ')" type="button" class="btn" id="details-btn"><i class="fa fa-ellipsis-h"></i> Detalhes</Button> </td>';
                $data .= '<td style="width:9%"> <Button onclick="EditProvider (' . $providersList[$this->pageNumber * $this->itemsByPage + $i]->id . ')"  class="btn" id="edit-btn"><i class="fa fa-edit"></i> Editar</Button> </td>';
                $data .= '<td style="width:9%"> <button onclick="DeleteProvider(' . $providersList[$this->pageNumber * $this->itemsByPage + $i]->id . ')" type="button" class="btn-delete"><i class="fa fa-times"></i></button> </td>';
                $data .= '</tr>';
            }
        }
        $this->providersList = $data;
        return view('fornecedor', ['providersList' => $this->providersList]); //retorna a view fornecedor e seta o valor do objeto providersList no html
    }


    public function Read($id)
    {
        return Fornecedor::findOrFail($id); //acessa o banco de dados e encontra um elemento pelo id
    }

    //função para excluir
    public function Delete($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect('/');
    }

    //Função editar
    public function Update(Request $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

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

        return redirect('/');
    }

    public function ChangePageBy($changeBy)
    {
        if ($this->pageNumber + $changeBy >= 0 && $this->pageNumber + $changeBy < ceil(count(Fornecedor::get()) / $this->itemsByPage)) {
            $this->pageNumber += $changeBy;
        }

        return $this->ReadAll();
    }
}
