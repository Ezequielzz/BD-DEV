<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Gasto por Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-5 mb-3">Total Gasto por Cliente</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome do Cliente</th>
                        <th>Total Gasto</th>
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

                        // ID do cliente específico para calcular o total gasto
                        $id_cliente = 1; // Substitua pelo ID do cliente desejado

                        // Consulta SQL para calcular o total gasto pelo cliente específico
                        $sql = "SELECT cliente.nome_cliente, SUM(pedido.total_pedido) AS total_gasto
                                FROM cliente
                                INNER JOIN pedido ON cliente.id_cliente = pedido.id_cliente
                                WHERE cliente.id_cliente = :id_cliente
                                GROUP BY cliente.nome_cliente";

                        // Preparar e executar a consulta
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
                        $stmt->execute();

                        // Exibir os resultados na tabela
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $row['nome_cliente'] . '</td>';
                            echo '<td>' . number_format($row['total_gasto'], 2, ',', '.') . '</td>';
                            echo '</tr>';
                        }
                    } catch (PDOException $e) {
                        echo '<tr><td colspan="2">Erro ao conectar ao banco de dados: ' . $e->getMessage() . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
