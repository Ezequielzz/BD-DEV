<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pizzaria</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="img/pizzaCadastro.jpeg" alt="Pizza">
        </div>
        <div class="form-container">
            <h2>Cadastro de Pizzaria</h2>
            <form action="conectaBD.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome_cliente" required>

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco_cliente" required>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone_cliente" placeholder="00-00000-0000" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email_cliente" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha_cliente" required>

                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </div>
</body>
</html>
