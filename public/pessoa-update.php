<?php

require_once "../src/Config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];

    $sql = "UPDATE pessoas
            SET nome = ?,
                telefone = ?,
                cpf = ?,
                endereco = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssi",
        $nome,
        $telefone,
        $cpf,
        $endereco,
        $id
    );

    if ($stmt->execute()) {

        header("Location: listar.php");
        exit;

    } else {

        echo "Erro: " . $stmt->error;

    }

    $stmt->close();
    $conn->close();
}