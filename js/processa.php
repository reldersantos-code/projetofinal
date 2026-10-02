<?php

$sucesso = false;
$mensagem_erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitização e Recebimento dos Dados
    $nome_completo = isset($_POST['nome_completo']) ? htmlspecialchars(trim($_POST['nome_completo'])) : '';
    $cpf = isset($_POST['cpf']) ? htmlspecialchars(trim($_POST['cpf'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $telefone = isset($_POST['telefone']) ? htmlspecialchars(trim($_POST['telefone'])) : '';
    $endereco = isset($_POST['endereco']) ? htmlspecialchars(trim($_POST['endereco'])) : '';
    $bairro = isset($_POST['bairro']) ? htmlspecialchars(trim($_POST['bairro'])) : '';
    $cep = isset($_POST['cep']) ? htmlspecialchars(trim($_POST['cep'])) : '';
    $forma_pagamento = isset($_POST['forma_pagamento']) ? htmlspecialchars(trim($_POST['forma_pagamento'])) : '';

    // Dados do Pedido
    $prato_escolhido = isset($_POST['prato_escolhido']) ? htmlspecialchars(trim($_POST['prato_escolhido'])) : '';
    $quantidade = isset($_POST['quantidade']) ? htmlspecialchars(trim($_POST['quantidade'])) : '1';
    $observacoes_pedido = isset($_POST['observacoes_pedido']) ? htmlspecialchars(trim($_POST['observacoes_pedido'])) : '';

    // Validação de Campos Obrigatórios do Cadastro no PHP
    if (empty($nome_completo) || empty($cpf) || empty($email) || empty($endereco) || empty($forma_pagamento)) {
        $mensagem_erro = "Erro no cadastro: Por favor, preencha todos os campos obrigatórios.";
    } else {
        $sucesso = true;
        date_default_timezone_set('America/Sao_Paulo');
        $data_processamento = date('d/m/Y \à\s H:i:s');
        $numero_pedido = rand(1000, 9999);
    }

} else {
    // Se o acesso não for via POST, redireciona ao cardápio
    header("Location: produtos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Pedido - Bistrô Sabor & Arte</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Bistrô Sabor & Arte</h1>
        <nav>
            <a href="index.php">Menu Principal</a>
            <a href="produtos.php">Cardápio</a>
        </nav>
    </header>

    <main class="container">
        
        <div class="processing-card">
            
            <?php if (!$sucesso): ?>
                
                <!-- Exibição em caso de falha de validação -->
                <h2 style="color: #c0392b; text-align: center; margin-bottom: 1rem;">Atenção!</h2>
                <p style="text-align: center; font-size: 1.1rem;"><?php echo $mensagem_erro; ?></p>
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="produtos.php" class="btn">Voltar ao Cardápio</a>
                </div>

            <?php else: ?>

                <!-- Tela de Sucesso Solicitada -->
                <div style="text-align: center;">
                    <span class="status-badge" style="background-color: var(--accent-color);">
                        ✓ CADASTRO REALIZADO COM ÊXITO
                    </span>
                    
                    <h2 style="color: var(--primary-color); margin-top: 1rem; margin-bottom: 0.5rem;">
                        Seu pedido está sendo preparado!
                    </h2>
                    
                    <p style="font-size: 1.15rem; color: #444; max-width: 600px; margin: 0 auto 1.5rem auto;">
                        Olá, <strong><?php echo $nome_completo; ?></strong>! Seu cadastro foi concluído com sucesso e o seu pedido <strong>#<?php echo $numero_pedido; ?></strong> já entrou em linha de preparação para envio.
                    </p>
                </div>

                <!-- Resumo dos Dados Registrados pelo PHP -->
                <div class="dados-box">
                    <h3 style="color: var(--primary-color); border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                        Resumo da Solicitação Processada
                    </h3>

                    <p><strong>Item Solicitado:</strong> <?php echo $prato_escolhido; ?> (Qtd: <?php echo $quantidade; ?>)</p>
                    <?php if (!empty($observacoes_pedido)): ?>
                        <p><strong>Observações:</strong> <?php echo $observacoes_pedido; ?></p>
                    <?php endif; ?>

                    <hr style="margin: 0.8rem 0; border: 0; border-top: 1px solid #e0e0e0;">

                    <p><strong>Cliente:</strong> <?php echo $nome_completo; ?> | <strong>CPF:</strong> <?php echo $cpf; ?></p>
                    <p><strong>E-mail:</strong> <?php echo $email; ?> | <strong>Telefone:</strong> <?php echo $telefone; ?></p>
                    <p><strong>Endereço de Entrega:</strong> <?php echo $endereco; ?>, <?php echo $bairro; ?> - CEP: <?php echo $cep; ?></p>
                    <p><strong>Forma de Pagamento:</strong> <?php echo $forma_pagamento; ?></p>

                    <p style="margin-top: 1rem; font-size: 0.85rem; color: #777;">
                        <strong>Data/Hora do Processamento PHP:</strong> <?php echo $data_processamento; ?>
                    </p>
                </div>

                <!-- Botões de Navegação -->
                <div class="action-buttons">
                    <a href="produtos.php" class="btn">Voltar ao Cardápio</a>
                    <a href="index.php" class="btn btn-secondary">Menu Principal</a>
                </div>

            <?php endif; ?>

        </div>

    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Bistrô Sabor & Arte - Todos os direitos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>