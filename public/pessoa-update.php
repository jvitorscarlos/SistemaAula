
<?php

require_once "../src/DAO/PessoaDAO.php";
require_once "../src/Model/Pessoa.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];

    $pessoa = new Pessoa();

    $pessoa->setId($id);
    $pessoa->setNome($nome);
    $pessoa->setTelefone($telefone);
    $pessoa->setCpf($cpf);
    $pessoa->setEndereco($endereco);

    $pessoaDAO = new PessoaDAO();

    if ($pessoaDAO->atualizar($pessoa)) {

        header("Location: listar.php");
        exit;

    } else {

        echo "Erro ao atualizar a pessoa.";

    }
}
?>
