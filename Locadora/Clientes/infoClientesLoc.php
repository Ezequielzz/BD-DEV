<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Home/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/Veiculos/infoVeiculos.css">
    <title>Listagem de Veículos - Sync</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="../img/Logo2.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                <h2>Listagem de Usuários</h2>
            </div>
            <div class="card-body">
                <form method="GET" class="row mb-4">
                    <div class="col-md-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" name="estado" class="form-control" placeholder="Digite o estado">
                    </div>
                    <div class="col-md-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </form>
                <form method="GET" class="mb-4">
                    <input type="hidden" name="estado" value="<?php echo htmlspecialchars($_GET['estado'] ?? ''); ?>">
                    <input type="hidden" name="nome" value="<?php echo htmlspecialchars($_GET['nome'] ?? ''); ?>">
                    <button type="submit" name="order" value="desc" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-down-9-1 fa-xl"></i>
                    </button>
                    <button type="submit" name="order" value="asc" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-down-1-9 fa-xl"></i>
                    </button>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Qtd. Locações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Código PHP para buscar dados dos veículos com filtros e ordenação
                        $conn = pg_connect("host=localhost dbname=locadoraEzequielzz user=postgres password=postgres");
                        if (!$conn) {
                            die("Conexão falhou: " . pg_last_error());
                        }

                        $conditions = [];
                        if (!empty($_GET['estado'])) {
                            $conditions[] = "C.estado = '" . pg_escape_string($conn, $_GET['estado']) . "'";
                        }
                        if (!empty($_GET['nome'])) {
                            $conditions[] = "C.nome ILIKE '%" . pg_escape_string($conn, $_GET['nome']) . "%'";
                        }

                        $order = "desc";
                        if (isset($_GET['order']) && ($_GET['order'] === 'asc' || $_GET['order'] === 'desc')) {
                            $order = $_GET['order'];
                        }

                        $query = "SELECT C.*, COUNT(L.id_locacao) AS quantidade_locacoes 
                                  FROM Clientes C
                                  LEFT JOIN Locacao L ON C.id_cliente = L.id_cliente";
                        if (count($conditions) > 0) {
                            $query .= " WHERE " . implode(' AND ', $conditions);
                        }
                        $query .= " GROUP BY C.id_cliente";
                        $query .= " ORDER BY quantidade_locacoes $order";

                        $result = pg_query($conn, $query);
                        if (!$result) {
                            die("Erro na consulta: " . pg_last_error());
                        }

                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id_cliente']}</td>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['sobrenome']}</td>
                                    <td>{$row['endereco']}</td>
                                    <td>{$row['cidade']}</td>
                                    <td>{$row['estado']}</td>
                                    <td>{$row['telefone']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['quantidade_locacoes']}</td>
                                  </tr>";
                        }

                        pg_free_result($result);
                        pg_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>