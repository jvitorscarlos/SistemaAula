
<?php

require_once "../src/Config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $telefone = trim($_POST["telefone"]);
    $cpf = trim($_POST["cpf"]);
    $endereco = trim($_POST["endereco"]);

    $sql = "INSERT INTO pessoas (nome, telefone, cpf, endereco)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("ssss", $nome, $telefone, $cpf, $endereco);

        if ($stmt->execute()) {

            echo "<script>
                    alert('Pessoa cadastrada com sucesso!');
                    window.location.href='index.php';
                  </script>";

        } else {

            echo "Erro ao cadastrar: " . $stmt->error;

        }

        $stmt->close();

    } else {

        echo "Erro na preparação da consulta: " . $conn->error;

    }

    $conn->close();
}
?>

