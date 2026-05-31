<?php
include 'includes/conexao.php';
if (!isset($_SESSION['usuario_id'])) { exit("Acesso negado"); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['usuario_id'];
    $curso_nome = mysqli_real_escape_string($conexao, $_POST['curso_nome']);
    $url = mysqli_real_escape_string($conexao, $_POST['url_certificado']);

    $sql = "INSERT INTO certificados (usuario_id, curso_nome, arquivo_url) VALUES ('$user_id', '$curso_nome', '$url')";
    mysqli_query($conexao, $sql);
    header("Location: perfil.php");
}
?>