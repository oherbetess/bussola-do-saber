<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $_SESSION['usuario'] = $resultado->fetch_assoc();
        header("Location: admin.php"); // Se der certo, vai para o painel
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display:flex; align-items:center; justify-content:center; height:100vh;">
    <div class="card" style="width: 350px;">
        <h2>🔐 Acesso Restrito</h2>
        <?php if(isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="E-mail" required style="width:100%; padding:10px; margin-bottom:10px;">
            <input type="password" name="senha" placeholder="Senha" required style="width:100%; padding:10px; margin-bottom:10px;">
            <button type="submit" class="btn" style="width:100%; cursor:pointer;">Entrar no Painel</button>
        </form>
        <p><a href="index.php" style="text-decoration:none; color:gray; font-size:0.8rem;">← Voltar para o site</a></p>
    </div>
</body>
</html>