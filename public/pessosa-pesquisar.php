<?php

require_once "../src/DAO/PessoaDAO.php";

$pessoaDAO = new PessoaDAO();

$pesquisa = $_GET["pesquisa"] ?? "";

$resultado = null;

if (!empty($pesquisa)) {
    $resultado = $pessoaDAO->pesquisar($pesquisa);
}

ob_start();

?>

<div class="d-flex justify-content-between align-items-center mb-3">


<h2>Pesquisar Pessoas</h2>

<a href="pessoa-create.php" class="btn btn-success">
    Nova Pessoa
</a>


</div>

<form method="GET" class="mb-4">


<div class="input-group">

    <input
        type="text"
        name="pesquisa"
        class="form-control"
        placeholder="Digite o nome da pessoa"
        value="<?= htmlspecialchars($pesquisa) ?>"
    >

    <button
        type="submit"
        class="btn btn-primary"
    >
        Pesquisar
    </button>

</div>


</form>

<?php if (!empty($pesquisa)) { ?>


<?php if ($resultado && $resultado->num_rows > 0) { ?>

    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                </tr>

            </thead>

            <tbody>

                <?php while ($pessoa = $resultado->fetch_assoc()) { ?>

                    <tr>

                        <td><?= $pessoa["id"] ?></td>
                        <td><?= $pessoa["nome"] ?></td>
                        <td><?= $pessoa["telefone"] ?></td>
                        <td><?= $pessoa["cpf"] ?></td>
                        <td><?= $pessoa["endereco"] ?></td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

<?php } else { ?>

    <div class="alert alert-warning">
        Nenhuma pessoa encontrada.
    </div>

<?php } ?>


<?php } else { ?>


<div class="alert alert-info">
    Digite o nome de uma pessoa para realizar a pesquisa.
</div>


<?php } ?>

<?php

$content = ob_get_clean();

include "layout.php";

?>
