<?php
// Exemplo de conexão - Altere para os seus dados locais
$host = "localhost";
$usuario_db = "SEU_USUARIO";
$senha_db = "SUA_SENHA";
$nome_db = "bussola_do_saber";

$conexao = mysqli_connect($host, $usuario_db, $senha_db, $nome_db);

if (!$conexao) {
    die("Erro ao conectar: " . mysqli_connect_error());
}

mysqli_set_charset($conexao, "utf8mb4");
?>