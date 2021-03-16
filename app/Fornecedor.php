<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
  protected $fillable = ['nomeFantasia', 'razaoSocial', 'cnpj', 'telefone', 'celular', 'endereco', 'email', 'site', 'produto', 'contrato', 'observacao'];
}
