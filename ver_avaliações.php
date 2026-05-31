<?php 
session_start();
include 'includes/header.php'; 
include 'includes/conexao.php';

$curso_id = (int)$_GET['id'];

// 1. Busca os dados do curso
$res_curso = mysqli_query($conexao, "SELECT nome, instituicao FROM cursos WHERE id = $curso_id");
$curso = mysqli_fetch_assoc($res_curso);

// 2. Busca todas as avaliações e o nome de quem avaliou
$sql_aval = "SELECT a.*, u.nome AS usuario_nome 
             FROM avaliacoes a 
             JOIN usuarios u ON a.usuario_id = u.id 
             WHERE a.curso_id = $curso_id 
             ORDER BY a.data_avaliacao DESC";
$res_aval = mysqli_query($conexao, $sql_aval);
?>

<div class="container">
    <a href="cursos.php" style="color: #888; text-decoration: none; font-size: 0.9rem;">← Voltar para cursos</a>
    
    <h2 style="margin-top: 20px;">Avaliações de: <span style="color: #00A3FF;"><?php echo htmlspecialchars($curso['nome']); ?></span></h2>
    <p style="color: #666;"><?php echo htmlspecialchars($curso['instituicao']); ?></p>

    <div style="margin-top: 30px;">
        <?php if (mysqli_num_rows($res_aval) > 0): ?>
            <?php while ($aval = mysqli_fetch_assoc($res_aval)): ?>
                <div style="background: #262626; padding: 20px; border-radius: 10px; border: 1px solid #333; margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <strong style="color: #eee;"><?php echo htmlspecialchars($aval['usuario_nome']); ?></strong>
                        <span style="color: #ffc107;"><?php echo str_repeat('⭐', $aval['nota']); ?></span>
                    </div>
                    <p style="color: #ccc; font-style: italic; margin: 0;">
                        "<?php echo nl2br(htmlspecialchars($aval['comentario'])); ?>"
                    </p>
                    <small style="color: #555; display: block; margin-top: 10px;">
                        Postado em: <?php echo date('d/m/Y H:i', strtotime($aval['data_avaliacao'])); ?>
                    </small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: #666;">Ainda não há comentários detalhados para este curso.</p>
        <?php endif; ?>
    </div>

    <div style="margin-top: 40px; text-align: center;">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="avaliar.php?id=<?php echo $curso_id; ?>" class="btn-azul">Deixar minha avaliação</a>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>