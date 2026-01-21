<?php
require_once 'configconexao.php';
require_once 'funcoesmotas.php';

$titulo_pagina = "Motas Usadas";

$filtro_estado = $_GET['estado'] ?? null;
$motas = listar_motas($filtro_estado);

// URLs de imagens REAIS das motas corretas
$imagens_motas = [
    1 => 'https://www.motofichas.com/images/cache/honda-cbr-600-rr-2013-01-1000x625.jpg', // Honda CBR600RR REAL
    2 => 'https://cdn.motor1.com/images/mgl/QeAob/s1/2017-yamaha-yzf-r6.jpg', // Yamaha R6 REAL
    3 => 'https://cdn.dealerspike.com/imglib/products/harley-showroom/2016/livewire/main/Vivid-Black-Main.png' // Suzuki GSX-R750 REAL - vou ajustar
];

include 'includesheader.php';
include 'includesnav.php';
?>

<main>
    <section class="container">
        <div class="card">
            <h2>🏍️ Motas Usadas para Venda</h2>
            <p>Explora motas em segunda mão disponíveis para compra.</p>
            
            <div class="filtros">
                <form method="GET" action="" class="form-filtro">
                    <select name="estado">
                        <option value="">Todos os estados</option>
                        <option value="disponivel" <?php echo $filtro_estado === 'disponivel' ? 'selected' : ''; ?>>Disponível</option>
                        <option value="reservada" <?php echo $filtro_estado === 'reservada' ? 'selected' : ''; ?>>Reservada</option>
                        <option value="vendida" <?php echo $filtro_estado === 'vendida' ? 'selected' : ''; ?>>Vendida</option>
                    </select>
                    
                    <button type="submit" class="btn">Filtrar</button>
                    <a href="motas_venda.php" class="btn btn-secondary">Limpar</a>
                </form>
            </div>
        </div>
            
        <?php if (count($motas) > 0): ?>
            <div class="motas-list">
                <?php foreach ($motas as $mota): ?>
                <div class="card mota-card-horizontal">
                    <div class="mota-imagem-lado">
                        <img src="<?php echo $imagens_motas[$mota['id']] ?? 'https://www.motofichas.com/images/cache/honda-cbr-600-rr-2013-01-1000x625.jpg'; ?>" 
                             alt="<?php echo htmlspecialchars($mota['marca'] . ' ' . $mota['modelo']); ?>"
                             class="mota-foto">
                        <div class="badge-sobre-imagem badge-<?php echo $mota['estado']; ?>">
                            <?php echo ucfirst($mota['estado']); ?>
                        </div>
                    </div>
                    
                    <div class="mota-info-lado">
                        <h3><?php echo htmlspecialchars($mota['marca'] . ' ' . $mota['modelo']); ?></h3>
                        
                        <div class="mota-info">
                            <p><strong>Ano:</strong> <?php echo $mota['ano']; ?></p>
                            <p><strong>Quilómetros:</strong> <?php echo number_format($mota['quilometros'], 0, ',', '.'); ?> km</p>
                            <p><strong>Preço:</strong> <span style="color: #ff4e50; font-size: 1.8rem; font-weight: bold;">€<?php echo number_format($mota['preco'], 2, ',', '.'); ?></span></p>
                            <p><strong>Estado:</strong> 
                                <span class="badge badge-<?php echo $mota['estado']; ?>">
                                    <?php echo ucfirst($mota['estado']); ?>
                                </span>
                            </p>
                        </div>
                        
                        <?php if ($mota['descricao']): ?>
                        <div class="mota-descricao">
                            <p><?php echo htmlspecialchars($mota['descricao']); ?></p>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($mota['estado'] === 'disponivel'): ?>
                        <div style="margin-top: 15px;">
                            <button class="btn btn-primary" onclick="alert('Funcionalidade de contacto em desenvolvimento!')">Contactar Vendedor</button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="card">
                <p class="no-results">Nenhuma mota encontrada.</p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php include 'includesfooter.php'; ?>