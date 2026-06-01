<?php
// 1. Inicia a sessão (essencial para saber quem excluir)
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// 2. Inclui apenas a conexão (NÃO inclua o header.php aqui)
include 'includes/conexao.php';

// 3. Verifica se o ID do usuário existe na sessão
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

$id = $_SESSION['usuario_id'];

// 4. LIMPEZA DE ARQUIVOS (Deleta os certificados da pasta uploads)
$res_cert = mysqli_query($conexao, "SELECT arquivo_path FROM certificados WHERE usuario_id = $id");
while ($cert = mysqli_fetch_assoc($res_cert)) {
    $caminho_arquivo = "uploads/" . $cert['arquivo_path'];
    if (file_exists($caminho_arquivo)) {
        unlink($caminho_arquivo);
    }
}

// 5. EXCLUSÃO NO BANCO DE DADOS
// O delete no 'usuarios' apagará 'avaliacoes' e 'certificados' se você usou ON DELETE CASCADE
$sql = "DELETE FROM usuarios WHERE id = $id";

if (mysqli_query($conexao, $sql)) {
    // 6. Limpa e destrói a sessão completamente
    $_SESSION = array();
    session_destroy();
    
    // 7. Redirecionamento via JavaScript (Evita o Erro 400 de cabeçalho)
    echo "<script>
            alert('Sua conta e todos os seus dados foram removidos com sucesso.');
            window.location.href = 'index.php';
          </script>";
    exit();
} else {
    echo "Erro técnico ao excluir: " . mysqli_error($conexao);
}
?>