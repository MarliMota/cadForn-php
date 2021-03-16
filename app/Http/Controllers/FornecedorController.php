<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{

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

        return $this->fetchAll();
    }

    public function fetchAll()
    {
        $providersList = Fornecedor::get();

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
                $data .= '<td style="width:9%"> <Button onclick="ShowProviderDetails(' . (($pageNumber * $itemsByPage) + $i) . ')" class="btn" id="details-btn"><i class="fa fa-ellipsis-h"></i> Detalhes</Button> </td>';
                $data .= '<td style="width:9%"> <Button onclick="EditProvider (' . (($pageNumber * $itemsByPage) + $i) . ')"  class="btn" id="edit-btn"><i class="fa fa-edit"></i> Editar</Button> </td>';
                $data .= '<td style="width:9%"> <button onclick="DeleteProvider(' . (($pageNumber * $itemsByPage) + $i) . ')" class="btn-delete"><i class="fa fa-times"></i></button> </td>';
                $data .= '</tr>';
            }
        }
        return view('fornecedor', ['providersList' => $data]);
    }
}