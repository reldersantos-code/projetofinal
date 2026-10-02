<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - Seleção do Pedido</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Bistrô Sabor & Arte</h1>
        <nav>
            <a href="index.php">Menu Principal</a>
            <a href="produtos.php" class="active">Cardápio</a>
        </nav>
    </header>

    <main class="container">
        
        <!-- SEÇÃO CARDÁPIO (Apenas exibição e filtro) -->
        <section>
            <h2 style="color: var(--primary-color); margin-bottom: 0.5rem;">Cardápio Gastronômico</h2>
            <p style="margin-bottom: 1.5rem; color: #666;">Filtre as opções abaixo em tempo real antes de montar seu pedido:</p>

            <div class="search-container">
                <input type="text" id="campoBusca" class="search-box" placeholder="Filtrar por nome ou ingrediente (ex: Risoto, Mignon, Massa, Mousse)...">
            </div>

            <div class="grid-cardapio" id="listaPratos">
                
                <div class="card-prato" data-nome="risoto de cogumelos trufado" data-descricao="arroz arboreo cogumelos azeite trufado queijo parmesao">
                    <img src="img/prato1.jpg" alt="Risoto de Cogumelos">
                    <div class="card-content">
                        <h3>Risoto de Cogumelos Trufado</h3>
                        <p>Arroz arbóreo, cogumelos shimeji e paris frescos, finalizado com azeite trufado e queijo parmesão.</p>
                        <p class="preco">R$ 58,00</p>
                    </div>
                </div>

                <div class="card-prato" data-nome="file mignon ao molho madeira" data-descricao="carne file mignon batatas rusticas puree mandioca">
                    <img src="img/prato3.png" alt="Filé Mignon ao Madeira">
                    <div class="card-content">
                        <h3>Filé Mignon ao Molho Madeira</h3>
                        <p>Medalhão de filé mignon grelhado, acompanhado de batatas rústicas e purê de mandioca cremoso.</p>
                        <p class="preco">R$ 72,00</p>
                    </div>
                </div>

                <div class="card-prato" data-nome="fettuccine artesanal ao molho pesto" data-descricao="massa fettuccine pesto nozes manjericao queijo">
                    <img src="img/prato2.jpg" alt="Fettuccine ao Pesto">
                    <div class="card-content">
                        <h3>Fettuccine ao Molho Pesto</h3>
                        <p>Massa fresca artesanal com molho pesto tradicional de manjericão, nozes e azeite extra virgem.</p>
                        <p class="preco">R$ 48,00</p>
                    </div>
                </div>

                <div class="card-prato" data-nome="mousse de chocolate meio amargo" data-descricao="sobremesa doce mousse chocolate cacau raspas">
                    <img src="img/prato4.jpg" alt="Mousse de Chocolate">
                    <div class="card-content">
                        <h3>Mousse de Chocolate 70%</h3>
                        <p>Sobremesa aerada elaborada com cacau nobre, finalizada com raspas de chocolate meio amargo.</p>
                        <p class="preco">R$ 22,00</p>
                    </div>
                </div>

            </div>

            <div id="semResultados" style="display: none; text-align: center; padding: 2rem; background: #fff; border-radius: 6px;">
                <p style="color: #c0392b; font-weight: bold;">Nenhum item encontrado no cardápio com o termo digitado.</p>
            </div>
        </section>

        <hr style="margin: 3rem 0; border: 0; border-top: 2px dashed var(--border-color);">

        <!-- SEÇÃO APENAS DE MONTAGEM DO PEDIDO -> DIRECIONA PARA CADASTRO -->
        <section class="form-section">
            <h2 style="color: var(--primary-color); text-align: center; margin-bottom: 0.5rem;">Passo 1: Selecione seu Prato</h2>
            <p style="text-align: center; color: #666; margin-bottom: 2rem;">Escolha o item e a quantidade. Em seguida, você será direcionado para informar os dados de entrega e cadastro.</p>

            <form action="cadastro.php" method="POST">
                
                <div class="form-group">
                    <label for="prato_escolhido">Escolha o Prato do Cardápio *</label>
                    <select id="prato_escolhido" name="prato_escolhido" required>
                        <option value="">-- Selecione um prato --</option>
                        <option value="Risoto de Cogumelos Trufado - R$ 58,00">Risoto de Cogumelos Trufado - R$ 58,00</option>
                        <option value="Filé Mignon ao Molho Madeira - R$ 72,00">Filé Mignon ao Molho Madeira - R$ 72,00</option>
                        <option value="Fettuccine ao Molho Pesto - R$ 48,00">Fettuccine ao Molho Pesto - R$ 48,00</option>
                        <option value="Mousse de Chocolate 70% - R$ 22,00">Mousse de Chocolate 70% - R$ 22,00</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade *</label>
                    <input type="number" id="quantidade" name="quantidade" min="1" max="10" value="1" required>
                </div>

                <div class="form-group">
                    <label for="observacoes_pedido">Observações do Item (Opcional):</label>
                    <textarea id="observacoes_pedido" name="observacoes_pedido" rows="3" placeholder="Ex: Sem cebola, molho à parte, ponto da carne..."></textarea>
                </div>

                <button type="submit" class="btn btn-full">Avançar para Cadastro do Cliente &rarr;</button>
            </form>
        </section>

    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Bistrô Sabor & Arte - Todos os direitos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>