<?php
session_start();
include 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
        $usuario = mysqli_fetch_assoc($query);

        // O segredo está aqui: password_verify
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Senha inválida!'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location='login.php';</script>";
    }
}
?>