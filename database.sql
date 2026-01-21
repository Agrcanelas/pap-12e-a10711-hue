-- Criar base de dados
CREATE DATABASE IF NOT EXISTS gestao_motas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestao_motas;

-- Tabela de tíquetes
CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nome VARCHAR(100) NOT NULL,
    cliente_email VARCHAR(100) NOT NULL,
    cliente_telefone VARCHAR(20) NOT NULL,
    marca_mota VARCHAR(50) NOT NULL,
    modelo_mota VARCHAR(50) NOT NULL,
    ano_mota INT NOT NULL,
    descricao_avaria TEXT NOT NULL,
    status ENUM('pendente', 'em_analise', 'em_reparacao', 'concluido', 'cancelado') DEFAULT 'pendente',
    observacoes TEXT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de motas usadas
CREATE TABLE IF NOT EXISTS motas_usadas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    ano INT NOT NULL,
    quilometros INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    descricao TEXT,
    imagem VARCHAR(255),
    estado ENUM('disponivel', 'vendida', 'reservada') DEFAULT 'disponivel',
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Inserir dados de exemplo
INSERT INTO tickets (cliente_nome, cliente_email, cliente_telefone, marca_mota, modelo_mota, ano_mota, descricao_avaria, status) VALUES
('João Silva', 'joao@email.com', '912345678', 'Honda', 'CB500F', 2020, 'Problema no arranque, faz barulho estranho', 'pendente'),
('Maria Santos', 'maria@email.com', '923456789', 'Yamaha', 'MT-07', 2019, 'Freio dianteiro a fazer ruído', 'em_analise'),
('Pedro Costa', 'pedro@email.com', '934567890', 'Kawasaki', 'Z650', 2021, 'Luz de avaria acesa no painel', 'concluido');

INSERT INTO motas_usadas (marca, modelo, ano, quilometros, preco, descricao, estado) VALUES
('Honda', 'CBR600RR', 2018, 15000, 8500.00, 'Mota em excelente estado, sempre em garagem', 'disponivel'),
('Yamaha', 'R6', 2017, 22000, 7200.00, 'Revisões em dia, sem quedas', 'disponivel'),
('Suzuki', 'GSX-R750', 2016, 18500, 6800.00, 'Documentos em dia, pneus novos', 'vendida');