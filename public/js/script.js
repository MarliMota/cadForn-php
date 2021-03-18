window.onload = function () {
  history.replaceState("", "", "/");
}//para não registrar um novo fornecedor -cópia do anterior - a cada vez que a página for atualizada



let providersList = []; // array que recebe a lista de fornecedores - todo novo fornecedor é adicionado a lista

//document.getElementById("pageOverlay") //seleciona um elemento do html
let pageOverlay = document.getElementById("pageOverlay"); //salva o elemento do html em uma variável

let providersTable = document.getElementById("providersTable"); //onde a tablea vai ser desenhada no html

let providersForm = document.getElementById("providersForm");

let itemsByPage = 4;
let pageNumber = 0;

//instância do objeto Provider que fica fixa na página principal
// let defaultProvider = new Provider(
//   "Marli",
//   "Mota",
//   "00.000.000/0000-00",
//   "(00)0000-0000",
//   "(00)00000-0000",
//   "Rua das ruas, 99 - São paulo SP",
//   "marli@mota.com",
//   "www.marli.com.br",
//   "Softwares",
//   "000000.0000-01"
// );

//providersList.push(defaultProvider);

//função que mostra/esconde a tela de Overlay
function SetPageOverlayVisibility(visible) {
  pageOverlay.style.display = visible ? "block" : "none";
  // if (visible) {
  //   pageOverlay.style.display = "block";//mostra a tela de cadastro 
  // } else {
  //   pageOverlay.style.display = "none";
  // }

  //   if (!visible) {
  //     //reseta os valores inseridos anteriormente
  //     document.getElementById('nomeFantasia').value = "";
  //     document.getElementById('razaoSocial').value = "";
  //     document.getElementById('cnpj').value = "";
  //     document.getElementById('telefone').value = "";
  //     document.getElementById('celular').value = "";
  //     document.getElementById('endereco').value = "";
  //     document.getElementById('email').value = "";
  //     document.getElementById('site').value = "";
  //     document.getElementById('produto').value = "";
  //     document.getElementById('contrato').value = "";
  //     document.getElementById('observacao').value = "";
  //     document.getElementById('addProviderButtonBox').style.display = "none";
  //     document.getElementById('detailsButtonBox').style.display = "none";
  //     document.getElementById('editButtonBox').style.display = "none";
  //     SetReadOnly(false);
  //   }
}

//mosta/esconde os botões e toda a tela de adicionar  
function SetNewProviderScreenVisibility(visible) {
  SetPageOverlayVisibility(visible);
  addProviderButtonBox.style.display = visible ? "flex" : "none";
}

//construtor do objeto Provider - contém todos os atributos que o fornecedor deve ter e o método que verifica se é válido
function Provider(nomeFantasia, razaoSocial, cnpj, telefone, celular, endereco, email, site, produto, contrato, observacao = "") {
  this.nomeFantasia = nomeFantasia;
  this.razaoSocial = razaoSocial;
  this.cnpj = cnpj;
  this.telefone = telefone;
  this.celular = celular;
  this.endereco = endereco;
  this.email = email;
  this.site = site;
  this.produto = produto;
  this.contrato = contrato;
  this.observacao = observacao;

  //função para validação dos campos do formulário
  this.IsValid = function () {

    if (this.nomeFantasia.length < 3 || this.nomeFantasia.length > 255) {
      alert("O nome deve ter pelo menos 3 caracteres!");
      return false;
    }
    if (this.razaoSocial.length < 3 || this.razaoSocial.length > 255) {
      alert("A razão social deve ter pelo menos 3 caracteres!");
      return false;
    }

    if (this.cnpj.length < 14) {
      alert("O CNPJ deve ter pelo menos 14 caracteres!");
      return false;
    }

    if (this.endereco.length < 20 || this.endereco.length > 255) {
      alert("O endereço deve ter pelo menos 20 caracteres!");
      return false;
    }

    if (this.telefone === "") {
      alert("Você deve digitar um telefone válido!");
      return false;
    }

    if (this.celular === "") {
      alert("Você deve digitar um celular válido!");
      return false;
    }

    //regex: lógica para padrões
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(this.email)) {
      alert("Você deve digitar um e-mail válido!");
      return false;
    }

    if (this.produto === "") {
      alert("Você deve digitar um produto!");
      return false;
    }

    if (this.contrato.length < "") {
      alert("Você deve digitar o número do contrato completo!");
      return false;
    }

    if (this.observacao.length > 255) {
      alert("Você excedeu o limite de 255 caracteres no campo observação!");
      return false;
    }
    return true;
  }
}

//função que salva e exibe na tela o novo fornecedor
function SaveNewProvider() {
  SetReadOnly(false);

  let currentProvider = new Provider(
    document.getElementById("nomeFantasia").value,
    document.getElementById('razaoSocial').value,
    document.getElementById('cnpj').value,
    document.getElementById('telefone').value,
    document.getElementById('celular').value,
    document.getElementById('endereco').value,
    document.getElementById('email').value,
    document.getElementById('site').value,
    document.getElementById('produto').value,
    document.getElementById('contrato').value,
    document.getElementById('observacao').value,
  );

  if (currentProvider.IsValid()) {
    //Se o fornecedor for válido, a action do formulário se torna criar e o metodo muda para Post - depois submit
    providersForm.action = "/criar";
    providersForm.method = "POST";
    providersForm.submit();
    //SetPageOverlayVisibility(false);
  }
}

