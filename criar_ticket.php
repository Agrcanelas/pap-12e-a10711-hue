<?php
require_once 'configconexao.php';
require_once 'funcoestickets.php';
require_once 'funcoesavaliacoes.php';

$titulo_pagina = "Criar Tíquete";
$mensagem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => limpar_input($_POST['nome']),
        'email' => limpar_input($_POST['email']),
        'telefone' => limpar_input($_POST['telefone']),
        'marca' => limpar_input($_POST['marca']),
        'modelo' => limpar_input($_POST['modelo']),
        'ano' => limpar_input($_POST['ano']),
        'descricao' => limpar_input($_POST['descricao'])
    ];
    
    $erros = validar_ticket($dados);
    
    if (empty($erros)) {
        $resultado = criar_ticket($dados);
        $mensagem = $resultado;
    } else {
        $mensagem = ['sucesso' => false, 'mensagem' => implode('<br>', $erros)];
    }
}

include 'includesheader.php';
include 'includesnav.php';
?>

<main>
    <section class="container">
        <div class="card">
            <h2>Criar Novo Tíquete de Avaria</h2>
            
            <?php if ($mensagem): ?>
                <div class="alert <?php echo $mensagem['sucesso'] ? 'alert-success' : 'alert-error'; ?>">
                    <?php echo $mensagem['mensagem']; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" class="form-ticket">
                <h3>Dados do Cliente</h3>
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required value="<?php echo $_POST['nome'] ?? ''; ?>">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone *</label>
                        <input type="tel" id="telefone" name="telefone" required placeholder="9XXXXXXXX" value="<?php echo $_POST['telefone'] ?? ''; ?>">
                    </div>
                </div>
                
                <h3>Dados da Mota</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="marca">Marca *</label>
                        <input type="text" id="marca" name="marca" required placeholder="Ex: Honda, Yamaha..." value="<?php echo $_POST['marca'] ?? ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="modelo">Modelo *</label>
                        <input type="text" id="modelo" name="modelo" required placeholder="Ex: CB500F, MT-07..." value="<?php echo $_POST['modelo'] ?? ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="ano">Ano *</label>
                        <input type="number" id="ano" name="ano" required min="1900" max="<?php echo date('Y'); ?>" value="<?php echo $_POST['ano'] ?? ''; ?>">
                    </div>
                </div>
                
                <h3>Descrição da Avaria</h3>
                <div class="form-group">
                    <label for="descricao">Descreve o problema *</label>
                    <textarea id="descricao" name="descricao" rows="6" required placeholder="Descreve detalhadamente o problema da tua mota..."><?php echo $_POST['descricao'] ?? ''; ?></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Enviar Tíquete</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include 'includesfooter.php'; ?>