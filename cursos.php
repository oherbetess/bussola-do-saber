<?php 
// 1. Inicia a sessão e inclui os arquivos necessários
session_start();
include 'includes/header.php'; 
include 'includes/conexao.php';

// Força a conexão a usar UTF-8 para evitar erros de acentuação
mysqli_set_charset($conexao, "utf8mb4");
?>

<div class="container">
    <h2 style="color: #00A3FF; margin-bottom: 10px;">Diretório de Cursos</h2>
    <p style="color: #888; margin-bottom: 30px;">Explore cursos gratuitos com certificados e veja a opinião da comunidade.</p>

    <!-- BARRA DE PESQUISA -->
    <form action="cursos.php" method="GET" style="display: flex; gap: 10px; margin-bottom: 40px;">
        <input type="text" name="busca" placeholder="Pesquisar curso, área ou instituição..." 
               value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>" 
               style="margin-bottom: 0; flex: 1;">
        <button type="submit" class="btn-azul" style="width: auto; padding: 0 30px;">Buscar</button>
    </form>

    <div class="grid-cards">
        <?php
        // 2. Lógica de Busca
        $busca = isset($_GET['busca']) ? mysqli_real_escape_string($conexao, $_GET['busca']) : '';
        
        // 3. SQL com LEFT JOIN para trazer a média de notas e o total de avaliações
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
                
                // Configuração das estrelas baseada na média
                $media = round($curso['media_nota']);
                $estrelas = str_repeat('⭐', $media);
                $nota_formatada = number_format($curso['media_nota'], 1);
                ?>
                
                <!-- CARD DO CURSO -->
                <div class="card" style="text-align: left; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #333;">
                    <div>
                        <h3 style="color: #00A3FF; margin-bottom: 5px; font-size: 1.3rem;">
                            <?php echo htmlspecialchars($curso['nome']); ?>
                        </h3>
                        
                        <p style="font-size: 0.85rem; color: #888; margin-bottom: 10px;">
                            <span title="Instituição">📍 <?php echo htmlspecialchars($curso['instituicao']); ?></span> | 
                            <span title="Categoria">🏷️ <?php echo htmlspecialchars($curso['categoria']); ?></span>
                        </p>

                        <!-- BLOCO DE AVALIAÇÃO (ESTRELAS E COMENTÁRIOS) -->
                        <div style="margin-bottom: 20px; background: rgba(0,0,0,0.2); padding: 10px; border-radius: 8px;">
                            <?php if ($curso['total_votos'] > 0): ?>
                                <div style="display: flex; align-items: center; gap: 5px;">
                                    <span style="color: #ffc107; font-size: 1rem;"><?php echo $estrelas; ?></span>
                                    <span style="color: #fff; font-weight: bold; font-size: 0.9rem;">(<?php echo $nota_formatada; ?>)</span>
                                </div>
                                <a href="ver_avaliacoes.php?id=<?php echo $curso['id']; ?>" style="color: #00A3FF; text-decoration: none; font-size: 0.8rem; margin-top: 5px; display: inline-block;">
                                    💬 Ver <?php echo $curso['total_votos']; ?> comentário(s)
                                </a>
                            <?php else: ?>
                                <small style="color: #555; font-style: italic;">Ainda não avaliado</small>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- BOTÕES DE AÇÃO -->
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <a href="<?php echo $curso['link_acesso']; ?>" target="_blank" class="btn-azul" style="text-align: center;">
                            Acessar Curso
                        </a>
                        
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <a href="avaliar.php?id=<?php echo $curso['id']; ?>" style="color: #ffc107; text-decoration: none; font-size: 0.9rem; text-align: center; border: 1px solid #444; padding: 5px; border-radius: 5px;">
                                ✍️ Avaliar este curso
                            </a>
                        <?php else: ?>
                            <p style="font-size: 0.75rem; color: #444; text-align: center; margin: 0;">
                                Faça login para avaliar
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
            }
        } else {
            // Caso a busca não retorne nada
            echo "
            <div style='grid-column: 1/-1; text-align: center; padding: 50px;'>
                <p style='color: #666; font-size: 1.2rem;'>Nenhum curso encontrado para sua busca.</p>
                <a href='cursos.php' style='color: #00A3FF;'>Ver todos os cursos</a>
            </div>";
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>