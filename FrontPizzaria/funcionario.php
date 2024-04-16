<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="Pizza/cardapioPizza.css">
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
        <h2 class="mt-5 mb-3">Lista de Funcionários</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Data de Contratação</th>
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

                    // Consulta SQL para selecionar todos os funcionários
                    $sql_select_funcionarios = "SELECT * FROM funcionarios";
                    $stmt_select_funcionarios = $pdo->query($sql_select_funcionarios);

                    // Verificar se há funcionários para exibir
                    if ($stmt_select_funcionarios->rowCount() > 0) {
                        // Exibir os funcionários em uma tabela
                        while ($funcionario = $stmt_select_funcionarios->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $funcionario['id_funcionario'] . '</td>';
                            echo '<td>' . $funcionario['nome_funcionario'] . '</td>';
                            echo '<td>' . $funcionario['cargo_funcionario'] . '</td>';
                            echo '<td>' . $funcionario['email_funcionario'] . '</td>';
                            echo '<td>' . $funcionario['telefone_funcionario'] . '</td>';
                            echo '<td>' . $funcionario['cpf_funcionario'] . '</td>';
                            echo '<td>' . $funcionario['data_contratacao'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        // Se não houver funcionários, exiba uma mensagem
                        echo '<tr><td colspan="7">Nenhum funcionário encontrado.</td></tr>';
                    }
                } catch (PDOException $e) {
                    // Se ocorrer um erro de conexão, exiba uma mensagem de erro
                    echo '<tr><td colspan="7">Erro ao conectar ao banco de dados: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
