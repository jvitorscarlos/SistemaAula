<?php

require_once "../src/Model/Database.php";

$database = new Database();
$conn = $database->conectar();
if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $sql = "DELETE FROM pessoas WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        header("Location: pessoa-listar.php");
        exit;

    } else {

        echo "Erro ao excluir: " . $stmt->error;

    }

    $stmt->close();
}

$conn->close();