
<?php

require_once __DIR__ . "/../Config/conexao.php";
require_once __DIR__ . "/../Model/Pessoa.php";

class PessoaDAO
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    // CADASTRAR
    public function cadastrar(Pessoa $pessoa)
    {
        $sql = "INSERT INTO pessoas (nome, telefone, cpf, endereco)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $nome = $pessoa->getNome();
        $telefone = $pessoa->getTelefone();
        $cpf = $pessoa->getCpf();
        $endereco = $pessoa->getEndereco();

        $stmt->bind_param(
            "ssss",
            $nome,
            $telefone,
            $cpf,
            $endereco
        );

        return $stmt->execute();
    }

    // LISTAR TODAS
    public function listarTodos()
    {
        $sql = "SELECT * FROM pessoas ORDER BY id ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->get_result();
    }

    // PESQUISAR
    public function pesquisar($pesquisa)
    {
        $sql = "SELECT * FROM pessoas
                WHERE nome LIKE ?
                ORDER BY id ASC";

        $stmt = $this->conn->prepare($sql);

        $nomePesquisa = "%" . $pesquisa . "%";

        $stmt->bind_param("s", $nomePesquisa);
        $stmt->execute();

        return $stmt->get_result();
    }

    // BUSCAR POR ID
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM pessoas WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    // ATUALIZAR
    public function atualizar(Pessoa $pessoa)
    {
        $sql = "UPDATE pessoas
                SET nome = ?, telefone = ?, cpf = ?, endereco = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $nome = $pessoa->getNome();
        $telefone = $pessoa->getTelefone();
        $cpf = $pessoa->getCpf();
        $endereco = $pessoa->getEndereco();
        $id = $pessoa->getId();

        $stmt->bind_param(
            "ssssi",
            $nome,
            $telefone,
            $cpf,
            $endereco,
            $id
        );

        return $stmt->execute();
    }

    // EXCLUIR POR ID
    public function excluir($id)
    {
        $sql = "DELETE FROM pessoas WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    // EXCLUIR TODAS
    public function excluirTodos()
    {
        $sql = "DELETE FROM pessoas";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute();
    }
}
