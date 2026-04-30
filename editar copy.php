<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }

$id = $_GET['id'];
$curso = $conexao->query("SELECT * FROM cursos WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $instituicao = $_POST['instituicao'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $link = $_POST['link'];

    $sql = "UPDATE cursos SET nome='$nome', instituicao='$instituicao', categoria='$categoria', 
            descricao='$descricao', link='$link' WHERE id=$id";

    if ($conexao->query($sql) === TRUE) {
        header("Location: admin.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso | Bússola do Saber</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="admin-body">
    <div class="card" style="max-width: 500px; margin: 40px auto; padding: 30px;">
        <h2 style="margin-top: 0;">📝 Editar Curso</h2>
        
        <form method="POST">
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Nome do Curso</label>
            <input type="text" name="nome" value="<?= $curso['nome'] ?>" required style="width:100%; padding:12px; margin-bottom:15px; box-sizing: border-box;">
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Instituição</label>
            <input type="text" name="instituicao" value="<?= $curso['instituicao'] ?>" required style="width:100%; padding:12px; margin-bottom:15px; box-sizing: border-box;">
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Categoria</label>
            <input type="text" name="categoria" value="<?= $curso['categoria'] ?>" required style="width:100%; padding:12px; margin-bottom:15px; box-sizing: border-box;">
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Descrição Curta</label>
            <textarea name="descricao" required style="width:100%; padding:12px; margin-bottom:15px; height:100px; box-sizing: border-box;"><?= $curso['descricao'] ?></textarea>
            
            <label style="color: var(--text-secondary); display: block; margin-bottom: 5px;">Link de Inscrição</label>
            <input type="url" name="link" value="<?= $curso['link'] ?>" required style="width:100%; padding:12px; margin-bottom:25px; box-sizing: border-box;">
            
            <button type="submit" class="btn" style="width:100%; border:none; cursor:pointer;">Salvar Alterações</button>
        </form>
        
        <br>
        <a href="admin.php" style="color: var(--text-secondary); text-decoration:none;">← Voltar ao Painel</a>
    </div>
</body>
</html>