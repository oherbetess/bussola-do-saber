<?php 
include '../includes/header.php'; 

// Segurança: Verifica se o usuário é admin
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] != 'admin') { 
    die("Acesso negado. Você não tem permissão para acessar esta página."); 
}

// LÓGICA PARA ADICIONAR CURSO
if (isset($_POST['cadastrar'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $inst = mysqli_real_escape_string($conexao, $_POST['instituicao']);
    $cat  = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $link = mysqli_real_escape_string($conexao, $_POST['link']);
    $desc = mysqli_real_escape_string($conexao, $_POST['descricao']);

    $sql = "INSERT INTO cursos (nome, instituicao, categoria, link_acesso, descricao) VALUES ('$nome', '$inst', '$cat', '$link', '$desc')";
    mysqli_query($conexao, $sql);
    header("Location: index.php?msg=sucesso");
}
?>

<div class="container">
    <h2 style="color: #00A3FF;">Painel Administrativo</h2>
    
    <!-- Formulário de Cadastro -->
    <div class="card">
        <h3>+ Adicionar Novo Curso</h3>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome do Curso" required>
            <input type="text" name="instituicao" placeholder="Instituição" required>
            <input type="text" name="categoria" placeholder="Categoria" required>
            <input type="url" name="link" placeholder="Link do Curso (URL)" required>
            <textarea name="descricao" placeholder="Pequena descrição do curso..." rows="3"></textarea>
            <button type="submit" name="cadastrar" class="btn-azul" style="width: 100%;">Publicar Curso na Plataforma</button>
        </form>
    </div>

    <!-- Lista para Editar/Excluir -->
    <h3>Cursos Ativos</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr style="border-bottom: 1px solid #444; text-align: left;">
                    <th>Curso</th>
                    <th>Instituição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conexao, "SELECT * FROM cursos ORDER BY id DESC");
                while($c = mysqli_fetch_assoc($res)) {
                    // Aqui está a correção: usamos variáveis dentro do echo de forma limpa
                    echo "<tr style='border-bottom: 1px solid #333;'>";
                    echo "<td style='padding:10px;'>{$c['nome']}</td>";
                    echo "<td>{$c['instituicao']}</td>";
                    echo "<td>
                            <a href='editar.php?id={$c['id']}' style='color: #00A3FF; text-decoration:none;'>[Editar]</a> 
                            
                            <a href='excluir.php?id={$c['id']}' 
                               onclick=\"return confirm('Deseja realmente remover este curso da plataforma?');\" 
                               style='color: #ff4444; text-decoration:none; margin-left:10px;'>
                               [X] Excluir
                            </a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>