<?php

$etapa_confirmacao = false;
$mensagem_erro = "";

// 1. Recebimento dos dados do formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Captura dos dados do Pedido (Vindos do Cardápio)
    $prato_escolhido = isset($_POST['prato_escolhido']) ? htmlspecialchars(trim($_POST['prato_escolhido'])) : '';
    $quantidade = isset($_POST['quantidade']) ? htmlspecialchars(trim($_POST['quantidade'])) : '1';
    $observacoes_pedido = isset($_POST['observacoes_pedido']) ? htmlspecialchars(trim($_POST['observacoes_pedido'])) : '';

    // Captura dos dados do Cliente (Enviados por esta mesma página)
    $nome_completo = isset($_POST['nome_completo']) ? htmlspecialchars(trim($_POST['nome_completo'])) : '';
    $cpf = isset($_POST['cpf']) ? htmlspecialchars(trim($_POST['cpf'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $telefone = isset($_POST['telefone']) ? htmlspecialchars(trim($_POST['telefone'])) : '';
    $endereco = isset($_POST['endereco']) ? htmlspecialchars(trim($_POST['endereco'])) : '';
    $bairro = isset($_POST['bairro']) ? htmlspecialchars(trim($_POST['bairro'])) : '';
    $cep = isset($_POST['cep']) ? htmlspecialchars(trim($_POST['cep'])) : '';
    $forma_pagamento = isset($_POST['forma_pagamento']) ? htmlspecialchars(trim($_POST['forma_pagamento'])) : '';

    // Se o cliente clicou em "Finalizar", valida o cadastro e gera a confirmação
    if (isset($_POST['finalizar_cadastro'])) {
        if (!empty($nome_completo) && !empty($cpf) && !empty($email) && !empty($endereco)) {
            $etapa_confirmacao = true;
            date_default_timezone_set('America/Sao_Paulo');
            $data_processamento = date('d/m/Y \à\s H:i:s');
            $numero_pedido = rand(1000, 9999);
        } else {
            $mensagem_erro = "Por favor, preencha todos os campos obrigatórios do cadastro.";
        }
    }
} else {
    // Se tentar acessar diretamente pelo navegador sem selecionar prato
    header("Location: produtos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $etapa_confirmacao ? 'Pedido em Preparação' : 'Cadastro do Cliente'; ?> - Bistrô Sabor & Arte</title>
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

        <?php if ($etapa_confirmacao): ?>

            <!-- ===================================================================
                 TELA DE CONFIRMAÇÃO DO CADASTRO E PREPARAÇÃO DO PRATO
                 =================================================================== -->
            <div class="processing-card">
                
                <div style="text-align: center;">
                    <span class="status-badge" style="background-color: var(--accent-color);">
                        ✓ CADASTRO REALIZADO COM ÊXITO
                    </span>
                    
                    <h2 style="color: var(--primary-color); margin-top: 1rem; margin-bottom: 0.5rem;">
                        Seu pedido está sendo preparado!
                    </h2>
                    
                    <p style="font-size: 1.15rem; color: #444; max-width: 600px; margin: 0 auto 1.5rem auto;">
                        Olá, <strong><?php echo $nome_completo; ?></strong>! Seu cadastro foi concluído com sucesso e o seu pedido <strong>#<?php echo $numero_pedido; ?></strong> já está em fase de preparação em nossa cozinha para posterior envio.
                    </p>
                </div>

                <div class="dados-box">
                    <h3 style="color: var(--primary-color); border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                        Resumo do Cadastro & Pedido
                    </h3>

                    <p><strong>Prato Solicitado:</strong> <?php echo $prato_escolhido; ?> (Qtd: <?php echo $quantidade; ?>)</p>
                    <?php if (!empty($observacoes_pedido)): ?>
                        <p><strong>Observações:</strong> <?php echo $observacoes_pedido; ?></p>
                    <?php endif; ?>

                    <hr style="margin: 0.8rem 0; border: 0; border-top: 1px solid #e0e0e0;">

                    <p><strong>Cliente:</strong> <?php echo $nome_completo; ?> | <strong>CPF:</strong> <?php echo $cpf; ?></p>
                    <p><strong>Contatos:</strong> <?php echo $email; ?> | Tel: <?php echo $telefone; ?></p>
                    <p><strong>Endereço de Entrega:</strong> <?php echo $endereco; ?>, <?php echo $bairro; ?> (CEP: <?php echo $cep; ?>)</p>
                    <p><strong>Forma de Pagamento:</strong> <?php echo $forma_pagamento; ?></p>

                    <p style="margin-top: 1rem; font-size: 0.85rem; color: #777;">
                        <strong>Confirmado em:</strong> <?php echo $data_processamento; ?>
                    </p>
                </div>

                <div class="action-buttons">
                    <a href="produtos.php" class="btn">Voltar ao Cardápio</a>
                    <a href="index.php" class="btn btn-secondary">Menu Principal</a>
                </div>

            </div>

        <?php else: ?>

            <!-- ===================================================================
                 FORMULÁRIO DE CADASTRO DO CLIENTE
                 =================================================================== -->
            <section class="form-section">
                
                <div class="resumo-pedido-box">
                    <h3 style="margin-bottom: 0.5rem; font-size: 1.1rem;">Item Selecionado do Cardápio:</h3>
                    <p><strong>Prato:</strong> <?php echo $prato_escolhido; ?></p>
                    <p><strong>Quantidade:</strong> <?php echo $quantidade; ?> unidade(s)</p>
                    <?php if (!empty($observacoes_pedido)): ?>
                        <p><strong>Obs do Item:</strong> <?php echo $observacoes_pedido; ?></p>
                    <?php endif; ?>
                </div>

                <h2 style="color: var(--primary-color); text-align: center; margin-bottom: 0.5rem;">Passo 2: Cadastro do Cliente</h2>
                <p style="text-align: center; color: #666; margin-bottom: 2rem;">Preencha os dados abaixo para confirmar o cadastro e a preparação do pedido.</p>

                <?php if (!empty($mensagem_erro)): ?>
                    <div style="background-color: #f8d7da; color: #721c24; padding: 0.8rem; border-radius: 4px; margin-bottom: 1rem; text-align: center;">
                        <?php echo $mensagem_erro; ?>
                    </div>
                <?php endif; ?>

                <!-- Envia os dados para este mesmo arquivo cadastro.php -->
                <form action="cadastro.php" method="POST">
                    
                    <input type="hidden" name="prato_escolhido" value="<?php echo $prato_escolhido; ?>">
                    <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
                    <input type="hidden" name="observacoes_pedido" value="<?php echo $observacoes_pedido; ?>">
                    <input type="hidden" name="finalizar_cadastro" value="1">

                    <div class="form-grid">
                        
                        <div class="form-group full-width">
                            <label for="nome_completo">Nome Completo *</label>
                            <input type="text" id="nome_completo" name="nome_completo" required placeholder="Digite seu nome completo" value="<?php echo $nome_completo; ?>">
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF *</label>
                            <input type="text" id="cpf" name="cpf" required placeholder="000.000.000-00" value="<?php echo $cpf; ?>">
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone / WhatsApp *</label>
                            <input type="tel" id="telefone" name="telefone" required placeholder="(XX) XXXXX-XXXX" value="<?php echo $telefone; ?>">
                        </div>

                        <div class="form-group full-width">
                            <label for="email">Endereço de E-mail *</label>
                            <input type="email" id="email" name="email" required placeholder="seuemail@exemplo.com" value="<?php echo $email; ?>">
                        </div>

                        <div class="form-group full-width">
                            <label for="endereco">Endereço de Entrega *</label>
                            <input type="text" id="endereco" name="endereco" required placeholder="Ex: Av. Brasil, 1500, Apto 302" value="<?php echo $endereco; ?>">
                        </div>

                        <div class="form-group">
                            <label for="bairro">Bairro *</label>
                            <input type="text" id="bairro" name="bairro" required placeholder="Digite seu bairro" value="<?php echo $bairro; ?>">
                        </div>

                        <div class="form-group">
                            <label for="cep">CEP *</label>
                            <input type="text" id="cep" name="cep" required placeholder="00000-000" value="<?php echo $cep; ?>">
                        </div>

                        <div class="form-group full-width">
                            <label for="forma_pagamento">Forma de Pagamento *</label>
                            <select id="forma_pagamento" name="forma_pagamento" required>
                                <option value="">-- Selecione o método de pagamento --</option>
                                <option value="Pix (Pagamento Instantâneo)" <?php echo ($forma_pagamento == 'Pix (Pagamento Instantâneo)') ? 'selected' : ''; ?>>Pix (Pagamento Instantâneo)</option>
                                <option value="Cartão de Crédito (Na Entrega)" <?php echo ($forma_pagamento == 'Cartão de Crédito (Na Entrega)') ? 'selected' : ''; ?>>Cartão de Crédito (Na Entrega)</option>
                                <option value="Cartão de Débito (Na Entrega)" <?php echo ($forma_pagamento == 'Cartão de Débito (Na Entrega)') ? 'selected' : ''; ?>>Cartão de Débito (Na Entrega)</option>
                                <option value="Dinheiro" <?php echo ($forma_pagamento == 'Dinheiro') ? 'selected' : ''; ?>>Dinheiro</option>
                            </select>
                        </div>

                    </div>

                    <div class="action-buttons">
                        <a href="produtos.php" class="btn btn-secondary">← Voltar ao Cardápio</a>
                        <button type="submit" class="btn">Finalizar Cadastro e Pedido &rarr;</button>
                    </div>

                </form>
            </section>

        <?php endif; ?>

    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Bistrô Sabor & Arte - Todos os direitos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>