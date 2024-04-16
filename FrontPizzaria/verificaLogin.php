<?php
session_start();

// Verificar se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados de conexão com o banco de dados PostgreSQL
    $host = 'localhost';
    $dbname = 'TiquinhoPizzaria';
    $username = 'postgres';
    $password = 'postgres';

    // Dados do formulário de login
    $email = $_POST['email_cliente'];
    $senha = md5($_POST['senha_cliente']);

    try {
        // Conexão com o banco de dados
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

        // Consulta SQL para verificar se o email e a senha correspondem a um registro na tabela "cliente"
        $sql_select = "SELECT * FROM cliente WHERE email_cliente = :email AND senha_cliente = :senha";
        $stmt = $pdo->prepare($sql_select);
        $stmt->execute(array(':email' => $email, ':senha' => $senha));
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            // Iniciar a sessão do usuário
            $_SESSION['id_cliente'] = $cliente['id_cliente'];
            $_SESSION['nome_cliente'] = $cliente['nome_cliente'];

            // Redirecionar para a página principal ou qualquer outra página desejada
            echo "FOI!";
            // header('Location: index.php');
            // exit();
        } else {
            $mensagem_erro = "Credenciais inválidas. Por favor, tente novamente.";
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>