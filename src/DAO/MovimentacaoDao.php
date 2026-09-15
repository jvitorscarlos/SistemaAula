<?php

require_once __DIR__ . "/../Config/conexao.php";

class MovimentacaoDao
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    // DEPOSITAR
    public function depositar($idPessoa, $valor, $observacao)
    {
        $sql = "INSERT INTO movimentacao
                (idPessoa, Credito, Debito, DataOperacao, Observacao, CreatedAt)
                VALUES (?, ?, 0, NOW(), ?, NOW())";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ids",
            $idPessoa,
            $valor,
            $observacao
        );

        return $stmt->execute();
    }

    // SACAR
    public function sacar($idPessoa, $valor, $observacao)
    {
        $sql = "INSERT INTO movimentacao
                (idPessoa, Credito, Debito, DataOperacao, Observacao, CreatedAt)
                VALUES (?, 0, ?, NOW(), ?, NOW())";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ids",
            $idPessoa,
            $valor,
            $observacao
        );

        return $stmt->execute();
    }

    // TRANSFERIR
    public function transferir($idPessoaOrigem, $idPessoaDestino, $valor, $observacao)
    {
        $this->conn->begin_transaction();

        try {

            // Débito na pessoa de origem
            $sqlDebito = "INSERT INTO movimentacao
                          (idPessoa, Credito, Debito, DataOperacao, Observacao, CreatedAt)
                          VALUES (?, 0, ?, NOW(), ?, NOW())";

            $stmtDebito = $this->conn->prepare($sqlDebito);

            $stmtDebito->bind_param(
                "ids",
                $idPessoaOrigem,
                $valor,
                $observacao
            );

            $stmtDebito->execute();

            // Crédito na pessoa de destino
            $sqlCredito = "INSERT INTO movimentacao
                           (idPessoa, Credito, Debito, DataOperacao, Observacao, CreatedAt)
                           VALUES (?, ?, 0, NOW(), ?, NOW())";

            $stmtCredito = $this->conn->prepare($sqlCredito);

            $stmtCredito->bind_param(
                "ids",
                $idPessoaDestino,
                $valor,
                $observacao
            );

            $stmtCredito->execute();

            $this->conn->commit();

            return true;

        } catch (Exception $e) {

            $this->conn->rollback();

            return false;
        }
    }

    // SALDO
    public function buscarSaldo($idPessoa)
    {
        $sql = "SELECT
                    COALESCE(SUM(Credito), 0) - COALESCE(SUM(Debito), 0) AS saldo
                FROM movimentacao
                WHERE idPessoa = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $idPessoa);

        $stmt->execute();

        $resultado = $stmt->get_result()->fetch_assoc();

        return $resultado["saldo"];
    }

    // HISTÓRICO POR PESSOA
    public function listarPorPessoa($idPessoa)
    {
        $sql = "SELECT *
                FROM movimentacao
                WHERE idPessoa = ?
                ORDER BY DataOperacao DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $idPessoa);

        $stmt->execute();

        return $stmt->get_result();
    }

    // LISTAR TODAS AS MOVIMENTAÇÕES EXISTENTES
    public function listarTodas()
    {
        $sql = "SELECT
                    movimentacao.*,
                    pessoas.nome
                FROM movimentacao
                INNER JOIN pessoas
                    ON movimentacao.idPessoa = pessoas.id
                ORDER BY DataOperacao DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->get_result();
    }
}
