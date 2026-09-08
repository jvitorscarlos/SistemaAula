
<?php

require_once "../src/DAO/PessoaDAO.php";

$pessoaDAO = new PessoaDAO();

$pesquisa = $_GET["pesquisa"] ?? "";

if (!empty($pesquisa)) {

    $resultado = $pessoaDAO->pesquisar($pesquisa);

} else {

    $resultado = $pessoaDAO->listarTodos();

}

$content = '



<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Pessoas</h2>

        <a href="pessoa-create.php" class="btn btn-success">
            Nova Pessoa
        </a>
    </div>

    <form method="GET" class="mb-3">
        <div class="row">

            <div class="col-md-10">
                <input
                    type="text"
                    name="pesquisa"
                    class="form-control"
                    placeholder="Pesquisar por nome"
                    value="' . htmlspecialchars($pesquisa) . '">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    Pesquisar
                </button>
            </div>

        </div>
    </form>

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Endereço</th>
                <th width="120">Ações</th>
            </tr>
        </thead>

        <tbody>
';

while ($pessoa = $resultado->fetch_assoc()) {

    $content .= "

        <tr>

            <td>{$pessoa['id']}</td>
            <td>{$pessoa['nome']}</td>
            <td>{$pessoa['telefone']}</td>
            <td>{$pessoa['cpf']}</td>
            <td>{$pessoa['endereco']}</td>

            <td>

                <a href='pessoa-edit.php?id={$pessoa['id']}'
                   class='btn btn-warning btn-sm'>
                    Editar
                </a>
                
                <a href='pessoa-delete.php?id={$pessoa['id']}'
                   class='btn btn-danger btn-sm'
                   onclick=\"return confirm('Deseja realmente excluir esta pessoa?')\">
                    Excluir
                </a>

            </td>

        </tr>

    ";
}
$content .= '

        </tbody>

    </table>

</div>

';

include "layout.php";