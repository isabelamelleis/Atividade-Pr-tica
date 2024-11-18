<?php
    include 'db_connect.php';

    $sql_clientes = "SELECT id_cliente, email_cliente FROM cliente";
    $result_clientes = $conn -> query($sql_clientes);

    $sql_colaboradores = "SELECT id_colaborador, email_colaborador FROM colaborador";
    $result_colaboradores = $conn -> query($sql_colaboradores);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abrir chamado</title>
</head>
<body>
    <h1>
        Abrir chamado
    </h1>
    <form action="abrirChamado.php" method="POST">
        <label for="cliente_abertura_chamado">Cliente que abriu o chamado:</label>
        <br>
        <select name="cliente_abertura_chamado" required>
            <option selected disabled>Selecione</option>

            <?php
                if($result_clientes  -> num_rows > 0) {
                    while($row = $result_clientes -> fetch_assoc()) {
                        echo "<option value='{$row['id_cliente']}'>{$row['email_cliente']}</option>";
                    }
                } else {
                    echo "<option disabled>Nenhum cliente registrado</option>";
                }
            ?>

        </select>
        <br>
        <br>
        <label for="data_abertura_chamado">
            Data de abertura:
        </label>
        <br>
        <input type="date" name="data_abertura_chamado" required>
        <br>
        <br>
        <label for="descricao_chamado">
            Descrição do problema:
        </label>
        <br>
        <textarea name="descricao_chamado" placeholder="Digite..." rows="10" cols="50" required></textarea>
        <br>
        <br>
        <label for="colaborador_designado">Colaborador designado:</label>
        <br>
        <select name="colaborador_designado" required>
            <option selected disabled>Selecione</option>

            <?php
                if($result_colaboradores -> num_rows > 0) {
                    while($row = $result_colaboradores -> fetch_assoc()) {
                        echo "<option value='{$row['id_colaborador']}'>{$row['email_colaborador']}</option>";
                    }
                } else {
                    echo "<option disabled>Nenhum colaborador registrado</option>";
                }
            ?>

        </select>
        <br>
        <br>
        <label for="criticidade_chamado">Criticidade do chamado:</label>
        <br>
        <select name="criticidade_chamado" required>
            <option selected disabled>Selecione</option>
            <option value="Baixa" name="criticidade_baixa">Baixa</option>
            <option value="Média" name="criticidade_media">Média</option>
            <option value="Alta" name="criticidade_alta">Alta</option>
        </select>
        <br>
        <br>
        <label for="status_chamado">Status do chamado:</label>
        <br>
        <select name="status_chamado" required>
            <option value="Aberto" name="chamado_aberto" selected>Aberto</option>
            <option value="Em andamento" name="chamado_em_andamento">Em andamento</option>
            <option value="Resolvido" name="chamado_resolvido">Resolvido</option>
        </select>
        <br>
        <br>
        <button type="submit" name="abrir_chamado">
            Abrir chamado
        </button>
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

    if(isset($_POST['abrir_chamado'])) {
        $cliente_chamado = $_POST['cliente_abertura_chamado'];
        $data_chamado = $_POST['data_abertura_chamado'];
        $descricao_chamado = $_POST['descricao_chamado'];
        $colaborador_chamado = $_POST['colaborador_designado'];
        $criticidade_chamado = $_POST['criticidade_chamado'];
        $status_chamado = $_POST['status_chamado'];

        $sql_abrir_chamado = "INSERT INTO chamados (desc_chamado, criticidade_chamado, status_chamado, data_abertura_chamado, fk_cliente, fk_colaborador) VALUES ('$descricao_chamado', '$criticidade_chamado', '$status_chamado', '$data_chamado', '$cliente_chamado', '$colaborador_chamado')";

        if ($conn -> query($sql_abrir_chamado) === TRUE) {
            echo "<br>";
            echo "Abertura de chamado realizada com sucesso.";
        } else {
            echo "<br>";
            echo "Erro ao tentar abrir um chamado: " . mysqli_error($conn);
        }
    }
?>