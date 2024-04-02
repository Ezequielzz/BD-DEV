<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="cadastro.css">
    <title>Cadastro de Pizzaria</title>
</head>
<body>
<div class="container center">
        <div class="row">
            <div class="col-md-6">
                <h2>Cadastro - Cliente</h2>
                <form class="row g-3" action="conectaBD.php" method="POST">
                <div class="col-12">
                        <label for="inputNome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="inputNome" name="nome_cliente" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="inputEmail" name="email_cliente" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="inputPassword" name="senha_cliente" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Endereço:</label>
                        <input type="text" class="form-control" id="inputAddress" name="endereco_cliente" placeholder="Cidade, Bairro, Rua e Nº" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress2" class="form-label">Telefone:</label>
                        <input type="text" class="form-control" id="inputAddress2" name="telefone_cliente" placeholder="XX XXXXX-XXXX">
                    </div>
                    <div class="col-12">
                        <button type="submit" value="Cadastrar" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
