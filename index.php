<?php 
include 'db.php'; 

// Buscamos os cursos e a média de avaliações de cada um
$query = "SELECT c.*, 
          IFNULL(AVG(a.nota), 0) as media_nota, 
          COUNT(a.id) as total_votos 
          FROM cursos c 
          LEFT JOIN avaliacoes a ON c.id = a.id_curso 
          GROUP BY c.id";

$resultado = $conexao->query($query);
$res_cat = $conexao->query("SELECT DISTINCT categoria FROM cursos");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bússola do Saber</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🧭 Bússola do Saber</h1>
    </header>

    <div class="search-container">
        <input type="text" id="busca" placeholder="O que você quer aprender hoje?">
    </div>

    <nav class="filtros">
        <a href="#" class="filtro-categoria active" data-cat="todos">Todos os Cursos</a>
        <?php while($c = $res_cat->fetch_assoc()): ?>
            <a href="#" class="filtro-categoria" data-cat="<?= $c['categoria'] ?>">
                <?= $c['categoria'] ?>
            </a>
        <?php endwhile; ?>
    </nav>

    <p id="sem-resultados" style="display: none; text-align: center; color: var(--text-secondary);">Nenhum curso encontrado. 🔍</p>

    <main class="container" id="lista-cursos">
    <?php while($row = $resultado->fetch_assoc()): ?>
        <div class="card" data-categoria="<?= $row['categoria'] ?>">
            <span class="tag"><?= $row['categoria'] ?></span>
            <h3><?= $row['nome'] ?></h3>
            
            <!-- EXIBIÇÃO DA MÉDIA (Adicione isso) -->
            <div class="rating-display" style="margin-bottom: 10px;">
                <span style="color: #f1c40f;">⭐ <?= number_format($row['media_nota'], 1) ?></span>
                <small style="color: gray;"> (<?= $row['total_votos'] ?> avaliações)</small>
            </div>

            <p><?= $row['descricao'] ?></p> 
            <small>🏫 <?= $row['instituicao'] ?></small>
            
            <div class="card-buttons" style="display: flex; gap: 10px; margin-top: 15px;">
                <a href="<?= $row['link'] ?>" target="_blank" class="btn">Começar Agora</a>
                
                <!-- BOTÃO PARA AVALIAR (Adicione isso) -->
                <button type="button" class="btn-secundario" 
                        onclick="abrirModal(<?= $row['id'] ?>, '<?= $row['nome'] ?>')"
                        style="cursor: pointer; padding: 10px; border-radius: 5px; border: 1px solid var(--primary-color); background: transparent; color: var(--primary-color);">
                    Avaliar
                </button>
            </div>
        </div>
    <?php endwhile; ?>
</main>

    <script src="script.js"></script>

 <div id="modalAvaliacao" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModal()">&times;</span>
        <h2>Avaliar Curso: <span id="nomeCursoModal"></span></h2>
        
        <form action="salvar_avaliacao.php" method="POST">
            <input type="hidden" name="id_curso" id="idCursoModal">
            
            <label>Seu Nome:</label>
            <input type="text" name="nome_aluno" required placeholder="Ex: Hérbete">

            <label>Nota (1 a 5):</label>
            <select name="nota" required>
                <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                <option value="4">⭐⭐⭐⭐ (Muito Bom)</option>
                <option value="3">⭐⭐⭐ (Bom)</option>
                <option value="2">⭐⭐ (Regular)</option>
                <option value="1">⭐ (Ruim)</option>
            </select>

            <label>Seu Comentário:</label>
            <textarea name="comentario" rows="4" placeholder="O que achou do curso?"></textarea>

            <button type="submit" class="btn">Enviar Avaliação</button>
        </form>
    </div>
</div>
</body>
</html>