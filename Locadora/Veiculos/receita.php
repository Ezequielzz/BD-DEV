<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="/Home/index.css">
    <title>Receita Total da Locadora</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="../img/Logo2.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/login.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Funcionarios/funcionarios.html">Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Veiculos/veiculos.html">Veículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Clientes/clientes.html">Clientes</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Cadastro/cadastro.html">
                            <i class="fas fa-user fa-2xl"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Calcular Receita Total</h2>
        </div>
        <div class="card-body">
            <form method="GET" class="row mb-4">
                <div class="col-md-5">
                    <label for="data_inicio" class="form-label">Data de Início</label>
                    <input type="date" id="data_inicio" name="data_inicio" class="form-control" required>
                </div>
                <div class="col-md-5">
                    <label for="data_fim" class="form-label">Data de Fim</label>
                    <input type="date" id="data_fim" name="data_fim" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Calcular</button>
                </div>
            </form>
            <?php
            if (isset($_GET['data_inicio']) && isset($_GET['data_fim'])) {
                $data_inicio = $_GET['data_inicio'];
                $data_fim = $_GET['data_fim'];

                $conn = pg_connect("host=localhost dbname=locadoraEzequielzz user=postgres password=postgres");
                if (!$conn) {
                    die("Conexão falhou: " . pg_last_error());
                }

                $query = "SELECT SUM(valor_total) AS receita_total
                          FROM Locacao
                          WHERE data_locacao BETWEEN '$data_inicio' AND '$data_fim'";

                $result = pg_query($conn, $query);
                if (!$result) {
                    die("Erro na consulta: " . pg_last_error());
                }

                $row = pg_fetch_assoc($result);
                $receita_total = $row['receita_total'] ? number_format($row['receita_total'], 2, ',', '.') : '0,00';

                pg_free_result($result);
                pg_close($conn);

                echo "<div class='alert alert-success' role='alert'>
                        Receita total de $data_inicio a $data_fim: R$ $receita_total
                      </div>";
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
