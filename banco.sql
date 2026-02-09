CREATE DATABASE chavesenai;
USE chavesenai;

-- =========================
-- TABELA DE USUÁRIOS
-- =========================
CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(100) NOT NULL,
    email_usuario VARCHAR(100) NOT NULL,
    senha_usuario VARCHAR(100) NOT NULL,
    telefone_usuario VARCHAR(50),
    cpf_usuario VARCHAR(50),
    nivel_acesso VARCHAR(50) NOT NULL
    status_usuario VARCHAR(50) NOT NULL
);

-- =========================
-- TABELA DE BLOCOS
-- =========================
CREATE TABLE bloco_predial (
    id_bloco INT PRIMARY KEY AUTO_INCREMENT,
    nome_bloco VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
);

-- =========================
-- TABELA DE SALAS
-- =========================
CREATE TABLE sala (
    id_sala INT PRIMARY KEY AUTO_INCREMENT,
    nome_sala VARCHAR(100) NOT NULL,
    id_bloco INT,
    status_sala VARCHAR(50),
    FOREIGN KEY (id_bloco) REFERENCES bloco_predial(id_bloco)
);

-- =========================
-- TABELA DE EMPRÉSTIMO DE CHAVES
-- =========================
CREATE TABLE emprestimo_chave (
    id_emprestimo INT PRIMARY KEY AUTO_INCREMENT,
    data_emprestimo DATE NOT NULL,
    hora_retirada TIME ,
    hora_devolucao TIME,
    periodo VARCHAR(50) NOT NULL,
    status_emprestimo VARCHAR(50) NOT NULL,
    evento VARCHAR(255),
    id_usuario INT,
    id_sala INT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_sala) REFERENCES sala(id_sala)
);

