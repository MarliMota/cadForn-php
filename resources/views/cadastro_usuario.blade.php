<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h4>Cadastro de usuário</h4>
    <br>
    <form action="inserir_usuario.php" method="POST">
      <div class="form-group">
        <label for="">Nome de usuário</label>
        <input type="text" name="usuario" class="form-control" require autocomplete="off">
      </div>
      <div class="form-group">
        <label for="">E-mail</label>
        <input type="email" name="email" class="form-control" require autocomplete="off">
      </div>
      <div class="form-group">
        <label for="">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" require autocomplete="off">
      </div>
      <div class="form-group">
        <label for="">Confirmar senha</label>
        <input type="password" name="n_senha" class="form-control" require autocomplete="off" oninput="validaSenha(this)">
        <small>Precisar igual a senha digitada acima</small>
      </div>
      <div class="form-group">
        <label for="">Nível de acesso</label>
        <select name="nivel" class="form-control">
          <option value="1">Administrador</option>
          <option value="2">funcionário</option>
          <option value="3">Lojista</option>
        </select>
      </div>
      <div class="botao-login">
        <button type="submit" class="btn btn-sucess">Salvar</button>
      </div>
    </form>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script>

  <script>
    function validaSenha(input) {
      if (input.value != document.getElementById('senha').value) {
        input.setCustomValidity("Repita a senha corretamente");
      } else {
        input.setCustomValidity("");
      }
    }
  </script>
</body>

</html>