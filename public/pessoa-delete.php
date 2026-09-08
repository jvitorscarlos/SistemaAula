
<?php

require_once "../src/DAO/PessoaDAO.php";

if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $pessoaDAO = new PessoaDAO();

    if ($pessoaDAO->excluir($id)) {

        header("Location: listar.php");
        exit;

    } else {

        echo "Erro ao excluir a pessoa.";

    }
}
?>

