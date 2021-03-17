<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;


//funções que salvam e preenchem a tabela
class FornecedorController extends Controller
{
    public $providersList;

    //salva os dados do fornecedor
    public function store(Request $request)
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

        return redirect('/');
    }

    //função que preenche a tabela
    public function fetchAll()
    {
        $providersList = Fornecedor::get(); //função get de dentro da classe fornecedor - informações do banco de dados

        $itemsByPage = 99;
        $pageNumber = 0;

        $data = ""; //variavel que armeza o código html gerado no js e que no futuro será enviado para dentro do elemento providersTable

        //contador de páginas
        $numberOfPages = ceil(count($providersList) / $itemsByPage);

        $numberOfPages = $numberOfPages > 0 ? $numberOfPages : 1;

        //se tiver pelo menos um fornecedor
        if (count($providersList) > 0) {
            //executa de acordo com a quantidade de fornecedores por página
            for ($i = 0; $i < $itemsByPage; $i++) {
                //interrompe a função assim que todos os fornecedores da página atual forem adicionados a tabela, mesmo que não tenha atingido o máximo de  fornecedores por páginas
                if (count($providersList) <= $pageNumber * $itemsByPage + $i) {
                    return view('fornecedor', ['providersList' => $data]);
                }
                //construção da tabela html
                $data .= '<tr>';
                $data .= '<td style="width:9%">' . $providersList[$pageNumber * $itemsByPage + $i]->nomeFantasia . '</td>';
                $data .= '<td style="width:9%">' . $providersList[$pageNumber * $itemsByPage + $i]->razaoSocial . '</td>';
                $data .= '<td style="width:9%">' . $providersList[$pageNumber * $itemsByPage + $i]->cnpj . '</td>';
                $data .= '<td style="width:9%">' . $providersList[$pageNumber * $itemsByPage + $i]->telefone . '</td>';
                $data .= '<td style="width:9%"> <Button onclick="ShowProviderDetails(' . $providersList[$pageNumber * $itemsByPage + $i]->id . ')" type="button" class="btn" id="details-btn"><i class="fa fa-ellipsis-h"></i> Detalhes</Button> </td>';
                $data .= '<td style="width:9%"> <Button onclick="EditProvider (' . (($pageNumber * $itemsByPage) + $i) . ')"  class="btn" id="edit-btn"><i class="fa fa-edit"></i> Editar</Button> </td>';
                $data .= '<td style="width:9%"> <button onclick="DeleteProvider(' . $providersList[$pageNumber * $itemsByPage + $i]->id . ')" type="button" class="btn-delete"><i class="fa fa-times"></i></button> </td>';
                $data .= '</tr>';
            }
        }
        $this->providersList = $data;
        view('fornecedor', ['providersList' => $this->providersList]); //retorna a view fornecedor e seta o valor do objeto providersList no html
        return redirect('/');
    }

    //função para excluir
    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect('/');
    }

    public function showDetails($id)
    {
        return $fornecedor = Fornecedor::findOrFail($id);



        //return redirect('/');
    }
}