<?php

require_once "../src/DAO/PessoaDao.php";
require_once "../src/DAO/MovimentacaoDao.php";

$pessoaDAO = new PessoaDAO();
$movimentacaoDAO = new MovimentacaoDao();

$pessoas = $pessoaDAO->listarTodos();

ob_start();

?>

<h1 class="mb-4">Movimentações</h1>

<?php while ($pessoa = $pessoas->fetch_assoc()) { ?>

```
<?php

$saldo = $movimentacaoDAO->buscarSaldo($pessoa["id"]);
$movimentacoes = $movimentacaoDAO->listarPorPessoa($pessoa["id"]);

?>

<div class="card mb-4 shadow-sm">

    <div class="card-body">

        <h2 class="card-title">
            <?= $pessoa["nome"] ?>
        </h2>

        <p class="fs-5">
            <strong>Saldo:</strong>
            R$ <?= number_format($saldo, 2, ",", ".") ?>
        </p>

        <div class="mb-3">

            <button
                class="btn btn-success me-2"
                onclick="window.location.href='movimentacao-create.php?tipo=deposito&idPessoa=<?= $pessoa["id"] ?>'">
                Depositar
            </button>

            <button
                class="btn btn-danger me-2"
                onclick="window.location.href='movimentacao-create.php?tipo=saque&idPessoa=<?= $pessoa["id"] ?>'">
                Sacar
            </button>

            <button
                class="btn btn-primary"
                onclick="window.location.href='movimentacao-create.php?tipo=transferencia&idPessoa=<?= $pessoa["id"] ?>'">
                Transferir
            </button>

        </div>

        <h3 class="mt-4">Histórico</h3>

        <?php if ($movimentacoes->num_rows > 0) { ?>

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Observação</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($movimentacao = $movimentacoes->fetch_assoc()) { ?>

                            <tr>

                                <td>

                                    <?php

                                    if ($movimentacao["Credito"] > 0) {
                                        echo "Crédito";
                                    } else {
                                        echo "Débito";
                                    }

                                    ?>

                                </td>

                                <td>

                                    R$
                                    <?= number_format(
                                        $movimentacao["Credito"] > 0
                                            ? $movimentacao["Credito"]
                                            : $movimentacao["Debito"],
                                        2,
                                        ",",
                                        "."
                                    ) ?>

                                </td>

                                <td>
                                    <?= $movimentacao["DataOperacao"] ?>
                                </td>

                                <td>
                                    <?= $movimentacao["Observacao"] ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        <?php } else { ?>

            <p class="text-muted">
                Nenhuma movimentação encontrada.
            </p>

        <?php } ?>

    </div>

</div>
```

<?php } ?>

<?php

$content = ob_get_clean();

include "layout.php";

?>
