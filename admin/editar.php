<?php 
include '../includes/header.php'; 
if ($_SESSION['usuario_tipo'] != 'admin') { die("Acesso negado"); }

$id = $_GET['id'];
$resultado = mysqli_query($conexao, "SELECT * FROM cursos WHERE id = $id");
$curso = mysqli_fetch_assoc($resultado);

// LÓGICA PARA SALVAR ALTERAÇÃO
if (isset($_POST['atualizar'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $inst = mysqli_real_escape_string($conexao, $_POST['instituicao']);
    $cat  = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $link = mysqli_real_escape_string($conexao, $_POST['link']);
    $desc = mysqli_real_escape_string($conexao, $_POST['descricao']);

    $sql = "UPDATE cursos SET nome='$nome', instituicao='$inst', categoria='$cat', link_acesso='$link', descricao='$desc' WHERE id=$id";
    mysqli_query($conexao, $sql);
    header("Location: index.php?msg=editado");
}
?>

<div class="container">
    <h2>Editar Curso</h2>
    <div class="card">
        <form method="POST">
            <input type="text" name="nome" value="<?php echo $curso['nome']; ?>" required>
            <input type="text" name="instituicao" value="<?php echo $curso['instituicao']; ?>" required>
            <input type="text" name="categoria" value="<?php echo $curso['categoria']; ?>" required>
            <input type="url" name="link" value="<?php echo $curso['link_acesso']; ?>" required>
            <textarea name="descricao" rows="3"><?php echo $curso['descricao']; ?></textarea>
            <button type="submit" name="atualizar" class="btn-azul">Salvar Alterações</button>
            <a href="index.php" style="color: #ccc; margin-left: 10px;">Cancelar</a>
        </form>
    </div>
</div>