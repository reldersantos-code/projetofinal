document.addEventListener('DOMContentLoaded', () => {

    // 1. Filtro do Cardápio em Tempo Real sem Recarregar a Página (produtos.php)
    const campoBusca = document.getElementById('campoBusca');
    const pratos = document.querySelectorAll('.card-prato');
    const mensagemSemResultados = document.getElementById('semResultados');

    if (campoBusca && pratos.length > 0) {
        campoBusca.addEventListener('input', (e) => {
            const termo = e.target.value.toLowerCase().trim();
            let visiveis = 0;

            pratos.forEach((prato) => {
                const nome = prato.getAttribute('data-nome').toLowerCase();
                const descricao = prato.getAttribute('data-descricao').toLowerCase();

                if (nome.includes(termo) || descricao.includes(termo)) {
                    prato.style.display = 'flex';
                    visiveis++;
                } else {
                    prato.style.display = 'none';
                }
            });

            if (mensagemSemResultados) {
                mensagemSemResultados.style.display = (visiveis === 0) ? 'block' : 'none';
            }
        });
    }

    // 2. Preenchimento Automático do Formulário de Pedido ao Selecionar o Prato
    const selectPrato = document.getElementById('prato_escolhido');
    if (selectPrato) {
        selectPrato.addEventListener('change', (e) => {
            const valor = e.target.value;
            if (valor) {
                console.log(`Prato selecionado: ${valor}`);
            }
        });
    }
});