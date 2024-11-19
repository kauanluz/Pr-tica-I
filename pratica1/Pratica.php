<?php include 'db_connection.php';?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
</head>
<body>
    <h1>Cadastro de Clientes</h1>
    <form method="POST" action="">
        Nome: <input type="text" name="nome_clientes" required><br><br>
        E-mail: <input type="email" name="email_clientes" required><br><br>
        Telefone: <input type="text" name="telefone_clientes"><br><br>
        <button type="submit">Cadastrar Cliente</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome_clientes'];
        $email = $_POST['email_clientes'];
        $telefone = $_POST['telefone_clientes'];

        $sql = "INSERT INTO clientes (nome_clientes, email_clientes, telefone_clientes)
                VALUES ('$nome', '$email', '$telefone')";

        if ($conn->query($sql) === TRUE) {
            echo "Cliente cadastrado com sucesso!";
        } else {
            echo "Erro: " . $conn->error;
        }
    }
    ?>
</body>
</html>

<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Chamados</title>
</head>
<body>
    <h1>Gerenciamento de Chamados</h1>

    <form method="POST">
        ID do Cliente: <input type="number" name="id_cliente" required><br><br>
        Descrição do Problema: <textarea name="descricao_problema" required></textarea><br><br>
        Criticidade: 
        <select name="criticidadeProblema">
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select><br><br>
        <button type="submit" name="create">Criar Chamado</button>
    </form>

    <?php
    if (isset($_POST['create'])) {
        $id_cliente = $_POST['id_cliente'];
        $descricao = $_POST['descricao_problema'];
        $criticidade = $_POST['criticidadeProblema'];

        $sql = "INSERT INTO chamados (id_cliente, descricao_problema, criticidadeProblema)
                VALUES ($id_cliente, '$descricao', '$criticidade')";

        if ($conn->query($sql) === TRUE) {
            echo "Chamado criado com sucesso!";
        } else {
            echo "Erro: " . $conn->error;
        }
    }

    if (isset($_POST['update'])) {
        $id_chamado = $_POST['id_chamado'];
        $status = $_POST['statusProblema'];
        $colaborador = $_POST['id_colaborador_responsavel'];

        $sql = "UPDATE chamados 
                SET statusProblema='$status', id_colaborador_responsavel=$colaborador 
                WHERE id_chamado=$id_chamado";

        if ($conn->query($sql) === TRUE) {
            echo "Chamado atualizado com sucesso!";
        } else {
            echo "Erro: " . $conn->error;
        }
    }
    ?>

    <h2>Lista de Chamados</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Criticidade</th>
            <th>Status</th>
            <th>Data Abertura</th>
            <th>Colaborador</th>
            <th>Ações</th>
        </tr>

        <?php
        $result = $conn->query("
            SELECT c.id_chamado, cl.nome_clientes, c.descricao_problema, c.criticidadeProblema, c.statusProblema, c.data_abertura, co.nome_colaborador 
            FROM chamados c
            LEFT JOIN clientes cl ON c.id_cliente = cl.id_cliente
            LEFT JOIN colaborador co ON c.id_colaborador_responsavel = co.id_colaborador
        ");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id_chamado']}</td>
                <td>{$row['nome_clientes']}</td>
                <td>{$row['descricao_problema']}</td>
                <td>{$row['criticidadeProblema']}</td>
                <td>{$row['statusProblema']}</td>
                <td>{$row['data_abertura']}</td>
                <td>{$row['nome_colaborador']}</td>
                <td>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='id_chamado' value='{$row['id_chamado']}'>
                        <select name='statusProblema'>
                            <option value='aberto'>Aberto</option>
                            <option value='em andamento'>Em Andamento</option>
                            <option value='resolvido'>Resolvido</option>
                        </select>
                        <select name='id_colaborador_responsavel'>
                            <option value='NULL'>Nenhum</option>";

            $colaboradores = $conn->query("SELECT * FROM colaborador");
            while ($col = $colaboradores->fetch_assoc()) {
                echo "<option value='{$col['id_colaborador']}'>{$col['nome_colaborador']}</option>";
            }

            echo "</select>
                        <button type='submit' name='update'>Atualizar</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>