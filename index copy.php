<?php 
include 'db.php'; 

// 1. Carregamos TODOS os cursos de uma vez para o JS filtrar
$resultado = $conexao->query("SELECT * FROM cursos");
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
                <p><?= $row['descricao'] ?></p> 
                <small>🏫 <?= $row['instituicao'] ?></small>
                <a href="<?= $row['link'] ?>" target="_blank" class="btn">Começar Agora</a>
            </div>
        <?php endwhile; ?>
    </main>

    <script src="script.js"></script>
</body>
</html>