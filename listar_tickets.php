<?php
require_once 'configconexao.php';
require_once 'funcoestickets.php';

$titulo_pagina = "Lista de Tíquetes";

$filtro_status = $_GET['status'] ?? null;
$busca = $_GET['busca'] ?? null;

$tickets = listar_tickets($filtro_status, $busca);

include 'includesheader.php';
include 'includesnav.php';
?>

<main>
    <section class="container">
        <div class="card">
            <h2>Tíquetes de Avarias</h2>
            
            <div class="filtros">
                <form method="GET" action="" class="form-filtro">
                    <input type="text" name="busca" placeholder="Pesquisar por nome ou modelo..." value="<?php echo htmlspecialchars($busca ?? ''); ?>">
                    
                    <select name="status">
                        <option value="">Todos os status</option>
                        <option value="pendente" <?php echo $filtro_status === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                        <option value="em_analise" <?php echo $filtro_status === 'em_analise' ? 'selected' : ''; ?>>Em Análise</option>
                        <option value="em_reparacao" <?php echo $filtro_status === 'em_reparacao' ? 'selected' : ''; ?>>Em Reparação</option>
                        <option value="concluido" <?php echo $filtro_status === 'concluido' ? 'selected' : ''; ?>>Concluído</option>
                    </select>
                    
                    <button type="submit" class="btn">Filtrar</button>
                    <a href="listar_tickets.php" class="btn btn-secondary">Limpar</a>
                </form>
            </div>
            
            <?php if (count($tickets) > 0): ?>
                <div class="table-responsive">
                    <table class="table-tickets">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Contacto</th>
                                <th>Mota</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket): ?>
                            <tr>
                                <td><?php echo $ticket['id']; ?></td>
                                <td><?php echo htmlspecialchars($ticket['cliente_nome']); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($ticket['cliente_email']); ?><br>
                                    <small><?php echo htmlspecialchars($ticket['cliente_telefone']); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($ticket['marca_mota'] . ' ' . $ticket['modelo_mota']); ?></strong><br>
                                    <small><?php echo $ticket['ano_mota']; ?></small>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo $ticket['status']; ?>">
                                        <?php echo ucfirst(str_replace('_', ' ', $ticket['status'])); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($ticket['data_criacao'])); ?></td>
                                <td>
                                    <a href="detalhes_ticket.php?id=<?php echo $ticket['id']; ?>" class="btn btn-small">Ver</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="no-results">Nenhum tíquete encontrado.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includesfooter.php'; ?>