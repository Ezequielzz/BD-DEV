<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="img/logoPizzaria.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="Pizza/cardapioPizza.php">Pizzas</a>
                    <a class="nav-link" href="clientes.php">Clientes</a>
                    <a class="nav-link" href="pedidos.php">Pedidos</a>
                    <a class="nav-link" href="funcionario.php">Funcionários</a>
                    <a class="nav-link" href="cadastro.php">Cadastro</a>
                    <a class="nav-link " href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2 class="mt-5 mb-3">Lista de Clientes Que Realizaram Pedidos</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID do Cliente</th>
                        <th>Nome do Cliente</th>
                        <th>E-mail do Cliente</th>
                        <th>Telefone do Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Dados de conexão com o banco de dados PostgreSQL
                    $host = 'localhost';
                    $dbname = 'TiquinhoPizzaria';
                    $username = 'postgres';
                    $password = 'postgres';

                    try {
                        // Conexão com o banco de dados
                        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

                        // Consulta SQL para listar todos os clientes que já fizeram pedidos
                        $sql = "SELECT DISTINCT cliente.id_cliente, cliente.nome_cliente, cliente.email_cliente, cliente.telefone_cliente
                                FROM cliente
                                INNER JOIN pedido ON cliente.id_cliente = pedido.id_cliente";

                        // Preparar e executar a consulta
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        // Exibir os resultados na tabela
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $row['id_cliente'] . '</td>';
                            echo '<td>' . $row['nome_cliente'] . '</td>';
                            echo '<td>' . $row['email_cliente'] . '</td>';
                            echo '<td>' . $row['telefone_cliente'] . '</td>';
                            echo '</tr>';
                        }
                    } catch (PDOException $e) {
                        echo '<tr><td colspan="4">Erro ao conectar ao banco de dados: ' . $e->getMessage() . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
