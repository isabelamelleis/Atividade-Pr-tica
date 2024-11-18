<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>
        Cadastro
    </h1>
    <form action="cadastro.php" method="POST">
        <label for="nome_usuario">
            Nome:
        </label>
        <br>
        <input type="text" name="nome_usuario" required>
        <br>
        <br>
        <label for="email_usuario">
            Email:
        </label>
        <br>
        <input type="email" name="email_usuario" required>
        <br>
        <br>
        <label for="telefone_usuario">
            Telefone:
        </label>
        <br>
        <input type="number" name="telefone_usuario" placeholder="Digite apenas os números" required>
        <br>
        <br>
        <label for="colaborador_ou_cliente">Selecione uma opção:</label>
        <br>
        <select name="cliente_ou_colaborador" required>
            <option selected disabled>Selecione</option>
            <option name="cliente" value="cliente">Cliente</option>
            <option name="colaborador" value="colaborador">Colaborador</option>
        </select>
        <br>
        <br>
        <button type="submit" name="cadastrar_usuario">
            Cadastrar
        </button>
        <br>
    </form>
    <br>
    <a href="index.php">
        <button>
            Voltar para lista de chamados
        </button>
    </a>
</body>
</html>

<?php
    include 'db_connect.php';

    if(isset($_POST['cadastrar_usuario'])) {
        
        if ($_POST['cliente_ou_colaborador'] == 'cliente') {
            $nome_cliente = $_POST['nome_usuario'];
            $email_cliente = $_POST['email_usuario'];
            $telefone_cliente = $_POST['telefone_usuario'];

            $sql_cadastro_cliente = "INSERT INTO cliente (nome_cliente, email_cliente, telefone_cliente) VALUES ('$nome_cliente', '$email_cliente', '$telefone_cliente')";

            if ($conn -> query($sql_cadastro_cliente) === TRUE) {
                echo "Cadastro de cliente realizado com sucesso.";
            } else {
                echo "Erro ao cadastrar cliente: " . mysqli_error($conn);
            }

        } else {
            $nome_colaborador = $_POST['nome_usuario'];
            $email_colaborador = $_POST['email_usuario'];
            $telefone_colaborador = $_POST['telefone_usuario'];

            $sql_cadastro_colaborador = "INSERT INTO colaborador (nome_colaborador, email_colaborador, telefone_colaborador) VALUES ('$nome_colaborador', '$email_colaborador', '$telefone_colaborador')";

            if ($conn -> query($sql_cadastro_colaborador) === TRUE) {
                echo "<br>";
                echo "Cadastro de colaborador realizado com sucesso.";
            } else {
                echo "<br>";
                echo "Erro ao cadastrar colaborador: " . mysqli_error($conn);
            }
        }
    }
?>