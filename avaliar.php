<?php 
include 'includes/header.php'; 
include 'includes/conexao.php';

$curso_id = $_GET['id'];
// Busca dados do curso para mostrar o nome
$res = mysqli_query($conexao, "SELECT nome FROM cursos WHERE id = $curso_id");
$curso = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $nota = $_POST['nota'];
    $comentario = mysqli_real_escape_string($conexao, $_POST['comentario']);

    $sql = "INSERT INTO avaliacoes (usuario_id, curso_id, nota, comentario) VALUES ('$usuario_id', '$curso_id', '$nota', '$comentario')";
    
    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Avaliação enviada!'); window.location='cursos.php';</script>";
    }
}
?>

<div class="container" style="max-width: 500px;">
    <h2>Avaliar Curso: <span style="color: #00A3FF;"><?php echo $curso['nome']; ?></span></h2>
    <form action="" method="POST" class="card">
        <label>Nota (1 a 5):</label>
        <select name="nota" required>
            <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
            <option value="4">⭐⭐⭐⭐ (Muito Bom)</option>
            <option value="3">⭐⭐⭐ (Bom)</option>
            <option value="2">⭐⭐ (Regular)</option>
            <option value="1">⭐ (Ruim)</option>
        </select>

        <label>Seu Comentário:</label>
        <textarea name="comentario" rows="4" placeholder="O que achou do curso?" required></textarea>

        <button type="submit" class="btn-azul" style="width: 100%;">Enviar Avaliação</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>