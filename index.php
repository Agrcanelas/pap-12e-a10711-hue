<?php
require_once 'configconexao.php';
require_once 'funcoestickets.php';

$titulo_pagina = "Início - Gestão de Avarias";
$estatisticas = obter_estatisticas();

include 'includesheader.php';
include 'includesnav.php';
?>

<main>
    <section class="intro container">
        <div class="card">
            <h2>Bem-vindo à plataforma!</h2>
            <p>Regista, acompanha e resolve avarias na tua mota de forma rápida e prática.</p>
        </div>
    </section>

    <section class="stats container">
        <h2>Estatísticas</h2>
        <div class="features">
            <div class="card stat-card">
                <h3><?php echo $estatisticas['total']; ?></h3>
                <p>Total de Tíquetes</p>
            </div>
            <div class="card stat-card">
                <h3><?php echo $estatisticas['pendentes']; ?></h3>
                <p>Pendentes</p>
            </div>
            <div class="card stat-card">
                <h3><?php echo $estatisticas['em_reparacao']; ?></h3>
                <p>Em Reparação</p>
            </div>
            <div class="card stat-card">
                <h3><?php echo $estatisticas['concluidos']; ?></h3>
                <p>Concluídos</p>
            </div>
        </div>
    </section>

    <section class="features container">
        <div class="card">
            <h3>📝 Registar Tíquetes</h3>
            <p>Cria um tíquete com a descrição da avaria e envia diretamente para os mecânicos.</p>
            <a href="criarticket.php" class="btn">Criar Tíquete</a>
        </div>
        <div class="card">
            <h3>📋 Consultar Tíquetes</h3>
            <p>Visualiza todos os tíquetes existentes e acompanha o status das reparações.</p>
            <a href="listarticket.php" class="btn">Ver Tíquetes</a>
        </div>
        <div class="card">
            <h3>🏍️ Motas Usadas</h3>
            <p>Explora motas em segunda mão disponíveis para compra e venda de forma segura.</p>
            <a href="motas_venda.php" class="btn">Ver Motas</a>
        </div>
    </section>
</main>

<?php include 'includesfooter.php'; ?>