<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pizzas</title>
    <link rel="stylesheet" href="cadastroPizza.css">
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="/img/pizzaCadastro.jpeg" alt="Pizza">
        </div>
        <div class="form-container">
            <h2>Cadastro de Pizzas</h2>
            <form action="pizzaBD.php" method="POST">
                <label for="sabor">Sabor:</label>
                <input type="text" id="sabor" name="sabor_pizza" required>

                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco_pizza" step="0.01" min="0" required>

                <label for="tamanho">Tamanho:</label>
                <select id="tamanho" name="tamanho_pizza" required>
                    <option value="Pequena">Pequena</option>
                    <option value="Média">Média</option>
                    <option value="Grande">Grande</option>
                </select>

                <label for="borda">Borda:</label>
                <select id="borda" name="borda_pizza" required>
                    <option value="Normal">Normal</option>
                    <option value="Recheada">Recheada</option>
                </select>

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao_pizza" required></textarea>

                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </div>
</body>
</html>
