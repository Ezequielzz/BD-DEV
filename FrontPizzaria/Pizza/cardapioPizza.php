<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pizzas</title>
    <link rel="stylesheet" href="cardapioPizza.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php"><img src="/img/logoPizzaria.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="cardapioPizza.php">Pizzas</a>
                    <a class="nav-link" href="/clientes.php">Clientes</a>
                    <a class="nav-link" href="/pedidos.php">Pedidos</a>
                    <a class="nav-link" href="/funcionario.php">Funcionários</a>
                    <a class="nav-link" href="/cadastro.php">Cadastro</a>
                    <a class="nav-link " href="/login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2 class="mt-5 mb-3">Lista de Pizzas</h2>
        <form action="" method="GET" class="mb-3">
            <label for="search">Pesquisar por Sabor:</label>
            <select id="search" name="search" class="form-control">
                <option value="">Selecione um sabor</option>
                <?php
                try {
                    // Dados de conexão com o banco de dados PostgreSQL
                    $host = 'localhost';
                    $dbname = 'TiquinhoPizzaria';
                    $username = 'postgres';
                    $password = 'postgres';

                    // Função para conectar ao banco de dados
                    function connectToDatabase2($host, $dbname, $username, $password)
                    {
                        return new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
                    }

                    // Conexão com o banco de dados
                    $pdo = connectToDatabase2($host, $dbname, $username, $password);

                    // Consulta SQL para selecionar todos os sabores de pizzas distintos
                    $sql_select_sabores = "SELECT DISTINCT sabor_pizza FROM pizzas";
                    $stmt_select_sabores = $pdo->query($sql_select_sabores);

                    // Exibir os sabores como opções no menu suspenso
                    while ($sabor = $stmt_select_sabores->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $sabor['sabor_pizza'] . '">' . $sabor['sabor_pizza'] . '</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option value="">Erro ao conectar ao banco de dados: ' . $e->getMessage() . '</option>';
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Pesquisar</button>
            <button class="cadPizza"> <a href="cadastroPizza.php">Cadastrar Pizza</a> </button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sabor</th>
                    <th>Preço</th>
                    <th>Tamanho</th>
                    <th>Borda</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
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

                    // Conexão com o banco de dados
                    $pdo = connectToDatabase($host, $dbname, $username, $password);

                    // Consulta SQL para selecionar todas as pizzas
                    $sql_select_pizzas = "SELECT * FROM pizzas";

                    // Se houver uma pesquisa por sabor, adiciona a cláusula WHERE à consulta
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = $_GET['search'];
                        $sql_select_pizzas .= " WHERE sabor_pizza = '$search'";
                    }

                    $stmt_select_pizzas = $pdo->query($sql_select_pizzas);

                    // Exibir as pizzas em uma tabela
                    while ($pizza = $stmt_select_pizzas->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $pizza['sabor_pizza'] . '</td>';
                        echo '<td>R$ ' . number_format($pizza['preco_pizza'], 2, ',', '.') . '</td>';
                        echo '<td>' . $pizza['tamanho_pizza'] . '</td>';
                        echo '<td>' . $pizza['borda_pizza'] . '</td>';
                        echo '<td>' . $pizza['descricao_pizza'] . '</td>';
                        echo '<td>';
                        echo '<a href="deletePizza.php?id=' . $pizza['id_pizza'] . '" class="btn btn-danger">Apagar</a>';
                        echo '<a href="updatePizza.php?id_pizza=' . $pizza['id_pizza'] . '" class="btn btn-primary ms-1">Editar</a>';
                        echo '</td>';

                        echo '</tr>';
                    }
                } catch (PDOException $e) {
                    echo '<tr><td colspan="6">Erro ao conectar ao banco de dados: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>