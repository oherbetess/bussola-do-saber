<?php include 'includes/header.php'; ?>

<div class="container" style="max-width: 400px; margin-top: 50px;">
    <div style="background: #262626; padding: 30px; border-radius: 10px; border: 1px solid #333;">
        <h2 style="text-align: center; color: #00A3FF;">Entrar</h2>
        
        <form action="processa_login.php" method="POST">
            <label>E-mail:</label>
            <input type="email" name="email" required placeholder="seu@email.com">

            <label>Senha:</label>
            <div style="position: relative;">
                <!-- Adicionamos um ID "senha" para o JavaScript encontrar este campo -->
                <input type="password" name="senha" id="senha" required placeholder="Sua senha">
                
                <!-- Checkbox para mostrar a senha -->
                <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" id="mostrar" onclick="toggleSenha()" style="width: auto; margin-bottom: 0; cursor: pointer;">
                    <label for="mostrar" style="font-size: 0.85rem; color: #aaa; cursor: pointer;">Mostrar senha</label>
                </div>
            </div>

            <button type="submit" class="btn-azul" style="width: 100%; margin-top: 10px;">Acessar</button>
        </form>
        
        <p style="text-align: center; margin-top: 15px; font-size: 0.9rem; color: #888;">
            Novo por aqui? <a href="cadastro.php" style="color: #00A3FF;">Crie sua conta</a>
        </p>
    </div>
</div>

<!-- SCRIPT PARA MOSTRAR/ESCONDER A SENHA -->
<script>
function toggleSenha() {
    var x = document.getElementById("senha");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

<?php include 'includes/footer.php'; ?>