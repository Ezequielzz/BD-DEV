<?php
// processa_locacao.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cidade = $_POST['cidade'];
    $endereco = $_POST['endereco'];
    $estado = $_POST['estado'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Conexão com o banco de dados
    $conn = pg_connect("host=localhost dbname=locadoraEzequielzz user=postgres password=postgres");

    // Verifica a conexão
    if (!$conn) {
        die("Conexão falhou: " . pg_last_error());
    }

    // Insere os dados na tabela de locação
    $sql = "INSERT INTO clientes (nome, sobrenome, endereco, cidade, estado, telefone, email)
            VALUES ('$nome', '$sobrenome', '$endereco', '$cidade', '$estado', '$telefone', '$email')";
    $result = pg_query($conn, $sql);

    if ($result) {
        header("Location: cadastro.html");
        exit();
    } else {
        echo "Erro: " . pg_last_error();
    }
    pg_close($conn);
}
