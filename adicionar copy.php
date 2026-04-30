<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $instituicao = $_POST['instituicao'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $link = $_POST['link'];

    $sql = "INSERT INTO cursos (nome, instituicao, categoria, descricao, link, certificado_gratis) 
            VALUES ('$nome', '$instituicao', '$categoria', '$descricao', '$link', 'Sim')";

    if ($conexao->query($sql) === TRUE) {
        header("Location: admin.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Curso | Bússola do Saber</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="admin-body">
    <div class="card" style="max-width: 500px; margin: 40px auto; padding: 30px;">
        <h2 style="margin-top: 0;">➕ Novo Curso</h2>
        <p style="color: var(--text-secondary); margin-bottom: 25px;">Preencha os dados para cadastrar um novo curso.</p>
        
        <form method="POST">
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Nome do Curso</label>
            <input type="text" name="nome" placeholder="Ex: HTML5" required style="width:100%; padding:12px; margin-bottom:15px; box-sizing: border-box;">
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Instituição</label>
            <input type="text" name="instituicao" placeholder="Ex: SEBRAE" required style="width:100%; padding:12px; margin-bottom:15px; box-sizing: border-box;">
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Categoria</label>
            <input type="text" name="categoria" placeholder="Ex: TI / Programação" required style="width:100%; padding:12px; margin-bottom:15px; box-sizing: border-box;">
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Descrição Curta</label>
            <textarea name="descricao" required style="width:100%; padding:12px; margin-bottom:15px; height:100px; box-sizing: border-box;"></textarea>
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Link de Inscrição</label>
            <input type="url" name="link" placeholder="https://" required style="width:100%; padding:12px; margin-bottom:25px; box-sizing: border-box;">
            
            <button type="submit" class="btn" style="width:100%; border:none; cursor:pointer;">Salvar Curso</button>
        </form>
        
        <br>
        <a href="admin.php" style="color: var(--text-secondary); text-decoration:none;">← Voltar ao Painel</a>
    </div>
</body>
</html>