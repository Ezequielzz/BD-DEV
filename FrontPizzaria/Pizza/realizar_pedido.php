<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados de conexão com o banco de dados PostgreSQL
    $host = 'localhost';
    $dbname = 'TiquinhoPizzaria';
    $username = 'postgres';
    $password = 'postgres';

    try {
        // Conexão com o banco de dados
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        
        // Preparar e executar a consulta para inserir o pedido na tabela "gera_pedido"
        $sql_insert_pedido = "INSERT INTO gera_pedido (id_funcionario, id_cliente) VALUES (:id_funcionario, :id_cliente)";
        $stmt_insert_pedido = $pdo->prepare($sql_insert_pedido);
        
        // Parâmetros para a consulta
        $id_funcionario = 1; // Substitua pelo ID do funcionário logado
        $id_cliente = $_POST['id_cliente']; // Obtém o ID do cliente do formulário

        // Executar a consulta para inserir o pedido
        $stmt_insert_pedido->bindParam(':id_funcionario', $id_funcionario);
        $stmt_insert_pedido->bindParam(':id_cliente', $id_cliente);
        $stmt_insert_pedido->execute();

        // Obtém o ID do pedido gerado
        $id_pedido = $pdo->lastInsertId();

        // Preparar e executar a consulta para inserir os itens do pedido na tabela "itens_pedido"
        $sql_insert_item_pedido = "INSERT INTO itens_pedido (id_pedido, quantidade, preco_unitario, subtotal_pedido, id_pizza) VALUES (:id_pedido, :quantidade, :preco_unitario, :subtotal_pedido, :id_pizza)";
        $stmt_insert_item_pedido = $pdo->prepare($sql_insert_item_pedido);
        
        // Parâmetros para a consulta (dados fictícios para exemplo)
        $quantidade = 1;
        $preco_unitario = 20.00;
        $subtotal_pedido = 20.00;
        $id_pizza = $_POST['id_pizza']; // Obtém o ID da pizza do formulário

        // Executar a consulta para inserir o item do pedido
        $stmt_insert_item_pedido->bindParam(':id_pedido', $id_pedido);
        $stmt_insert_item_pedido->bindParam(':quantidade', $quantidade);
        $stmt_insert_item_pedido->bindParam(':preco_unitario', $preco_unitario);
        $stmt_insert_item_pedido->bindParam(':subtotal_pedido', $subtotal_pedido);
        $stmt_insert_item_pedido->bindParam(':id_pizza', $id_pizza);
        $stmt_insert_item_pedido->execute();

        // Redireciona para a página de sucesso
        header("Location: pedido_realizado.php");
        exit();
    } catch (PDOException $e) {
        // Em caso de erro, exibe uma mensagem de erro
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>
