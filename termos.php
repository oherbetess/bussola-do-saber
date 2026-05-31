<?php 
session_start(); // Necessário para o header verificar o login
include 'includes/header.php'; 
?>

<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    
    <!-- Título Principal -->
    <h1 style="font-size: clamp(1.8rem, 5vw, 2.8rem); color: #00A3FF; text-align: center; margin-bottom: 10px;">
        Informações Legais
    </h1>
    <p style="text-align: center; color: #999; margin-bottom: 40px;">Projeto de Extensão Acadêmica - Bússola do Saber</p>

    <!-- Box de Conteúdo (Usando o fundo do card que você já definiu) -->
    <div style="background: #262626; padding: clamp(20px, 5vw, 40px); border-radius: 10px; border: 1px solid #333; color: #ccc; line-height: 1.8; text-align: left;">
        
        <!-- SEÇÃO: TERMOS DE USO -->
        <section id="termos" style="scroll-margin-top: 20px;">
            <h2 style="color: #00A3FF; border-bottom: 1px solid #333; padding-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 1.5rem;">⚖️</span> 1. Termos de Uso
            </h2>
            <p>Ao utilizar a plataforma <strong>Bússola do Saber</strong>, você concorda com as seguintes condições de uso:</p>
            <ul style="margin-left: 20px; color: #bbb;">
                <li>Esta é uma ferramenta de apoio educacional e curadoria de cursos sem fins lucrativos.</li>
                <li>O conteúdo dos cursos listados e seus respectivos certificados são de responsabilidade exclusiva das plataformas de origem.</li>
                <li>O usuário compromete-se a fornecer dados reais no cadastro para garantir a organização correta de seus certificados.</li>
                <li>É proibida qualquer tentativa de extração de dados ou engenharia reversa que comprometa a segurança da plataforma.</li>
            </ul>
        </section>

        <div style="height: 50px;"></div> <!-- Espaçador visual -->

        <!-- SEÇÃO: POLÍTICA DE PRIVACIDADE -->
        <section id="privacidade" style="scroll-margin-top: 20px;">
            <h2 style="color: #00A3FF; border-bottom: 1px solid #333; padding-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 1.5rem;">🛡️</span> 2. Política de Privacidade (LGPD)
            </h2>
            <p>Em conformidade com a <strong>Lei Geral de Proteção de Dados (LGPD)</strong>, explicamos como cuidamos das suas informações:</p>
            
            <h4 style="color: #fff; margin-top: 25px; margin-bottom: 10px;">• Quais dados coletamos?</h4>
            <p style="color: #bbb;">Coletamos Nome, E-mail e registros de interação com os cursos. Esses dados são fundamentais para criar o seu perfil personalizado.</p>

            <h4 style="color: #fff; margin-top: 25px; margin-bottom: 10px;">• Como usamos seus dados?</h4>
            <p style="color: #bbb;">Seus dados são usados para permitir o login, salvar sua lista de cursos e para a geração de relatórios estatísticos anônimos do projeto de extensão acadêmica (sem identificação pessoal).</p>

            <h4 style="color: #fff; margin-top: 25px; margin-bottom: 10px;">• Segurança e Compartilhamento</h4>
            <p style="color: #bbb;">Não comercializamos seus dados em hipótese alguma. As informações são protegidas e de acesso restrito à coordenação do projeto.</p>

            <h4 style="color: #fff; margin-top: 25px; margin-bottom: 10px;">• Seus Direitos</h4>
            <p style="color: #bbb;">A qualquer momento você pode solicitar a alteração ou exclusão total dos seus dados enviando um e-mail para o suporte indicado no rodapé desta página.</p>
        </section>

    </div>

    <!-- Botão para voltar -->
    <div style="margin-top: 50px; text-align: center;">
        <a href="index.php" class="btn-azul" style="padding: 12px 40px; font-size: 1rem;">Voltar para o Início</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>