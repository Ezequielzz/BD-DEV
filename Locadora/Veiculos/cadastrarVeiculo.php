<?php
// processa_locacao.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $ano = $_POST['ano'];
    $tipo = $_POST['tipo'];
    $disponibilidade = $_POST['disponibilidade'];

    // Conexão com o banco de dados
    $conn = pg_connect("host=localhost dbname=locadoraEzequielzz user=postgres password=postgres");

    // Verifica a conexão
    if (!$conn) {
        die("Conexão falhou: " . pg_last_error());
    }

    // Insere os dados na tabela de locação
    $sql = "INSERT INTO carro (modelo, placa, ano, tipo, disponibilidade)
            VALUES ('$modelo', '$placa', '$ano', '$tipo', '$disponibilidade')";
    $result = pg_query($conn, $sql);

    if ($result) {
        header("Location: cadastroVeiculo.html");
        exit();
    } else {
        echo "Erro: " . pg_last_error();
    }
    pg_close($conn);
}
