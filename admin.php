<?php 
session_start();
include 'db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $conexao->query("DELETE FROM cursos WHERE id = $id");
    header("Location: admin.php");
}

$resultado = $conexao->query("SELECT * FROM cursos");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo | Bússola do Saber</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="admin-body">

    <div style="max-width: 1100px; margin: 0 auto;">
        
        <header style="text-align: left; padding: 0 0 20px 0; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="font-size: 2rem;">Painel de Controle</h1>
                <p style="margin: 5px 0 0; font-size: 1rem;">Bem-vindo, <strong><?= $_SESSION['usuario']['nome'] ?></strong>! (<a href="alterar_senha.php" style="color: var(--text-secondary);">Alterar Senha</a>)</p>
            </div>
            <a href="logout.php" style="background: #e74c3c; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">Sair com segurança</a>
        </header>

        <div style="margin: 30px 0 20px; display: flex; justify-content: space-between; align-items: center;">
            <a href="adicionar.php" class="btn-add">+ Adicionar Novo Curso</a>
            <a href="index.php" style="color: var(--text-secondary); text-decoration: none; font-weight: 500;">← Voltar ao site público</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Instituição</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td style="color: var(--text-primary); font-weight: 500;"><?= $row['nome'] ?></td>
                    <td><?= $row['instituicao'] ?></td>
                    <td style="text-align: center;">
                        <a href="editar.php?id=<?= $row['id'] ?>" class="btn-edit">Editar</a>
                        <a href="?excluir=<?= $row['id'] ?>" class="btn-del" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>

</body>
</html>