//função excluir
function DeleteProvider(providerID) {
  if (window.confirm("Atenção! Isso vai excluir todos os dados do fornecedor. Deseja continuar?")) {
    providersForm.action = "/deletar/" + providerID;
    providersForm.method = "POST";
    providersForm.submit();
  }
  //verifica se todos os fornecedores acabaram, em caso positivo, volta uma página
  // if (pageNumber >= Math.ceil(providersList.length / itemsByPage)) {
  //   ChangePage(-1);
  // }
}

//função detalhes 
function ShowProviderDetails(providerID) {
  SetReadOnly(true);//bloqueia a edição dos dados
  document.getElementById("detailsButtonBox").style.display = "flex";//exibe os botões relacionados 
  FillOverlay(providerID);
}

//função editar
function EditProvider(providerID) {
  FillOverlay(providerID);
  SetReadOnly(false);

  document.getElementById("editButtonBox").style.display = "flex";//exibe os botões relacionados
  //configura o botão de confirmar edição para salvar os novos dados 
  document.getElementById("edit-confirm-btn").setAttribute("onClick", "javascript: SaveEditedProvider(" + providerID + ");");
}

//preenche os campos do overlay com os dados do fornecedor escolhido
function FillOverlay(providerID) {

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("providersForm").innerHTML = this.responseText;
      selectedProvider = JSON.parse(this.responseText);//converte o texto que o servidor retornou para Json

      document.getElementById("nomeFantasia").value = selectedProvider.nomeFantasia;
      document.getElementById('razaoSocial').value = selectedProvider.razaoSocial;
      document.getElementById('cnpj').value = selectedProvider.cnpj;
      document.getElementById('telefone').value = selectedProvider.telefone;
      document.getElementById('celular').value = selectedProvider.celular;
      document.getElementById('endereco').value = selectedProvider.endereco;
      document.getElementById('email').value = selectedProvider.email;
      document.getElementById('site').value = selectedProvider.site;
      document.getElementById('produto').value = selectedProvider.produto;
      document.getElementById('contrato').value = selectedProvider.contrato;
      document.getElementById('observacao').value = selectedProvider.observacao;

      SetPageOverlayVisibility(true);
    }
  }
  xmlhttp.open("GET", "/ler/" + providerID, true);
  xmlhttp.send();

}


function SaveEditedProvider(providerID) {
  if (!window.confirm("Atenção! Isso pode alterar os dados do fornecedor. Deseja continuar?")) {
    return;
  }

  //Cria um objeto fornecedor com todas as informações contidas nos campos de edição
  let provider = new Provider(
    document.getElementById('nomeFantasia').value,
    document.getElementById('razaoSocial').value,
    document.getElementById('cnpj').value,
    document.getElementById('telefone').value,
    document.getElementById('celular').value,
    document.getElementById('endereco').value,
    document.getElementById('email').value,
    document.getElementById('site').value,
    document.getElementById('produto').value,
    document.getElementById('contrato').value,
    document.getElementById('observacao').value
  );

  //Caso todas as informações sejam válidas atualiza a lista de fornecedores e esconde os campos de edição
  if (provider.IsValid()) {
    providersForm.action = "/atualizar/" + providerID;
    providersForm.method = "POST";
    providersForm.submit();

    //fecha a página
    //SetPageOverlayVisibility(false);
  }
};

//função para mudança de páginas
function ChangePage(changeBy) {
  providersForm.action = "/" + changeBy;
  providersForm.method = "POST";
  providersForm.submit();
}

//função editar campos (para tornar detalhes ineditável)
SetReadOnly = function (value) {
  document.getElementById("nomeFantasia").readOnly = value;
  document.getElementById("razaoSocial").readOnly = value;
  document.getElementById("cnpj").readOnly = value;
  document.getElementById("telefone").readOnly = value;
  document.getElementById("celular").readOnly = value;
  document.getElementById("endereco").readOnly = value;
  document.getElementById("email").readOnly = value;
  document.getElementById("site").readOnly = value;
  document.getElementById("produto").readOnly = value;
  document.getElementById("contrato").readOnly = value;
  document.getElementById("observacao").readOnly = value;
}

//função imprimir detalhes
function Print() {
  //para botões não aparecerem na impressão
  document.getElementById("detailsButtonBox").style.display = "none";
  window.print();
  document.getElementById("detailsButtonBox").style.display = "flex";
}

//mascara jquery para preenchimento do formulario
$(document).ready(function ($) {
  $("#cnpj").mask("99.999.999/9999-99");
});

$(document).ready(function ($) {
  $("#telefone").mask("(99)9999-9999");
});

$(document).ready(function ($) {
  $("#celular").mask("(99)99999-9999");
});

$(document).ready(function ($) {
  $("#contrato").mask("999999.9999-99");
});