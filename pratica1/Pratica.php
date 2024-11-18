<?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "pratica_1_kauan";

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn -> connect_error){
        die("Falha na conexão: " . $conn -> connect_error);
    }

?>

<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
</head>
<body>
    <h1>Cadastro de Clientes</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome_clientes" name="nome" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email_clientes" name="email" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone_clientes" name="telefone"><br><br>

        <button type="submit">Cadastrar Cliente</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_clientes = $_POST['nome_clientes'];
        $email_clientes = $_POST['email_clientes'];
        $telefone_clientes = $_POST['teletelefone_clientesfone'];

        $sql = "INSERT INTO clientes (nome_clientes, email_clientes, telefone_clientes) VALUES ('$nome_clientes', '$email_clientes', '$telefone_clientes')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Cliente cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro: " . $conn->error . "</p>";
        }
    }
    ?>
</body>
</html>