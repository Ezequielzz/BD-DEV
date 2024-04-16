<?php
// Dados de conexão com o banco de dados PostgreSQL
$host = 'localhost';
$dbname = 'TiquinhoPizzaria';
$username = 'postgres';
$password = 'postgres';

// Função para conectar ao banco de dados
function connectToDatabase($host, $dbname, $username, $password)
{
    return new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
}

try {
    // Conexão com o banco de dados
    $pdo = connectToDatabase($host, $dbname, $username, $password);

    // Dados do formulário
    $sabor = $_POST['sabor_pizza'];
    $preco = $_POST['preco_pizza'];
    $tamanho = $_POST['tamanho_pizza'];
    $borda = $_POST['borda_pizza'];
    $descricao = $_POST['descricao_pizza'];

    // Preparar a consulta SQL para inserção de dados na tabela "pizzas"
    $sql_insert = "INSERT INTO pizzas (preco_pizza, sabor_pizza, tamanho_pizza, borda_pizza, descricao_pizza)
                    VALUES (:preco, :sabor, :tamanho, :borda, :descricao)";
    $stmt_insert = $pdo->prepare($sql_insert);

    // Executar a consulta com os parâmetros
    $stmt_insert->execute(array(
        ':preco' => $preco,
        ':sabor' => $sabor,
        ':tamanho' => $tamanho,
        ':borda' => $borda,
        ':descricao' => $descricao
    ));

    header("Location: cardapioPizza.php");
    exit();

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

try {
    // Conexão com o banco de dados
    $pdo = connectToDatabase($host, $dbname, $username, $password);

    // Consulta SQL para selecionar todas as pizzas
    $sql_select_pizzas = "SELECT * FROM pizzas";
    $stmt_select_pizzas = $pdo->query($sql_select_pizzas);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}



?>
