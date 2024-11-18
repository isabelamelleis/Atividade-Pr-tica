<?php

    include "db_connect.php";

    $sql_chamados = "SELECT id_chamado, email_cliente, email_colaborador, desc_chamado, status_chamado, criticidade_chamado, data_abertura_chamado FROM chamados INNER JOIN cliente ON id_cliente = fk_cliente INNER JOIN colaborador ON id_colaborador = fk_colaborador";
    $result_chamados = $conn -> query($sql_chamados);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chamados</title>
</head>
<body>
    <h3>
        Faça o cadastro de usuários <a href="cadastro.php">aqui.</a>
    </h3>
    <h1>
        Chamados
    </h1>
    <a href="abrirChamado.php">
        <button>
            Abrir chamado
        </button>
    </a>
    <br>
    <br>

    <?php
        if($result_chamados -> num_rows > 0) {
            echo "<table border='1'>
                <tr>
                    <th> Nº do chamado </th>
                    <th> Email do cliente </th>
                    <th> Email do colaborador </th>
                    <th> Descrição do problema </th>
                    <th> Status </th>
                    <th> Criticidade </th>
                    <th> Data de abertura </th>
                </tr>
            ";
            while ($row = $result_chamados -> fetch_assoc()) {
                echo "
                <tr>
                    <td> {$row['id_chamado']} </td>
                    <td> {$row['email_cliente']} </td>
                    <td> {$row['email_colaborador']} </td>
                    <td> {$row['desc_chamado']} </td>
                    <td> {$row['status_chamado']} </td>
                    <td> {$row['criticidade_chamado']} </td>
                    <td> {$row['data_abertura_chamado']} </td>
                    <td>
                        <a href='editarChamado.php?editar={$row['id_chamado']}'>&#128393;</a>
                    </td>
                </tr>
            ";
            } 
            echo "</table>";
        } else {
            echo "Nenhum chamado registrado.";
        }
    ?>

</body>
</html>