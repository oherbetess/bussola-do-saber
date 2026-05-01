<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_curso = $_POST['id_curso'];
    $nome_aluno = $_POST['nome_aluno'];
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO avaliacoes (id_curso, nome_aluno, nota, comentario) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("isis", $id_curso, $nome_aluno, $nota, $comentario);

    if ($stmt->execute()) {
        header("Location: index.php?sucesso=1");
    } else {
        echo "Erro ao salvar: " . $conexao->error;
    }
}
?>