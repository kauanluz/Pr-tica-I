CREATE DATABASE pratica_1_kauan;

USE pratica_1_kauan;

CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome_clientes VARCHAR(100) NOT NULL,
    email_clientes VARCHAR(100) NOT NULL,
    telefone_clientes VARCHAR(15)
);

CREATE TABLE colaborador (
    id_colaborador INT AUTO_INCREMENT PRIMARY KEY,
    nome_colaborador VARCHAR(100) NOT NULL,
    email_colaborador VARCHAR(100) NOT NULL,
    funcao_colaborador VARCHAR(100) NOT NULL
);

CREATE TABLE chamados (
    id_chamado INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    descricao_problema TEXT NOT NULL,
    criticidadeProblema ENUM('baixa', 'média', 'alta') DEFAULT 'baixa',
    statusProblema ENUM('aberto', 'em andamento', 'resolvido') DEFAULT 'aberto',
    data_abertura DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_colaborador_responsavel INT,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_colaborador_responsavel) REFERENCES colaborador(id_colaborador)
);