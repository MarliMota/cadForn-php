<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CadForn - Login</title>
  <!--seo-->
  <meta property="og:title" content="CadForn - Cadastro de Fornecedores" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://marlimota.github.io/cadForn/" />
  <meta property="og:description" content="Sistema desenvolvido com Laravel para cadastro de Fornecedores" />

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

<body class="background">

  <center>
    <div class="loginScreenSize">
      <h2>CadForn</h2>
      <hr>
      <div class="form-group">
        <label for="">Usuário</label>
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="usuário" autocomplete="off"
          required>
      </div>
      <div class="form-group registerElement" id="emailBox">
        <label for="">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="email" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label for="">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" placeholder="senha" autocomplete="off"
          required>
      </div>
      <div class="form-group registerElement" id="senhaBox">
        <label for="">Confirmar senha</label>
        <input type="password" name="confirmaSenha" id="confirmaSenha" class="form-control" placeholder="senha"
          autocomplete="off" oninput="validaSenha(this)" required>

      </div>
      <div id="LoginButton">
        <button onclick="ValidateLogin()" type="button" class="btn btn-sucess loginButton">Entrar</button>
      </div>
      <div class="registerElement" id="RegisterButton">
        <button onclick="RegisterLogin()" type="button" class="btn btn-sucess loginButton">Cadastrar</button>
      </div>
    </div>
    </div>
    <div class="loginRegister" id="registerText">
      <p> Não possui cadastro? Clique<a href="#" onclick="ShowRegisterElement()"> aqui</a>
    </div>
    <div class="loginRegister registerElement" id="loginText">
      <p> Já possui cadastro? Clique<a href="/" onclick="ShowLoginElement()"> aqui</a>
    </div>
  </center>

  <script src="js/login_script.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script>
</body>

</html>