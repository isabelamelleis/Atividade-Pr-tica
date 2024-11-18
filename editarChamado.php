<?php
    include 'db_connect.php';

    $id_editar = $_GET['editar'];

    $sql_colaboradores = "SELECT id_colaborador, email_colaborador FROM colaborador";
    $result_colaboradores = $conn -> query($sql_colaboradores);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar chamado</title>
</head>
<body>
    <h1>
        Editar chamado
    </h1>
    <form action="editarChamado.php?editar=<?php echo $id_editar; ?>" method="POST">
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
        <label for="status_chamado">Status do chamado:</label>
        <br>
        <select name="status_chamado" required>
            <option value="Aberto" name="chamado_aberto" selected>Aberto</option>
            <option value="Em andamento" name="chamado_em_andamento">Em andamento</option>
            <option value="Resolvido" name="chamado_resolvido">Resolvido</option>
        </select>
        <br>
        <br>
        <button type="submit" name="editar_chamado">
            Editar chamado
        </button>
    </form>
    <br>
    <a href="index.php">
        <button>
            Voltar para lista de chamados
        </button>
    </a>
    <br>
</body>
</html>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $colaborador_chamado = $_POST['colaborador_designado'];
        $status_chamado = $_POST['status_chamado'];

        $sql_editar_chamado = "UPDATE chamados SET status_chamado = '$status_chamado', fk_colaborador = '$colaborador_chamado' WHERE id_chamado = '$id_editar'";

        if ($conn -> query($sql_editar_chamado) === TRUE) {
            echo "<br>";
            echo "Edição de chamado realizada com sucesso.";
        } else {
            echo "<br>";
            echo "Erro ao tentar editar o chamado: " . mysqli_error($conn);
        }
    }

    $conn -> close();

?>