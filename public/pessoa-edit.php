
<?php

require_once "../src/DAO/PessoaDAO.php";

$id = $_GET["id"];

$pessoaDAO = new PessoaDAO();

$pessoa = $pessoaDAO->buscarPorId($id);

$content = '

<div class="container mt-4">

<h2>Editar Pessoa</h2>

<form action="pessoa-update.php" method="POST">

<input type="hidden" name="id" value="'.$pessoa["id"].'">

<div class="mb-3">
<label>Nome</label>
<input type="text" class="form-control" name="nome" value="'.$pessoa["nome"].'" maxlength="100" required>
</div>

<div class="mb-3">
<label>Telefone</label>
<input type="text" class="form-control" name="telefone" value="'.$pessoa["telefone"].'" maxlength="15">
</div>

<div class="mb-3">
<label>CPF</label>
<input type="text" class="form-control" name="cpf" value="'.$pessoa["cpf"].'" maxlength="11" required>
</div>

<div class="mb-3">
<label>Endereço</label>
<input type="text" class="form-control" name="endereco" value="'.$pessoa["endereco"].'" maxlength="255">
</div>

<button class="btn btn-primary">
Salvar Alterações
</button>

<a href="listar.php" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

';

include "layout.php";
?>
