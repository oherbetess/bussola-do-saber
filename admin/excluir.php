<?php
include '../includes/conexao.php';
session_start();

if ($_SESSION['usuario_tipo'] == 'admin' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conexao, "DELETE FROM cursos WHERE id = $id");
}

header("Location: index.php");
exit();
?>
