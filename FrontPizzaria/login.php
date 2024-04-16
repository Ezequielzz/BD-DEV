<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pizzaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cadastro.css">
</head>

<body>
    
    <div class="container center">
        <div class="row">
            <div class="col-md-6">
                <h2>Login - Cliente</h2>
                <form class="row g-3" action="verificaLogin.php" method="POST">
                    <div class="col-md-12">
                        <label for="inputEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="inputEmail" name="email_cliente" required>
                    </div>
                    <div class="col-md-12">
                        <label for="inputPassword" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="inputPassword" name="senha_cliente" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>