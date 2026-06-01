<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Lógica para detectar se estamos na pasta admin e ajustar os links
$diretorio_atual = basename(getcwd());
$prefixo = ($diretorio_atual == 'admin') ? '../' : '';

include_once(dirname(__FILE__) . '/conexao.php');
if (isset($conexao)) { mysqli_set_charset($conexao, "utf8mb4"); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bússola do Saber</title>
    <style>
        body { background-color: #1a1a1a; color: white; font-family: 'Segoe UI', sans-serif; margin: 0; }
        nav { background-color: #121212; padding: 1rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #00A3FF; }
        .logo { color: #00A3FF; font-weight: bold; font-size: 1.5rem; text-decoration: none; }
        .nav-links a { color: white; margin: 0 10px; text-decoration: none; font-size: 0.9rem; }
        .btn-azul { background-color: #00A3FF; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .container { width: 90%; max-width: 1100px; margin: auto; padding: 20px 0; }
        .grid-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card { background: #262626; padding: 20px; border-radius: 10px; border: 1px solid #333; }
        input, select, textarea { background: #2d2d2d; border: 1px solid #444; color: white; padding: 10px; border-radius: 5px; width: 100%; box-sizing: border-box; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; background: #262626; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #333; }
    </style>
</head>
<body>

<nav>
    <a href="<?php echo $prefixo; ?>index.php" class="logo">Bússola do Saber</a>
    <div class="nav-links">
        <a href="<?php echo $prefixo; ?>index.php">Início</a>
        <a href="<?php echo $prefixo; ?>cursos.php">Cursos</a>
        
        <?php if(isset($_SESSION['usuario_id'])): ?>
            <a href="<?php echo $prefixo; ?>perfil.php">Meu Perfil</a>
            
            <?php if($_SESSION['usuario_tipo'] == 'admin'): ?>
                <a href="<?php echo ($diretorio_atual == 'admin') ? 'index.php' : 'admin/index.php'; ?>" style="color: #ffc107; font-weight: bold;">Admin</a>
            <?php endif; ?>
            
            <a href="<?php echo $prefixo; ?>logout.php" style="color: #ff4d4d;">Sair</a>
        <?php else: ?>
            <a href="<?php echo $prefixo; ?>login.php" class="btn-azul">Entrar</a>
        <?php endif; ?>
    </div>
</nav>