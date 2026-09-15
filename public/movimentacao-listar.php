<?php

require_once "../src/DAO/MovimentacaoDao.php";

$movimentacaoDAO = new MovimentacaoDao();

$movimentacoes = $movimentacaoDAO->listarTodas();

ob_start();

?>

<h1 class="mb-4">Movimentações</h1>

<div class="table-responsive">

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-dark">

            <tr>
                <th>Pessoa</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Observação</th>
            </tr>

        </thead>

        <tbody>

            <?php if ($movimentacoes->num_rows > 0) { ?>

                <?php while ($movimentacao = $movimentacoes->fetch_assoc()) { ?>

                    <tr>

                        <td>
                            <?= $movimentacao["nome"] ?>
                        </td>

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

            <?php } else { ?>

                <tr>

                    <td colspan="5" class="text-center text-muted">
                        Nenhuma movimentação encontrada.
                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

<?php

$content = ob_get_clean();

include "layout.php";

?>
