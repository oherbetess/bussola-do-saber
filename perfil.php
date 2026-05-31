<?php 
include 'includes/header.php'; 
include 'includes/conexao.php';

// Segurança: Se não houver sessão, manda para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// --- LÓGICA DE UPLOAD DE CERTIFICADO ---
if (isset($_POST['upload'])) {
    $nome_curso = mysqli_real_escape_string($conexao, $_POST['nome_curso']);
    $instituicao = mysqli_real_escape_string($conexao, $_POST['instituicao']);
    
    $arquivo = $_FILES['arquivo'];
    
    // Verifica se a pasta existe, se não, cria
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if ($arquivo['error'] === 0) {
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $novo_nome = md5(time() . $arquivo['name']) . "." . $extensao;
        $diretorio = "uploads/";

        // Move o arquivo para a pasta
        if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome)) {
            $sql = "INSERT INTO certificados (usuario_id, nome_curso, instituicao, arquivo_path) 
                    VALUES ('$usuario_id', '$nome_curso', '$instituicao', '$novo_nome')";
            
            if(mysqli_query($conexao, $sql)) {
                echo "<script>alert('Certificado guardado com sucesso!'); window.location='perfil.php';</script>";
            }
        } else {
            echo "<script>alert('Erro ao mover o arquivo para a pasta uploads.');</script>";
        }
    } else {
        echo "<script>alert('Erro no arquivo enviado.');</script>";
    }
}

// Busca certificados do usuário
$certificados = mysqli_query($conexao, "SELECT * FROM certificados WHERE usuario_id = $usuario_id ORDER BY id DESC");
?>

<div class="container">
    <h2 style="color: #00A3FF; margin-bottom: 20px;">Meu Perfil</h2>
    <p style="margin-bottom: 40px;">Olá, <strong><?php echo $_SESSION['usuario_nome']; ?></strong>! Gerencie seus certificados e sua conta.</p>

    <!-- SEÇÃO 1: CERTIFICADOS -->
    <div style="background: #262626; padding: 25px; border-radius: 10px; border: 1px solid #333; margin-bottom: 30px;">
        <h3 style="margin-top: 0;"><span style="color: #ffc107;">📁</span> Minha Pasta de Certificados</h3>
        
        <div class="grid-cards" style="margin-top: 20px;">
            <!-- CARD DE NOVO UPLOAD -->
            <div class="card" style="border: 2px dashed #444; background: transparent;">
                <h4 style="margin-top: 0;">Novo Certificado</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nome_curso" placeholder="Nome do Curso" required>
                    <input type="text" name="instituicao" placeholder="Instituição" required>
                    <label style="font-size: 0.8rem; color: #888; display: block; margin-bottom: 5px;">Arquivo (PDF, JPG ou PNG):</label>
                    <input type="file" name="arquivo" accept=".pdf,.jpg,.png" required style="font-size: 0.8rem;">
                    <button type="submit" name="upload" class="btn-azul" style="width: 100%;">Guardar Agora</button>
                </form>
            </div>

            <!-- LISTAGEM DOS CERTIFICADOS JÁ SALVOS -->
            <?php if (mysqli_num_rows($certificados) > 0): ?>
                <?php while ($cert = mysqli_fetch_assoc($certificados)): ?>
                    <div class="card">
                        <h4 style="color: #00A3FF; margin-bottom: 5px;"><?php echo htmlspecialchars($cert['nome_curso']); ?></h4>
                        <p style="font-size: 0.85rem; color: #aaa;"><?php echo htmlspecialchars($cert['instituicao']); ?></p>
                        <div style="margin-top: 15px; display: flex; gap: 10px;">
                            <a href="uploads/<?php echo $cert['arquivo_path']; ?>" target="_blank" class="btn-azul" style="flex: 1; padding: 8px;">Ver</a>
                            <a href="excluir_certificado.php?id=<?php echo $cert['id']; ?>" 
                               class="btn-azul" 
                               style="background: #ff4d4d; flex: 1; padding: 8px;" 
                               onclick="return confirm('Deseja excluir este certificado permanentemente?')">Excluir</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: #666; font-style: italic;">Nenhum certificado guardado ainda.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- SEÇÃO 2: CONFIGURAÇÕES DA CONTA -->
    <div style="background: #262626; padding: 25px; border-radius: 10px; border: 1px solid #333;">
        <h3 style="margin-top: 0;"><span style="color: #00A3FF;">⚙️</span> Configurações</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px;">
            <a href="alterar_senha.php" class="btn-azul" style="background: #444; width: auto; padding: 10px 30px;">Alterar Senha</a>
            
            <a href="excluir_conta.php" 
               class="btn-azul" 
               style="background: #822; width: 100%; text-align: center; margin-top: 10px;" 
               onclick="return confirm('ATENÇÃO: Isso apagará sua conta e TODOS os seus certificados permanentemente. Confirmar?')">
               Excluir Minha Conta Permanentemente
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>