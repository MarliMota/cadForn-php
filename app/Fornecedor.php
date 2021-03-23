<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model //criação da classe fornecedor(modelo que pode ler ou acrescentar dados no banco de dados)
{
  protected $fillable = ['nomeFantasia', 'razaoSocial', 'cnpj', 'telefone', 'celular', 'endereco', 'email', 'site', 'produto', 'contrato', 'observacao'];
}