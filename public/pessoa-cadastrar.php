<?php

require_once "../src/DAO/PessoaDAO.php";
require_once "../src/Model/Pessoa.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $telefone = trim($_POST["telefone"]);
    $cpf = trim($_POST["cpf"]);
    $endereco = trim($_POST["endereco"]);

    $pessoa = new Pessoa();

    $pessoa->setNome($nome);
    $pessoa->setTelefone($telefone);
    $pessoa->setCpf($cpf);
    $pessoa->setEndereco($endereco);

    $pessoaDAO = new PessoaDAO();

    if ($pessoaDAO->cadastrar($pessoa)) {

        echo "<script>
                alert('Pessoa cadastrada com sucesso!');
                window.location.href='index.php';
              </script>";

    } else {

        echo "Erro ao cadastrar a pessoa.";

    }
}
?>

