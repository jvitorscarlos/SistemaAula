
<?php

require_once "../src/DAO/MovimentacaoDao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPessoa = $_POST["idPessoa"];
    $valor = $_POST["valor"];
    $observacao = $_POST["observacao"];

    $movimentacaoDAO = new MovimentacaoDao();

    if ($movimentacaoDAO->depositar($idPessoa, $valor, $observacao)) {

        echo "<script>
                alert('Depósito realizado com sucesso!');
                window.location.href='depositar.php';
              </script>";

    } else {

        echo "Erro ao realizar o depósito.";

    }
}
?>

