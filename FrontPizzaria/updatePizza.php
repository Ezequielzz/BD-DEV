<?php
// Incluir arquivo de funções e conectar ao banco de dados
// Dados de conexão com o banco de dados PostgreSQL
$host = 'localhost';
$dbname = 'TiquinhoPizzaria';
$username = 'postgres';
$password = 'postgres';

// Verificar se o ID da pizza foi passado através da URL
if (!empty($_GET['id'])) {
    $id_pizza = $_GET['id'];
    
    // Consulta SQL para obter os detalhes da pizza pelo ID
    $stmt = $pdo->prepare('SELECT * FROM pizzas WHERE id_pizza = ?');
    $stmt->execute([$id_pizza]);
    $pizza = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pizza) {
        exit('Pizza não encontrada!');
    }
} else {
    exit('ID da pizza não fornecido!');
}

// Verificar se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $sabor = $_POST['sabor_pizza'];
    $preco = $_POST['preco_pizza'];
    $tamanho = $_POST['tamanho_pizza'];
    $borda = $_POST['borda_pizza'];
    $descricao = $_POST['descricao_pizza'];

    // Atualizar os dados no banco de dados
    $stmt = $pdo->prepare('UPDATE pizzas SET sabor_pizza = ?, preco_pizza = ?, tamanho_pizza = ?, borda_pizza = ?, descricao_pizza = ? WHERE id_pizza = ?');
    $stmt->execute([$sabor, $preco, $tamanho, $borda, $descricao, $id_pizza]);

    // Redirecionar de volta para a página de listagem de pizzas
    header('Location: cardapioPizza.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pizza</title>
</head>
<body>
    <h1>Editar Pizza</h1>
    <form method="post">
        <label for="sabor_pizza">Sabor:</label><br>
        <input type="text" id="sabor_pizza" name="sabor_pizza" value="<?= $pizza['sabor_pizza'] ?>"><br>
        
        <label for="preco_pizza">Preço:</label><br>
        <input type="text" id="preco_pizza" name="preco_pizza" value="<?= $pizza['preco_pizza'] ?>"><br>
        
        <label for="tamanho_pizza">Tamanho:</label><br>
        <input type="text" id="tamanho_pizza" name="tamanho_pizza" value="<?= $pizza['tamanho_pizza'] ?>"><br>
        
        <label for="borda_pizza">Borda:</label><br>
        <input type="text" id="borda_pizza" name="borda_pizza" value="<?= $pizza['borda_pizza'] ?>"><br>
        
        <label for="descricao_pizza">Descrição:</label><br>
        <textarea id="descricao_pizza" name="descricao_pizza"><?= $pizza['descricao_pizza'] ?></textarea><br><br>
        
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
