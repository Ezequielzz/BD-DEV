<?php
// Dados de conexão com o banco de dados PostgreSQL
$host = 'localhost';
$dbname = 'TiquinhoPizzaria';
$username = 'postgres';
$password = 'postgres';

try {
    // Conexão com o banco de dados
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    die(); // Encerrar o script em caso de erro de conexão
}

// Verificar se o ID da pizza foi passado através da URL
if (!empty($_GET['id_pizza'])) {
    $id_pizza = $_GET['id_pizza'];

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
    <link rel="stylesheet" href="updatePizza.css">
    <title>Editar Pizza</title>
</head>

<body>
    <h1>Editar Pizza</h1>
    <form method="post">
        <label for="sabor_pizza">Sabor:</label><br>
        <input type="text" id="sabor_pizza" name="sabor_pizza" value="<?= $pizza['sabor_pizza'] ?>"><br>

        <label for="preco_pizza">Preço:</label><br>
        <input type="text" id="preco_pizza" name="preco_pizza" value="<?= $pizza['preco_pizza'] ?>"><br>

        <label for="tamanho">Tamanho:</label><br>
        <select id="tamanho" name="tamanho_pizza" required>
            <option value="Pequena" <?= $pizza['tamanho_pizza'] === 'Pequena' ? 'selected' : '' ?>>Pequena</option>
            <option value="Média" <?= $pizza['tamanho_pizza'] === 'Média' ? 'selected' : '' ?>>Média</option>
            <option value="Grande" <?= $pizza['tamanho_pizza'] === 'Grande' ? 'selected' : '' ?>>Grande</option>
        </select><br>

        <label for="borda">Borda:</label><br>
        <select id="borda" name="borda_pizza" required>
            <option value="Normal" <?= $pizza['borda_pizza'] === 'Normal' ? 'selected' : '' ?>>Normal</option>
            <option value="Recheada" <?= $pizza['borda_pizza'] === 'Recheada' ? 'selected' : '' ?>>Recheada</option>
        </select><br>

        <label for="descricao_pizza">Descrição:</label><br>
        <textarea id="descricao_pizza" name="descricao_pizza"><?= $pizza['descricao_pizza'] ?></textarea><br><br>

        <input type="submit" value="Salvar">
    </form>
</body>

</html>