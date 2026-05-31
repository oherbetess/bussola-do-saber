<?php 
// 1. ISSO DEVE SER A PRIMEIRA LINHA DO ARQUIVO
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

// 2. Caminho da conexão (ajustado para funcionar em qualquer pasta)
// Usamos o dirname(__FILE__) para garantir que ele ache o arquivo independente de onde o header for chamado
include_once(dirname(__FILE__) . '/conexao.php'); 

// 3. Forçar o banco a usar acentuação correta
if (isset($conexao)) {
    mysqli_set_charset($conexao, "utf8mb4");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bússola do Saber</title>
    <style>
        body { background-color: #1a1a1a; color: white; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0; }
        
        nav { 
            background-color: #121212; 
            padding: 1rem; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            border-bottom: 2px solid #00A3FF; 
        }
        
        @media (min-width: 768px) {
            nav { flex-direction: row; justify-content: space-between; } 
        }

        .logo { color: #00A3FF; font-weight: bold; font-size: 1.5rem; text-decoration: none; margin-bottom: 10px; }
        @media (min-width: 768px) { .logo { margin-bottom: 0; } }

        .nav-links a { color: white; margin: 0 10px; text-decoration: none; font-size: 0.9rem; }
        
        .btn-azul { 
            background-color: #00A3FF; color: white; border: none; 
            padding: 10px 20px; border-radius: 5px; cursor: pointer; 
            font-weight: bold; text-decoration: none; display: inline-block;
            text-align: center;
        }

        .container { width: 90%; max-width: 1100px; margin: auto; padding: 20px 0; }

        .grid-cards {
            display: grid;
            grid-template-columns: 1fr; 
            gap: 20px;
            margin-top: 30px;
        }

        @media (min-width: 768px) {
            .grid-cards { grid-template-columns: 1fr 1fr 1fr; } 
        }

        .card { background: #262626; padding: 20px; border-radius: 10px; border: 1px solid #333; }
        
        input, select, textarea { 
            background: #2d2d2d; border: 1px solid #444; color: white; 
            padding: 12px; border-radius: 5px; width: 100%; 
            box-sizing: border-box; margin-bottom: 15px; font-size: 16px; 
        }

        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 500px; }
    </style>
</head>
<body>

<nav>
    <a href="index.php" class="logo">Bússola do Saber</a>
    <div class="nav-links">
        <a href="index.php">Início</a>
        <a href="cursos.php">Cursos</a>
        
        <?php if(isset($_SESSION['usuario_id'])): ?>
            <!-- SE ESTIVER LOGADO -->
            <span style="color: #ccc; font-size: 0.8rem;">Olá, <?php echo explode(' ', $_SESSION['usuario_nome'])[0]; ?>!</span>
            <a href="perfil.php">Meu Perfil</a>
            
            <?php if(isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin'): ?>
                <a href="admin/index.php" style="color: #ffc107; font-weight: bold;">Admin</a>
            <?php endif; ?>
            
            <a href="logout.php" style="color: #ff4d4d;">Sair</a>
        <?php else: ?>
            <!-- SE NÃO ESTIVER LOGADO -->
            <a href="login.php" class="btn-azul">Entrar</a>
        <?php endif; ?>
    </div>
</nav>