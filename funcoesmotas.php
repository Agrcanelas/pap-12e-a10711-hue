<?php
require_once 'configconexao.php';

function listar_motas($filtro_estado = null) {
    $conn = obter_conexao();
    
    $sql = "SELECT * FROM motas_usadas WHERE 1=1";
    $params = [];
    
    if ($filtro_estado) {
        $sql .= " AND estado = :estado";
        $params[':estado'] = $filtro_estado;
    }
    
    $sql .= " ORDER BY data_criacao DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function obter_mota($id) {
    $conn = obter_conexao();
    $sql = "SELECT * FROM motas_usadas WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function adicionar_mota($dados) {
    $conn = obter_conexao();
    
    $sql = "INSERT INTO motas_usadas (marca, modelo, ano, quilometros, preco, descricao, imagem) 
            VALUES (:marca, :modelo, :ano, :km, :preco, :descricao, :imagem)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':marca' => $dados['marca'],
            ':modelo' => $dados['modelo'],
            ':ano' => $dados['ano'],
            ':km' => $dados['quilometros'],
            ':preco' => $dados['preco'],
            ':descricao' => $dados['descricao'],
            ':imagem' => $dados['imagem'] ?? null
        ]);
        return ['sucesso' => true, 'mensagem' => 'Mota adicionada com sucesso!'];
    } catch(PDOException $e) {
        return ['sucesso' => false, 'mensagem' => 'Erro: ' . $e->getMessage()];
    }
}
?>