<?php

require_once "../src/DAO/MovimentacaoDao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo = $_POST["tipo"];
    $idPessoa = $_POST["idPessoa"];
    $valor = $_POST["valor"];
    $observacao = $_POST["observacao"];

    $movimentacaoDAO = new MovimentacaoDao();

    if ($tipo == "deposito") {

        $resultado = $movimentacaoDAO->depositar(
            $idPessoa,
            $valor,
            $observacao
        );

        $mensagem = "Depósito realizado com sucesso!";

    } elseif ($tipo == "saque") {

        $resultado = $movimentacaoDAO->sacar(
            $idPessoa,
            $valor,
            $observacao
        );

        $mensagem = "Saque realizado com sucesso!";

    } elseif ($tipo == "transferencia") {

        $idPessoaDestino = $_POST["idPessoaDestino"];

        $resultado = $movimentacaoDAO->transferir(
            $idPessoa,
            $idPessoaDestino,
            $valor,
            $observacao
        );

        $mensagem = "Transferência realizada com sucesso!";

    } else {

        $resultado = false;
        $mensagem = "Tipo de movimentação inválido.";

    }

    echo "<script>
            alert('$mensagem');
            window.location.href='movimentacao-create.php';
          </script>";
}
?>