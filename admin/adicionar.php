<?php
session_start();
include '../includes/conexao.php';

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../login.php"); exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $inst = mysqli_real_escape_string($conexao, $_POST['instituicao']);
    $cat = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $link = mysqli_real_escape_string($conexao, $_POST['link_acesso']);
    $desc = mysqli_real_escape_string($conexao, $_POST['descricao']);

    $sql = "INSERT INTO cursos (nome, instituicao, categoria, link_acesso, descricao) VALUES ('$nome', '$inst', '$cat', '$link', '$desc')";
    
    if (mysqli_query($conexao, $sql)) {
        header("Location: index.php"); exit();
    }
}

include '../includes/header.php'; 
?>

<div class="container" style="max-width: 600px;">
    <h2>Cadastrar Novo Curso</h2>
    <form action="" method="POST" class="card">
        <label>Nome do Curso:</label>
        <input type="text" name="nome" required>

        <label>Instituição:</label>
        <input type="text" name="instituicao" required>

        <label>Categoria:</label>
        <input type="text" name="categoria" required>

        <label>Link de Acesso:</label>
        <input type="url" name="link_acesso" required>

        <label>Descrição Breve:</label>
        <textarea name="descricao" rows="4" required maxlength="255"></textarea>

        <button type="submit" class="btn-azul" style="width: 100%; margin-top: 10px;">Salvar Curso</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>