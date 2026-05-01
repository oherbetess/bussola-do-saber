document.addEventListener('DOMContentLoaded', function () {
    const inputBusca = document.getElementById('busca');
    const botoesCategoria = document.querySelectorAll('.filtro-categoria');
    const cards = document.querySelectorAll('.card');
    const msgSemResultados = document.getElementById('sem-resultados');

    let categoriaAtual = 'todos';

    // Função mestre que filtra por TEXTO e por CATEGORIA ao mesmo tempo
    function filtrarCursos() {
        const textoBusca = inputBusca.value.toLowerCase().trim();
        let encontrouAlgum = false;

        cards.forEach(card => {
            const nomeCurso = card.querySelector('h3').textContent.toLowerCase();
            const descCurso = card.querySelector('p').textContent.toLowerCase();
            const categoriaCard = card.getAttribute('data-categoria');

            // Regra 1: O texto combina?
            const bateTexto = nomeCurso.includes(textoBusca) || descCurso.includes(textoBusca);

            // Regra 2: A categoria combina?
            const bateCategoria = (categoriaAtual === 'todos' || categoriaCard === categoriaAtual);

            // Só mostra se bater os dois!
            if (bateTexto && bateCategoria) {
                card.style.display = "flex";
                encontrouAlgum = true;
            } else {
                card.style.display = "none";
            }
        });

        msgSemResultados.style.display = encontrouAlgum ? "none" : "block";
    }

    // Escuta a digitação
    inputBusca.addEventListener('input', filtrarCursos);

    // Escuta os cliques nas categorias
    botoesCategoria.forEach(botao => {
        botao.addEventListener('click', function (e) {
            e.preventDefault(); // Impede a página de recarregar

            // Remove 'active' de todos e coloca no clicado
            botoesCategoria.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Atualiza a categoria e filtra
            categoriaAtual = this.getAttribute('data-cat');
            filtrarCursos();
        });
    });
}); // <--- O DOMContentLoaded termina aqui!

// AS FUNÇÕES DE MODAL FICAM FORA (Para serem globais):

function abrirModal(id, nome) {
    document.getElementById('modalAvaliacao').style.display = 'block';
    document.getElementById('idCursoModal').value = id;
    document.getElementById('nomeCursoModal').innerText = nome;
}

function fecharModal() {
    document.getElementById('modalAvaliacao').style.display = 'none';
}

window.onclick = function(event) {
    let modal = document.getElementById('modalAvaliacao');
    if (event.target == modal) {
        fecharModal();
    }
}