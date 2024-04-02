<?php
include 'functions.php';

// Conectar ao banco de dados PostgreSQL
$pdo = pdo_connect_pgsql();
// Obter a página via solicitação GET (parâmetro URL: page), se não existir, defina a página como 1 por padrão
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Número de registros para mostrar em cada página
$records_per_page = 5;

// Verificar se o botão de ordenação por pizzas foi acionado
if (isset($_GET['order_by_pizza'])) {
    // Consulta SQL para exibir apenas pedidos com pizzas, ordenados por pizza
    $stmt = $pdo->prepare('SELECT pizza FROM contatos WHERE pizza IS NOT NULL ORDER BY pizza ASC');
    $stmt->execute();
    // Buscar os registros para exibi-los em nosso modelo.
    $pizzas = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Preparar a instrução SQL e obter registros da tabela contacts, LIMIT irá determinar a página
$stmt = $pdo->prepare('SELECT * FROM contatos ORDER BY id_contato OFFSET :offset LIMIT :limit');
$stmt->bindValue(':offset', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Buscar os registros para exibi-los em nosso modelo.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter o número total de contatos, isso é para determinar se deve haver um botão de próxima e anterior
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contatos')->fetchColumn();
?>


<?=template_header('Visualizar Pedidos')?>

<div class="content read">
    <h2>Visualizar Pedidos</h2>
    <a href="create.php" class="create-contact">Realizar Pedido</a>
    <div class="buttons">
        <a href="read.php" class="order-all">Exibir Todos</a>
        <a href="read.php?order_by_pizza=1" class="order-pizza">Exibir por Pizzas</a>
    </div>
    <?php if (isset($_GET['order_by_pizza'])): ?>
    <div class="pizza-table">
        <h3>Pedidos de Pizza</h3>
        <table>
            <thead>
                <tr>
                    <td>Pizza</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pizzas as $pizza): ?>
                <tr>
                    <td><?=$pizza?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="normal-table">
        <h3>Todos os Pedidos</h3>
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Celular</td>
                    <td>Pizza</td>
                    <td>Data do Pedido</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?=$contact['id_contato']?></td>
                    <td><?=$contact['nome']?></td>
                    <td><?=$contact['email']?></td>
                    <td><?=$contact['cel']?></td>
                    <td><?=$contact['pizza']?></td>
                    <td><?=$contact['cadastro']?></td>
                    <td class="actions">
                        <a href="update.php?id=<?=$contact['id_contato']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?id=<?=$contact['id_contato']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page*$records_per_page < $num_contacts): ?>
            <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
