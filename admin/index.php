<?php
session_start();
include '../includes/conexao.php';

// Segurança: Se não for admin, volta para a raiz
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../includes/header.php'; 
?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Painel Administrativo</h2>
        <a href="adicionar_curso.php" class="btn-azul">+ Adicionar Novo Curso</a>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <table>
            <thead>
                <tr style="background: #121212;">
                    <th>ID</th>
                    <th>Nome do Curso</th>
                    <th>Instituição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conexao, "SELECT * FROM cursos ORDER BY id DESC");
                while ($c = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>{$c['id']}</td>";
                    echo "<td>" . htmlspecialchars($c['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($c['instituicao']) . "</td>";
                    echo "<td>
                            <a href='editar.php?id={$c['id']}' style='color: #ffc107; text-decoration:none; margin-right:15px;'>Editar</a>
                            <a href='excluir.php?id={$c['id']}' style='color: #ff4d4d; text-decoration:none;' onclick='return confirm(\"Excluir curso?\")'>Excluir</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>