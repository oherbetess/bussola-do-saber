<?php
session_start();
include '../includes/conexao.php';

// SEGURANÇA: Só permite se for admin
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Lógica para salvar o curso quando clicar no botão
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $instituicao = mysqli_real_escape_string($conexao, $_POST['instituicao']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $link = mysqli_real_escape_string($conexao, $_POST['link_acesso']);

    $sql = "INSERT INTO cursos (nome, instituicao, categoria, link_acesso) VALUES ('$nome', '$instituicao', '$categoria', '$link')";
    
    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Curso adicionado com sucesso!'); window.location='index.php';</script>";
    } else {
        echo "Erro: " . mysqli_error($conexao);
    }
}

include '../includes/header.php'; 
?>

<div class="container" style="max-width: 600px;">
    <h2>➕ Adicionar Novo Curso</h2>
    <form action="" method="POST" style="background: #262626; padding: 20px; border-radius: 10px;">
        <label>Nome do Curso:</label>
        <input type="text" name="nome" required placeholder="Ex: Python para Iniciantes">

        <label>Instituição:</label>
        <input type="text" name="instituicao" required placeholder="Ex: Fundação Bradesco">

        <label>Categoria:</label>
        <select name="categoria">
            <option value="Tecnologia">Tecnologia</option>
            <option value="Programação">Programação</option>
            <option value="Marketing">Marketing</option>
            <option value="Design">Design</option>
            <option value="Outros">Outros</option>
        </select>

        <label>Link de Acesso:</label>
        <input type="url" name="link_acesso" required placeholder="https://link-do-curso.com">

        <button type="submit" class="btn-azul" style="width: 100%; margin-top: 20px;">Salvar Curso</button>
        <a href="index.php" style="display: block; text-align: center; color: #888; margin-top: 15px; text-decoration: none;">Voltar ao Painel</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>