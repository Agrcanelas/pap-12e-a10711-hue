<?php
// Validar email
function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validar telefone (formato português)
function validar_telefone($telefone) {
    $telefone = preg_replace('/[^0-9]/', '', $telefone);
    return strlen($telefone) === 9 && in_array($telefone[0], ['9', '2']);
}

// Limpar input
function limpar_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validar dados do tíquete
function validar_ticket($dados) {
    $erros = [];
    
    if (empty($dados['nome']) || strlen($dados['nome']) < 3) {
        $erros[] = "Nome deve ter pelo menos 3 caracteres";
    }
    
    if (!validar_email($dados['email'])) {
        $erros[] = "Email inválido";
    }
    
    if (!validar_telefone($dados['telefone'])) {
        $erros[] = "Telefone inválido";
    }
    
    if (empty($dados['marca'])) {
        $erros[] = "Marca é obrigatória";
    }
    
    if (empty($dados['modelo'])) {
        $erros[] = "Modelo é obrigatório";
    }
    
    if (empty($dados['ano']) || $dados['ano'] < 1900 || $dados['ano'] > date('Y')) {
        $erros[] = "Ano inválido";
    }
    
    if (empty($dados['descricao']) || strlen($dados['descricao']) < 10) {
        $erros[] = "Descrição deve ter pelo menos 10 caracteres";
    }
    
    return $erros;
}
?>