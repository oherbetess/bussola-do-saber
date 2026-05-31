<?php
include 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    // Criptografa a senha antes de salvar
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o email já existe
    $sql_check = "SELECT id FROM usuarios WHERE email = '$email'";
    $query_check = mysqli_query($conexao, $sql_check);

    if (mysqli_num_rows($query_check) > 0) {
        echo "<script>alert('Este e-mail já está em uso!'); window.history.back();</script>";
    } else {
        // Insere como tipo 'comum' por padrão
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', 'comum')";
        if (mysqli_query($conexao, $sql)) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location='login.php';</script>";
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }
}
?>