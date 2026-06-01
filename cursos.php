<?php 
session_start();
include 'includes/header.php'; 
include 'includes/conexao.php';

// Garante que a acentuação vinda do banco funcione
mysqli_set_charset($conexao, "utf8mb4");
?>

<div class="container">
    <h2 style="color: #00A3FF; margin-bottom: 10px;">Diretório de Cursos</h2>
    <p style="color: #888; margin-bottom: 30px;">Encontre os melhores cursos gratuitos e veja as avaliações da comunidade.</p>

    <form action="cursos.php" method="GET" style="display: flex; gap: 10px; margin-bottom: 40px;">
        <input type="text" name="busca" placeholder="Pesquisar curso, área ou instituição..." 
               value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>" 
               style="margin-bottom: 0; flex: 1;">
        <button type="submit" class="btn-azul" style="width: auto; padding: 0 30px;">Buscar</button>
    </form>

    <div class="grid-cards">
        <?php
        $busca = isset($_GET['busca']) ? mysqli_real_escape_string($conexao, $_GET['busca']) : '';
        
        // A consulta 'c.*' já pega a descrição que você mostrou no print
        $sql = "SELECT c.*, 
                       AVG(a.nota) AS media_nota, 
                       COUNT(a.id) AS total_votos 
                FROM cursos c 
                LEFT JOIN avaliacoes a ON c.id = a.curso_id 
                WHERE c.nome LIKE '%$busca%' 
                   OR c.categoria LIKE '%$busca%' 
                   OR c.instituicao LIKE '%$busca%' 
                GROUP BY c.id 
                ORDER BY c.nome ASC";

        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($curso = mysqli_fetch_assoc($resultado)) {
                $media = round($curso['media_nota']);
                $estrelas = str_repeat('⭐', $media);
                ?>
                
                <div class="card" style="text-align: left; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #333;">
                    <div>
                        <h3 style="color: #00A3FF; margin-bottom: 5px; font-size: 1.2rem;">
                            <?php echo htmlspecialchars($curso['nome']); ?>
                        </h3>
                        
                        <p style="font-size: 0.8rem; color: #666; margin-bottom: 10px;">
                            📍 <?php echo htmlspecialchars($curso['instituicao']); ?> | 🏷️ <?php echo htmlspecialchars($curso['categoria']); ?>
                        </p>

                        <!-- EXIBIÇÃO DA DESCRIÇÃO QUE ESTÁ NO SEU BANCO -->
                        <p style="font-size: 0.85rem; color: #bbb; line-height: 1.4; margin-bottom: 15px; min-height: 45px;">
                            <?php 
                                // Exibe a descrição limitada a 100 caracteres para manter o card organizado
                                echo mb_strimwidth(htmlspecialchars($curso['descricao']), 0, 100, "..."); 
                            ?>
                        </p>

                        <!-- NOTAS E COMENTÁRIOS -->
                        <div style="margin-bottom: 20px; background: rgba(0,0,0,0.2); padding: 8px; border-radius: 5px;">
                            <?php if ($curso['total_votos'] > 0): ?>
                                <span style="color: #ffc107;"><?php echo $estrelas; ?></span>
                                <a href="ver_avaliacoes.php?id=<?php echo $curso['id']; ?>" style="color: #00A3FF; text-decoration: none; font-size: 0.75rem; margin-left: 5px;">
                                    (<?php echo $curso['total_votos']; ?> opiniões)
                                </a>
                            <?php else: ?>
                                <small style="color: #444; font-style: italic; font-size: 0.75rem;">Ainda não avaliado</small>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <a href="<?php echo $curso['link_acesso']; ?>" target="_blank" class="btn-azul" style="text-align: center; padding: 10px;">
                            Acessar Curso
                        </a>
                        
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <a href="avaliar.php?id=<?php echo $curso['id']; ?>" style="color: #ffc107; text-decoration: none; font-size: 0.85rem; text-align: center;">
                                ✍️ Avaliar este curso
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "<p style='color: #666;'>Nenhum curso encontrado.</p>";
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>