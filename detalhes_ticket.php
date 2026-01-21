<?php
require_once 'config/conexao.php';
require_once 'funcoes/tickets.php';

$titulo_pagina = "Detalhes do Tíquete";

if (!isset($_GET['id'])) {
    header('Location: listar_tickets.php');
    exit;
}

$ticket = obter_ticket($_GET['id']);

if (!$ticket) {
    header('Location: listar_tickets.php');
    exit;
}

include 'includes/header.php';
include 'includes/nav.php';
?>

<main>
    <section class="container">
        <div class="card">
            <div class="ticket-header">
                <h2>Tíquete #<?php echo $ticket['id']; ?></h2>
                <span class="badge badge-<?php echo $ticket['status']; ?>">
                    <?php echo ucfirst(str_replace('_', ' ', $ticket['status'])); ?>
                </span>
            </div>
            
            <div class="ticket-details">
                <div class="detail-section">
                    <h3>Informações do Cliente</h3>
                    <p><strong>Nome:</strong> <?php echo htmlspecialchars($ticket['cliente_nome']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($ticket['cliente_email']); ?></p>
                    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($ticket['cliente_telefone']); ?></p>
                </div>
                
                <div class="detail-section">
                    <h3>Dados da Mota</h3>
                    <p><strong>Marca:</strong> <?php echo htmlspecialchars($ticket['marca_mota']); ?></p>
                    <p><strong>Modelo:</strong> <?php echo htmlspecialchars($ticket['modelo_mota']); ?></p>
                    <p><strong>Ano:</strong> <?php echo $ticket['ano_mota']; ?></p>
                </div>
                
                <div class="detail-section">
                    <h3>Descrição da Avaria</h3>
                    <p><?php echo nl2br(htmlspecialchars($ticket['descricao_avaria'])); ?></p>
                </div>
                
                <?php if ($ticket['observacoes']): ?>
                <div class="detail-section">
                    <h3>Observações</h3>
                    <p><?php echo nl2br(htmlspecialchars($ticket['observacoes'])); ?></p>
                </div>
                <?php endif; ?>
                
                <div class="detail-section">
                    <h3>Datas</h3>
                    <p><strong>Criado em:</strong> <?php echo date('d/m/Y H:i', strtotime($ticket['data_criacao'])); ?></p>
                    <p><strong>Última atualização:</strong> <?php echo date('d/m/Y H:i', strtotime($ticket['data_atualizacao'])); ?></p>
                </div>
            </div>
            
            <div class="ticket-actions">
                <h3>Atualizar Status</h3>