<nav>
    <div class="nav-container">
        <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
            Início
        </a>
        <a href="criar_ticket.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'criar_ticket.php' ? 'active' : ''; ?>">
            Criar Tíquete
        </a>
        <a href="listar_tickets.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'listar_tickets.php' ? 'active' : ''; ?>">
            Ver Tíquetes
        </a>
        <a href="motas_venda.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'motas_venda.php' ? 'active' : ''; ?>">
            Motas Usadas
        </a>
    </div>
</nav>