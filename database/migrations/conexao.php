<?php

$servername = "localhost"; //padrão - server local
$database = "crud"; //nome do banco de dados
$username = "root"; //padrão - root
$password = ""; //senha de conexão com o bd
//cria a conexão
$conexao = mysqli_connect($servername, $username, $password, $database);
