<?php
session_start();
include 'includes/conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Busca o caminho do arquivo para deletar da pasta
    $res = mysqli_query($conexao, "SELECT arquivo_path FROM certificados WHERE id = $id AND usuario_id = $usuario_id");
    $cert = mysqli_fetch_assoc($res);

    if ($cert) {
        unlink("uploads/" . $cert['arquivo_path']); // Apaga o arquivo real
        mysqli_query($conexao, "DELETE FROM certificados WHERE id = $id"); // Apaga do banco
    }
}

header("Location: perfil.php");
?>