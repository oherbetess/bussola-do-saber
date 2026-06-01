<?php 
include 'includes/header.php'; 
include 'includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// --- LÓGICA DE UPLOAD MELHORADA ---
if (isset($_POST['upload'])) {
    $nome_curso = mysqli_real_escape_string($conexao, $_POST['nome_curso']);
    $instituicao = mysqli_real_escape_string($conexao, $_POST['instituicao']);
    $arquivo = $_FILES['arquivo'];

    // 1. Validações de Segurança
    $extensoes_permitidas = ['pdf', 'jpg', 'jpeg', 'png'];
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    $max_size = 5 * 1024 * 1024; // 5MB

    if (!in_array($extensao, $extensoes_permitidas)) {
        echo "<script>alert('Erro: Apenas PDF, JPG e PNG são permitidos.');</script>";
    } elseif ($arquivo['size'] > $max_size) {
        echo "<script>alert('Erro: O arquivo é muito grande (máximo 5MB).');</script>";
    } else {
        if (!is_dir('uploads')) { mkdir('uploads', 0777, true); }

        $novo_nome = bin2hex(random_bytes(10)) . "." . $extensao; // Nome mais seguro
        $diretorio = "uploads/";

        if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome)) {
            $sql = "INSERT INTO certificados (usuario_id, nome_curso, instituicao, arquivo_path) 
                    VALUES ('$usuario_id', '$nome_curso', '$instituicao', '$novo_nome')";
            mysqli_query($conexao, $sql);
            echo "<script>alert('Certificado guardado com sucesso!'); window.location='perfil.php';</script>";
        }
    }
}

// Busca certificados
$certificados = mysqli_query($conexao, "SELECT * FROM certificados WHERE usuario_id = $usuario_id ORDER BY id DESC");
$total_cert = mysqli_num_rows($certificados);
?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; margin-bottom: 30px;">
        <div>
            <h2 style="color: #00A3FF; margin: 0;">Meu Perfil</h2>
            <p style="color: #888;">Bem-vindo, <strong><?php echo $_SESSION['usuario_nome']; ?></strong></p>
        </div>
        <!-- Estatística Simples -->
        <div style="background: #00A3FF; padding: 10px 20px; border-radius: 10px; text-align: center;">
            <span style="display: block; font-size: 0.8rem; text-transform: uppercase;">Certificados</span>
            <strong style="font-size: 1.5rem;"><?php echo $total_cert; ?></strong>
        </div>
    </div>

    <div class="grid-cards">
        <!-- FORMULÁRIO DE UPLOAD (Destaque) -->
        <div class="card" style="border: 2px solid #00A3FF; background: rgba(0, 163, 255, 0.05);">
            <h3 style="margin-top: 0; color: #00A3FF;">📁 Novo Certificado</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="nome_curso" placeholder="Nome do Curso" required>
                <input type="text" name="instituicao" placeholder="Instituição Emissora" required>
                <div style="background: #1a1a1a; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #444;">
                    <label style="font-size: 0.75rem; color: #888; display: block; margin-bottom: 5px;">Selecione o arquivo (PDF ou Imagem):</label>
                    <input type="file" name="arquivo" accept=".pdf,.jpg,.png,.jpeg" required style="margin: 0; font-size: 0.8rem;">
                </div>
                <button type="submit" name="upload" class="btn-azul" style="width: 100%;">Salvar na Minha Pasta</button>
            </form>
        </div>

        <!-- LISTAGEM -->
        <?php while ($cert = mysqli_fetch_assoc($certificados)): 
            $ext = pathinfo($cert['arquivo_path'], PATHINFO_EXTENSION);
            $icon = ($ext == 'pdf') ? '📄' : '🖼️'; // Ícone diferente para PDF ou Imagem
        ?>
            <div class="card" style="transition: 0.3s; position: relative; overflow: hidden;">
                <span style="position: absolute; right: 10px; top: 10px; font-size: 1.5rem; opacity: 0.2;"><?php echo $icon; ?></span>
                <h4 style="color: #fff; margin-bottom: 5px; padding-right: 30px;"><?php echo htmlspecialchars($cert['nome_curso']); ?></h4>
                <p style="font-size: 0.85rem; color: #00A3FF; margin-bottom: 20px;"><?php echo htmlspecialchars($cert['instituicao']); ?></p>
                
                <div style="display: flex; gap: 10px;">
                    <a href="uploads/<?php echo $cert['arquivo_path']; ?>" target="_blank" class="btn-azul" style="flex: 2; padding: 8px; font-size: 0.8rem;">Visualizar</a>
                    <a href="excluir_certificado.php?id=<?php echo $cert['id']; ?>" 
                       style="flex: 1; background: #331111; color: #ff4d4d; border: 1px solid #ff4d4d; border-radius: 5px; text-decoration: none; display: flex; align-items: center; justify-content: center;" 
                       onclick="return confirm('Excluir permanentemente?')">🗑️</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- CONFIGURAÇÕES -->
    <div style="margin-top: 50px; background: #121212; padding: 25px; border-radius: 15px; border: 1px solid #333;">
        <h3 style="margin-top: 0; color: #eee;">⚙️ Configurações da Conta</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px;">
            <a href="alterar_senha.php" class="btn-azul" style="background: #333; border: 1px solid #555; width: auto;">Trocar Senha</a>
            <a href="excluir_conta.php" 
               style="color: #ff4d4d; text-decoration: none; font-size: 0.9rem; align-self: center;" 
               onclick="return confirm('Deseja realmente apagar sua conta? Isso não pode ser desfeito.')">
               Encerrar conta permanentemente
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>