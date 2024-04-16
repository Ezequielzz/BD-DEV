<?php
// Verificar se o ID da pizza foi fornecido na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Dados de conexão com o banco de dados PostgreSQL
    $host = 'localhost';
    $dbname = 'TiquinhoPizzaria';
    $username = 'postgres';
    $password = 'postgres';

    try {
        // Conexão com o banco de dados
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

        // Preparar a consulta SQL para excluir a pizza com o ID fornecido
        $sql_delete_pizza = "DELETE FROM pizzas WHERE id_pizza = :id";
        $stmt_delete_pizza = $pdo->prepare($sql_delete_pizza);

        // Executar a consulta com os parâmetros
        $stmt_delete_pizza->execute(array(':id' => $_GET['id']));

        // Redirecionar de volta para a página de lista de pizzas após a exclusão
        header("Location: cardapioPizza.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
} else {
    // Se nenhum ID de pizza foi fornecido na URL, redirecionar de volta para a página de lista de pizzas
    header("Location: cardapioPizza.php");
    exit();
}
?>
