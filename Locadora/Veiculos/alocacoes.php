<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="alocacoes.css">
    <title>Listagem de Locações - Sync</title>
</head>

<body>
<div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Listagem de Locações</h2>
            </div>
            <div class="card-body">
                <form method="GET" class="row mb-4">
                    <div class="col-md-4">
                        <label for="cliente" class="form-label">Nome do Cliente</label>
                        <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Digite o nome do cliente">
                    </div>
                    <div class="col-md-3">
                        <label for="data_inicio" class="form-label">Data de Início</label>
                        <input type="date" id="data_inicio" name="data_inicio" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="data_fim" class="form-label">Data de Término</label>
                        <input type="date" id="data_fim" name="data_fim" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Locação</th>
                            <th>Data de Locação</th>
                            <th>Data de Devolução</th>
                            <th>Valor Total</th>
                            <th>Carro</th>
                            <th>Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Código PHP para buscar dados da tabela Locacao com JOINs e Filtros
                        $conn = pg_connect("host=localhost dbname=locadorazz user=postgres password=postgres");
                        if (!$conn) {
                            die("Conexão falhou: " . pg_last_error());
                        }

                        $conditions = [];
                        if (!empty($_GET['cliente'])) {
                            $conditions[] = "Clientes.nome ILIKE '%" . pg_escape_string($conn, $_GET['cliente']) . "%'";
                        }
                        if (!empty($_GET['data_inicio'])) {
                            $conditions[] = "Locacao.data_locacao >= '" . pg_escape_string($conn, $_GET['data_inicio']) . "'";
                        }
                        if (!empty($_GET['data_fim'])) {
                            $conditions[] = "Locacao.data_locacao <= '" . pg_escape_string($conn, $_GET['data_fim']) . "'";
                        }

                        $query = "SELECT Locacao.id_locacao, Locacao.data_locacao, Locacao.data_devolucao, Locacao.valor_total, 
                                         Carro.Modelo AS carro, Clientes.nome AS cliente
                                  FROM Locacao
                                  JOIN Carro ON Locacao.id_carro = Carro.id_carro
                                  JOIN Clientes ON Locacao.id_cliente = Clientes.id_cliente";
                        if (count($conditions) > 0) {
                            $query .= " WHERE " . implode(' AND ', $conditions);
                        }

                        $result = pg_query($conn, $query);
                        if (!$result) {
                            die("Erro na consulta: " . pg_last_error());
                        }

                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id_locacao']}</td>
                                    <td>{$row['data_locacao']}</td>
                                    <td>{$row['data_devolucao']}</td>
                                    <td>{$row['valor_total']}</td>
                                    <td>{$row['carro']}</td>
                                    <td>{$row['cliente']}</td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>