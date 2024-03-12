<?php
// Dados de conexão com o banco de dados PostgreSQL
$host = 'localhost';
$dbname = 'TiquinhoPizzaria';
$username = 'postgres';
$password = 'postgres';

// Dados do formulário
$nome = $_POST['nome_cliente'];
$endereco = $_POST['endereco_cliente'];
$telefone = $_POST['telefone_cliente'];
$email = $_POST['email_cliente'];
$senha = md5($_POST['senha_cliente']);

try {
    // Conexão com o banco de dados
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

    // Preparar a consulta SQL para criar a tabela "cliente" se ela não existir
    $sql_create_table = "CREATE TABLE IF NOT EXISTS cliente (
        id_cliente SERIAL PRIMARY KEY,
        nome_cliente varchar(100),
        endereco_cliente varchar(255),
        telefone_cliente varchar(20),
        email_cliente varchar(100),
        senha_cliente varchar(32)
    )";

    // Executar a consulta SQL para criar a tabela "cliente" se ela não existir
    $pdo->exec($sql_create_table);

    // Preparar a consulta SQL para inserção de dados na tabela "cliente"
    $sql_insert = "INSERT INTO cliente (nome_cliente, endereco_cliente, telefone_cliente, email_cliente, senha_cliente)
                    VALUES (:nome, :endereco, :telefone, :email, :senha)";
    $stmt = $pdo->prepare($sql_insert);

    // Executar a consulta com os parâmetros
    $stmt->execute(array(
        ':nome' => $nome,
        ':endereco' => $endereco,
        ':telefone' => $telefone,
        ':email' => $email,
        ':senha' => $senha
    ));

    echo "Cadastro realizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
