<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Tiquinho's Pizzaria</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logoPizzaria.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="#">Pizzas</a>
                    <a class="nav-link" href="#">Features</a>
                    <a class="nav-link" href="cadastro.php">Cadastro</a>
                    <a class="nav-link " href="#">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="carousel-container">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/carrossel1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/carrossel2.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-evenly">
            <?php
            // Dados de conexão com o banco de dados PostgreSQL
            $host = 'localhost';
            $dbname = 'TiquinhoPizzaria';
            $username = 'postgres';
            $password = 'postgres';

            try {
                // Conexão com o banco de dados
                $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

                // Consulta SQL para selecionar todas as pizzas
                $sql_select_pizzas = "SELECT * FROM pizzas";
                $stmt_select_pizzas = $pdo->query($sql_select_pizzas);

                // Exibir as pizzas em cards
                while ($pizza = $stmt_select_pizzas->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="col-md-3">';
                    echo '<div class="card mb-4">';
                    // Aqui você pode exibir as informações da pizza nos cards
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $pizza['sabor_pizza'] . '</h5>';
                    echo '<p class="card-text">Preço: R$ ' . number_format($pizza['preco_pizza'], 2, ',', '.') . '</p>';
                    echo '<p class="card-text">' . $pizza['descricao_pizza'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
