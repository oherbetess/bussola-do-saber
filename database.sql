-- Script de Criação do Banco de Dados: Bússola do Saber

-- 1. Criar a Tabela de Usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('comum', 'admin') DEFAULT 'comum',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Criar a Tabela de Cursos
CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    instituicao VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    link_acesso VARCHAR(255) NOT NULL,
    descricao TEXT
);

-- 3. Criar a Tabela de Avaliações
CREATE TABLE IF NOT EXISTS avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    curso_id INT NOT NULL,
    nota INT NOT NULL,
    comentario TEXT,
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE
);

-- 4. Criar a Tabela de Certificados
CREATE TABLE IF NOT EXISTS certificados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome_curso VARCHAR(255) NOT NULL,
    instituicao VARCHAR(255) NOT NULL,
    arquivo_path VARCHAR(255) NOT NULL,
    data_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- 5. Inserir Usuário Administrador Inicial
-- Email: admin@admin.com | Senha: 123
INSERT INTO usuarios (nome, email, senha, tipo) VALUES 
('Administrador', 'admin@admin.com', '$2y$10$fVfKzX0N1UvX9t9z1W2u9.pZ5p4vS1v6fH5eC5fG7n8j9k0l1m2n3', 'admin');

-- 6. Inserir alguns cursos iniciais para teste
INSERT INTO cursos (nome, instituicao, categoria, link_acesso, descricao) VALUES 
('Lógica de Programação', 'Fundação Bradesco', 'Tecnologia', 'https://www.ev.org.br', 'Fundamentos essenciais de algoritmos e lógica.'),
('Marketing Digital', 'SEBRAE', 'Marketing', 'https://www.sebrae.com.br', 'Aprenda a vender e se posicionar na internet.'),
('Python 3', 'Curso em Vídeo', 'Programação', 'https://www.cursoemvideo.com', 'Curso completo de Python do zero ao básico.');