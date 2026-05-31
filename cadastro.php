<?php include 'includes/header.php'; ?>

<div class="container" style="max-width: 450px; margin-top: 50px;">
    <div style="background: #262626; padding: 30px; border-radius: 10px; border: 1px solid #333;">
        <h2 style="text-align: center; color: #00A3FF;">Criar Conta</h2>
        
        <form action="processa_cadastro.php" method="POST">
            <label>Nome Completo:</label>
            <input type="text" name="nome" required placeholder="Digite seu nome completo">

            <label>E-mail:</label>
            <input type="email" name="email" required placeholder="seu@email.com">

            <label>Senha:</label>
            <div style="position: relative;">
                <!-- ID "senha_cadastro" para o JavaScript encontrar este campo -->
                <input type="password" name="senha" id="senha_cadastro" required placeholder="Crie uma senha forte">
                
                <!-- Checkbox para mostrar a senha -->
                <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" id="mostrar_cad" onclick="toggleSenhaCadastro()" style="width: auto; margin-bottom: 0; cursor: pointer;">
                    <label for="mostrar_cad" style="font-size: 0.85rem; color: #aaa; cursor: pointer;">Mostrar senha</label>
                </div>
            </div>

            <button type="submit" class="btn-azul" style="width: 100%; margin-top: 10px;">Finalizar Cadastro</button>
        </form>
        
        <p style="text-align: center; margin-top: 15px; font-size: 0.9rem; color: #888;">
            Já possui uma conta? <a href="login.php" style="color: #00A3FF;">Fazer Login</a>
        </p>
    </div>
</div>

<!-- SCRIPT PARA MOSTRAR/ESCONDER A SENHA -->
<script>
function toggleSenhaCadastro() {
    var x = document.getElementById("senha_cadastro");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

<?php include 'includes/footer.php'; ?>