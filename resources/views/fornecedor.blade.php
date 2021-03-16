<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CadForn</title>
  <!--seo-->
  <meta property="og:title" content="CadForn - Cadastro de Fornecedores" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://marlimota.github.io/cadForn/" />
  <meta property="og:description" content="Sistema desenvolvido para cadastro de Fornecedores" />

  <meta property="og:image" content="https://i.imgur.com/Z6p2FmW.jpg">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="885">
  <meta property="og:image:height" content="440">
  <!--favicon-->
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
  <!--Estilos-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
  <!--Links jquery-->
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
  <script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
  </script>
</head>

<body>

  <nav class="barraSuperior">
    <div class="barraSuperiorLogo">
      <h1>CadForn</h1>
      <h4>Cadastro de Fornecedores</h4>
    </div>
  </nav>

  <div class="cadastro">
    <section class="title">
      <h2>Fornecedores</h2>
      <div class="titleButton">
        <button class="btn" onclick="SetNewProviderScreenVisibility(true)"><i class="fa fa-plus"></i> Adicionar</button>
        <button class="btn"> Atualizar</button>
      </div>
    </section>
    <section class="providers">
      <div>
        <table class="table table-striped">
          <thead class="table-title">
            <tr>
              <th>Nome Fantasia</th>
              <th>Razão Social</th>
              <th>CNPJ</th>
              <th>Telefone</th>
              <th>Ações</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            echo "{$providersList}"
            ?>
            <!--espaço reservado para a tabela que é criada pela função FetchAll-->
          </tbody>
        </table>
      </div>
    </section>
    <section class="arrows">
      <!--setas para mudança de página-->
      <div id="numberPage"></div>
      <a id="previewButton" onclick="ChangePage(-1)"><i class="fa fa-chevron-left"></i></a>
      <a id="nextButton" onclick="ChangePage(1)"><i class="fa fa-chevron-right"></i></a>
    </section>
  </div>


  <!--toda a parte que aparece sobrepondo a tela principal - nova página que aparece acima da anterior 
  - tabela, botões e "sombra cinza"-->
  <div id="pageOverlay">
    <div class="cadastro">
      <form action="{{ route('registrar_fornecedor') }}" method="POST">
        @csrf
        <section class="providers" id="overlayWhiteBox">
          <table id="itens" class="table table-striped">
            <tr>
              <th>Nome Fantasia</th>
              <td> <input type="text" name="nomeFantasia" id="nomeFantasia" placeholder="Nome Fantasia"
                  autocomplete="off"></td>
            </tr>
            <tr>
              <th>Razão Social</th>
              <td> <input type="text" name="razaoSocial" id="razaoSocial" placeholder="Razão Social" autocomplete="off">
              </td>
            </tr>
            <tr>
              <th>CNPJ</th>
              <td> <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" autocomplete="off"></td>
            </tr>
            <tr>
              <th>Telefone</th>
              <td> <input type="tel" name="telefone" id="telefone" placeholder="Telefone" autocomplete="off"></td>
            </tr>
            <tr>
              <th>Celular</th>
              <td> <input type="tel" name="celular" id="celular" placeholder="Celular" autocomplete="off"></td>
            </tr>
            <tr>
              <th>Endereço</th>
              <td> <input type="text" name="endereco" id="endereco" placeholder="Endereço" autocomplete="off"></td>
            </tr>
            <tr>
              <th>E-mail</th>
              <td> <input type="email" name="email" id="email" placeholder="E-mail" autocomplete="off"></td>
            </tr>
            <tr>
              <th>Site</th>
              <td> <input type="text" name="site" id="site" placeholder="Site" autocomplete="off"></td>
            </tr>
            <tr>
              <th>Produto</th>
              <td> <input type="text" name="produto" id="produto" placeholder="Produto" autocomplete="off"></td>
            </tr>
            <tr>
              <th>Contrato</th>
              <td> <input type="text" name="contrato" id="contrato" placeholder="Contrato" autocomplete="off"></td>
            </tr>
            <tr>
              <th>Observação</th>
              <td> <textarea type="text" name="observacao" id="observacao" placeholder="Observação"
                  autocomplete="none"> </textarea> </td>
            </tr>
          </table>

        </section>

        <!--botões-->
        <section class="buttonBoxes" id="addProviderButtonBox">
          <Button type="button" onclick="SetPageOverlayVisibility (false)" class="btn cancel"
            id="newprovider-cancel-btn"><i class="fa fa-trash"></i>
            Descartar</Button>
          <Button class="btn confirm" id="newprovider-confirm-btn"><i class="fa fa-check"></i>
            Salvar</Button>
        </section>
        <section class="buttonBoxes" id="detailsButtonBox">
          <Button type="button" onclick="SetPageOverlayVisibility(false)" class="btn cancel" id="details-cancel-btn"><i
              class="fa fa-times"></i> Fechar</Button>
          <button onclick="Print()" class="btn confirm"><i class="fa fa-print"></i> Imprimir</button>
        </section>
        <section class="buttonBoxes" id="editButtonBox">
          <Button type="button" onclick="SetPageOverlayVisibility (false)" class="btn cancel" id="edit-cancel-btn"><i
              class="fa fa-times"></i>
            Cancelar</Button>
          <Button class="btn confirm" id="edit-confirm-btn"><i class="fa fa-check"></i>
            Salvar</Button>
        </section>
      </form>
    </div>
  </div>

  <script src="js/script.js"></script>
</body>

</html>