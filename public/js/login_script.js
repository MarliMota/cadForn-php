//valida o login
function ValidateLogin() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let result = JSON.parse(this.responseText);
      switch (result) {
        case 0:
          window.location.pathname = "/paineldecontrole";
          break;
        case 1:
          alert("Senha incorreta!");
          break;
        case 2:
          alert("Usuário não cadastrado!");
          break;
      }
    }
  }

  let nomeUsuario = document.getElementById("usuario").value;
  let senha = document.getElementById("senha").value;

  xmlhttp.open("POST", "/validarlogin", true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send("usuario=" + nomeUsuario + "&senha=" + senha);
}

//confere se as duas senhas são iguais
function validaSenha(input) {
  if (input.value != document.getElementById('senha').value) {
    input.setCustomValidity("Repita a senha corretamente");
  } else {
    input.setCustomValidity("");
  }
}

//mostra os campos para cadastro
function ShowRegisterElement() {
  document.getElementById('emailBox').style.display = 'block';
  document.getElementById('senhaBox').style.display = 'block';
  document.getElementById('RegisterButton').style.display = 'block';
  document.getElementById('loginText').style.display = 'block';
  document.getElementById('registerText').style.display = 'none';
  document.getElementById('LoginButton').style.display = 'none';
}

//mostra os campos para login
function ShowLoginElement() {
  document.getElementById('emailBox').style.display = 'none';
  document.getElementById('senhaBox').style.display = 'none';
  document.getElementById('RegisterButton').style.display = 'none';
  document.getElementById('loginText').style.display = 'none';
  document.getElementById('registerText').style.display = 'block';
  document.getElementById('LoginButton').style.display = 'block';
}

//cadastra novos usuarios
function RegisterLogin() {

  if (!ValidateData()) {
    return;
  }

  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let result = JSON.parse(this.responseText);
      switch (result) {
        case 0:
          alert("Esse nome de usuario já está cadastrado.");
          break;
        case 1:
          alert("Usuário cadastrado com sucesso!")
          window.location.pathname = "/paineldecontrole";
          break;
      }
    }
  }

  let user_name = document.getElementById("usuario").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("senha").value;

  xmlhttp.open("POST", "/cadastrarusuario", true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send("user_name=" + user_name + "&password=" + password + "&email=" + email);
}

function ValidateData() {
  let user_name = document.getElementById("usuario").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("senha").value;

  if (user_name == "" || email == "" || password == "") {
    alert("Preencha todos os campos!");
    return false;
  } else {
    return true;
  }
}
