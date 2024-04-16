-- Tabela cliente
CREATE TABLE cliente (
    id_cliente INT SERIAL PRIMARY KEY,
    nome_cliente VARCHAR(100),
    telefone_cliente VARCHAR(20),
    endereco_cliente VARCHAR(255),
    email_cliente VARCHAR(100),
    senha_cliente VARCHAR(50)
);

-- Tabela funcionários
CREATE TABLE funcionarios (
    id_funcionario INT SERIAL PRIMARY KEY,
    nome_funcionario VARCHAR(100),
    cargo_funcionario VARCHAR(100),
    email_funcionario VARCHAR(100),
    telefone_funcionario VARCHAR(20),
    cpf_funcionario VARCHAR(14),
    data_contratacao DATE
);

-- Tabela pizzas
CREATE TABLE pizzas (
    id_pizza INT SERIAL PRIMARY KEY,
    sabor_pizza VARCHAR(100),
    preco_pizza DECIMAL(10, 2),
    tamanho_pizza VARCHAR(20),
    borda_pizza VARCHAR(50),
    descricao_pizza TEXT
);

-- Tabela gera_pedido
CREATE TABLE gera_pedido (
    id_pedido INT,
    id_funcionario INT,
    id_cliente INT,
    FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
    FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id_funcionario),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
    PRIMARY KEY (id_pedido, id_funcionario)
);

-- Tabela itens_pedido
CREATE TABLE itens_pedido (
    id_item INT SERIAL PRIMARY KEY,
    id_pedido INT,
    quantidade INT,
    preco_unitario DECIMAL(10, 2),
    subtotal_pedido DECIMAL(10, 2),
    id_pizza INT,
    FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
    FOREIGN KEY (id_pizza) REFERENCES pizzas(id_pizza)
);

-- Tabela pacote_pedido
CREATE TABLE pacote_pedido (
    id_item INT,
    id_pedido INT,
    FOREIGN KEY (id_item) REFERENCES itens_pedido(id_item),
    FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
    PRIMARY KEY (id_item, id_pedido)
);

-- Tabela pedido
CREATE TABLE pedido (
    id_pedido INT SERIAL PRIMARY KEY,
    id_cliente INT,
    data_pedido DATE,
    status_pedido VARCHAR(50),
    total_pedido DECIMAL(10, 2),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

-- Inserir dados na tabela cliente
INSERT INTO cliente (nome_cliente, telefone_cliente, endereco_cliente, email_cliente, senha_cliente)
VALUES 
    ('João Silva', '123456789', 'Rua A, 123', 'joao@example.com', 'senha123'),
    ('Maria Souza', '987654321', 'Avenida B, 456', 'maria@example.com', 'senha456'),
    ('Pedro Oliveira', '111222333', 'Rua C, 789', 'pedro@example.com', 'senha789');

-- Inserir dados na tabela funcionarios
INSERT INTO funcionarios (nome_funcionario, cargo_funcionario, email_funcionario, telefone_funcionario, cpf_funcionario, data_contratacao)
VALUES 
    ('José Santos', 'Atendente', 'jose@example.com', '999888777', '123.456.789-00', '2022-01-10'),
    ('Ana Costa', 'Cozinheira', 'ana@example.com', '777888999', '987.654.321-00', '2022-02-15');

-- Inserir dados na tabela pizzas
INSERT INTO pizzas (sabor_pizza, preco_pizza, tamanho_pizza, borda_pizza, descricao_pizza)
VALUES 
    ('Margherita', 25.00, 'Média', 'Tradicional', 'Molho de tomate, mussarela, manjericão'),
    ('Calabresa', 30.00, 'Grande', 'Catupiry', 'Molho de tomate, calabresa, cebola, catupiry'),
    ('Frango com Catupiry', 35.00, 'Família', 'Cheddar', 'Molho de tomate, frango desfiado, catupiry');

-- Inserir dados na tabela pedido
INSERT INTO pedido (id_cliente, data_pedido, status_pedido, total_pedido)
VALUES 
    (1, '2024-04-16', 'Em andamento', 0),
    (2, '2024-04-15', 'Entregue', 45.00),
    (3, '2024-04-14', 'Entregue', 35.00);

-- Inserir dados na tabela itens_pedido
INSERT INTO itens_pedido (id_pedido, quantidade, preco_unitario, subtotal_pedido, id_pizza)
VALUES 
    (1, 2, 25.00, 50.00, 1),
    (2, 1, 30.00, 30.00, 2),
    (3, 1, 35.00, 35.00, 3);

-- Inserir dados na tabela pacote_pedido
INSERT INTO pacote_pedido (id_item, id_pedido)
VALUES 
    (1, 1),
    (2, 2),
    (3, 3);

-- Inserir dados na tabela gera_pedido
INSERT INTO gera_pedido (id_pedido, id_funcionario, id_cliente)
VALUES 
    (1, 1, 1),
    (2, 2, 2),
    (3, 1, 3);
