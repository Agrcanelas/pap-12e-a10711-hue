<?php
require_once 'configconexao.php';

function criar_ticket($dados) {
    $conn = obter_conexao();
    
    $sql = "INSERT INTO tickets (cliente_nome, cliente_email, cliente_telefone, 
            marca_mota, modelo_mota, ano_mota, descricao_avaria) 
            VALUES (:nome, :email, :telefone, :marca, :modelo, :ano, :descricao)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':marca' => $dados['marca'],
            ':modelo' => $dados['modelo'],
            ':ano' => $dados['ano'],
            ':descricao' => $dados['descricao']
        ]);
        return ['sucesso' => true, 'mensagem' => 'Tíquete criado com sucesso!', 'id' => $conn->lastInsertId()];
    } catch(PDOException $e) {
        return ['sucesso' => false, 'mensagem' => 'Erro ao criar tíquete: ' . $e->getMessage()];
    }
}

function listar_tickets($filtro_status = null, $busca = null) {
    $conn = obter_conexao();
    
    $sql = "SELECT * FROM tickets WHERE 1=1";
    $params = [];
    
    if ($filtro_status) {
        $sql .= " AND status = :status";
        $params[':status'] = $filtro_status;
    }
    
    if ($busca) {
        $sql .= " AND (cliente_nome LIKE :busca OR modelo_mota LIKE :busca OR marca_mota LIKE :busca)";
        $params[':busca'] = '%' . $busca . '%';
    }
    
    $sql .= " ORDER BY data_criacao DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function obter_ticket($id) {
    $conn = obter_conexao();
    $sql = "SELECT * FROM tickets WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function atualizar_status_ticket($id, $novo_status, $observacoes = null) {
    $conn = obter_conexao();
    $sql = "UPDATE tickets SET status = :status, observacoes = :obs WHERE id = :id";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':status' => $novo_status,
            ':obs' => $observacoes,
            ':id' => $id
        ]);
        return ['sucesso' => true, 'mensagem' => 'Status atualizado!'];
    } catch(PDOException $e) {
        return ['sucesso' => false, 'mensagem' => 'Erro: ' . $e->getMessage()];
    }
}

function obter_estatisticas() {
    $conn = obter_conexao();
    $sql = "SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN status = 'pendente' THEN 1 ELSE 0 END) as pendentes,
            SUM(CASE WHEN status = 'em_reparacao' THEN 1 ELSE 0 END) as em_reparacao,
            SUM(CASE WHEN status = 'concluido' THEN 1 ELSE 0 END) as concluidos
            FROM tickets";
    $stmt = $conn->query($sql);
    return $stmt->fetch();
}

function eliminar_ticket($id) {
    $conn = obter_conexao();
    $sql = "DELETE FROM tickets WHERE id = :id";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return ['sucesso' => true, 'mensagem' => 'Tíquete eliminado!'];
    } catch(PDOException $e) {
        return ['sucesso' => false, 'mensagem' => 'Erro: ' . $e->getMessage()];
    }
}
?>