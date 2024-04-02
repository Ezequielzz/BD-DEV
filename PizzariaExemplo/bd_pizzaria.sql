CREATE TABLE IF NOT EXISTS contatos (
	id_contato INT NOT NULL PRIMARY KEY,
	nome varchar(255) not null,
	email varchar(255) not null,
	cel varchar(255) not null,
	pizza varchar(255) not null,
	cadastro date NOT NULL DEFAULT CURRENT_TIMESTAMP
)

INSERT INTO contatos (id_contato, nome, email, cel, pizza) VALUES 
(1, 'João Silva', 'joao@example.com', '11998765432', 'Calabresa'),
(2, 'Maria Oliveira', 'maria@example.com', '11987654321', 'Margherita'),
(3, 'Pedro Santos', 'pedro@example.com', '11976543210', 'Portuguesa'),
(4, 'Ana Souza', 'ana@example.com', '11965432109', 'Frango com Catupiry'),
(5, 'Luiza Costa', 'luiza@example.com', '11954321098', 'Quatro Queijos');
