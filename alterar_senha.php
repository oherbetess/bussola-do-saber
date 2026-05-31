<?php 
include 'includes/header.php'; 
include 'includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // 1. Buscar a senha atual no banco para comparar
    $res = mysqli_query($conexao, "SELECT senha FROM usuarios WHERE id = $usuario_id");
    $user = mysqli_fetch_assoc($res);

    if (password_verify($senha_atual, $user['senha'])) {
        // 2. Verificar se as novas senhas coincidem
        if ($nova_senha === $confirmar_senha) {
            // 3. Criptografar e salvar a nova senha
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET senha = '$nova_senha_hash' WHERE id = $usuario_id";
            
            if (mysqli_query($conexao, $sql)) {
                echo "<script>alert('Senha alterada com sucesso!'); window.location='perfil.php';</script>";
            }
        } else {
            echo "<script>alert('A nova senha e a confirmação não coincidem!');</script>";
        }
    } else {
        echo "<script>alert('Sua senha atual está incorreta!');</script>";
    }
}
?>

<div class="container" style="max-width: 450px;">
    <h2>🔐 Alterar Minha Senha</h2>
    <form action="" method="POST" class="card">
        <label>Senha Atual:</label>
        <input type="password" name="senha_atual" required placeholder="Digite sua senha de hoje">

        <label>Nova Senha:</label>
        <input type="password" name="nova_senha" required placeholder="Digite a nova senha">

        <label>Confirme a Nova Senha:</label>
        <input type="password" name="confirmar_senha" required placeholder="Repita a nova senha">

        <button type="submit" class="btn-azul" style="width: 100%; margin-top: 10px;">Atualizar Senha</button>
        <a href="perfil.php" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none;">Cancelar</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>