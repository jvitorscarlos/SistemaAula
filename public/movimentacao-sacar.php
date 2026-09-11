<?php

require_once "../src/DAO/MovimentacaoDao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPessoa = $_POST["idPessoa"];
    $valor = $_POST["valor"];
    $observacao = $_POST["observacao"];

    $movimentacaoDAO = new MovimentacaoDao();

    if ($movimentacaoDAO->sacar($idPessoa, $valor, $observacao)) {

        echo "<script>
                alert('Saque realizado com sucesso!');
                window.location.href='movimentacao-create.php';
              </script>";

    } else {

        echo "Erro ao realizar o saque.";

    }
}
?>