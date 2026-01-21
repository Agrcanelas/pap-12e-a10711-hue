<?php
// Configurações da base de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestao_motas');
define('DB_USER', 'root');
define('DB_PASS', '');

// Criar ligação
function obter_conexao() {
    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("Erro na ligação à base de dados: " . $e->getMessage());
    }
}

// Iniciar sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>