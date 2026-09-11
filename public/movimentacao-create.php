<?php

require_once "../src/DAO/PessoaDao.php";

$pessoaDAO = new PessoaDAO();

$pessoas = $pessoaDAO->listarTodos();

ob_start();

?>

<h1 class="mb-4">Nova Movimentação</h1>

<form action="movimentacao-processar.php" method="POST">

<div class="mb-3">

    <label for="tipo" class="form-label">
        Tipo da movimentação:
    </label>

    <select
        name="tipo"
        id="tipo"
        class="form-select"
        required
        onchange="alterarTipo()"
    >

        <option value="">Selecione o tipo</option>
        <option value="deposito">Depositar</option>
        <option value="saque">Sacar</option>
        <option value="transferencia">Transferir</option>

    </select>

</div>

<div class="mb-3">

    <label for="pesquisaPessoa" class="form-label">
        Pessoa:
    </label>

    <input
        type="text"
        id="pesquisaPessoa"
        class="form-control"
        placeholder="Digite o nome da pessoa..."
        onkeyup="pesquisarPessoa()"
        autocomplete="off"
    >

    <div id="resultadoPessoa" class="mt-2"></div>

    <input
        type="hidden"
        name="idPessoa"
        id="idPessoa"
        required
    >

</div>

<div id="destino" class="mb-3" style="display: none;">

    <label for="pesquisaDestino" class="form-label">
        Pessoa de destino:
    </label>

    <input
        type="text"
        id="pesquisaDestino"
        class="form-control"
        placeholder="Digite o nome da pessoa..."
        onkeyup="pesquisarDestino()"
        autocomplete="off"
    >

    <div id="resultadoDestino" class="mt-2"></div>

    <input
        type="hidden"
        name="idPessoaDestino"
        id="idPessoaDestino"
    >

</div>

<div class="mb-3">

    <label for="valor" class="form-label">
        Valor:
    </label>

    <input
        type="number"
        name="valor"
        id="valor"
        class="form-control"
        step="0.01"
        min="0.01"
        required
    >

</div>

<div class="mb-3">

    <label for="observacao" class="form-label">
        Observação:
    </label>

    <input
        type="text"
        name="observacao"
        id="observacao"
        class="form-control"
        maxlength="255"
        placeholder="Digite uma observação..."
    >

</div>

<button type="submit" class="btn btn-primary">
    Realizar movimentação
</button>


</form>

<script>

var pessoas = [

    <?php

    $primeiro = true;

    while ($pessoa = $pessoas->fetch_assoc()) {

        if (!$primeiro) {
            echo ",";
        }

        echo json_encode([
            "id" => $pessoa["id"],
            "nome" => $pessoa["nome"]
        ]);

        $primeiro = false;
    }

    ?>

];

function pesquisarPessoa() {

    var pesquisa = document
        .getElementById("pesquisaPessoa")
        .value
        .toLowerCase();

    var resultado = document.getElementById("resultadoPessoa");

    resultado.innerHTML = "";

    if (pesquisa === "") {
        return;
    }

    pessoas.forEach(function(pessoa) {

        if (pessoa.nome.toLowerCase().includes(pesquisa)) {

            var botao = document.createElement("button");

            botao.type = "button";
            botao.className = "btn btn-outline-primary me-2 mb-2";
            botao.textContent = pessoa.nome;

            botao.onclick = function() {

                document.getElementById("idPessoa").value = pessoa.id;
                document.getElementById("pesquisaPessoa").value = pessoa.nome;

                resultado.innerHTML =
                    '<span class="badge text-bg-success">Pessoa selecionada</span>';
            };

            resultado.appendChild(botao);
        }

    });

}

function pesquisarDestino() {

    var pesquisa = document
        .getElementById("pesquisaDestino")
        .value
        .toLowerCase();

    var resultado = document.getElementById("resultadoDestino");

    resultado.innerHTML = "";

    if (pesquisa === "") {
        return;
    }

    pessoas.forEach(function(pessoa) {

        if (pessoa.nome.toLowerCase().includes(pesquisa)) {

            var botao = document.createElement("button");

            botao.type = "button";
            botao.className = "btn btn-outline-secondary me-2 mb-2";
            botao.textContent = pessoa.nome;

            botao.onclick = function() {

                document.getElementById("idPessoaDestino").value = pessoa.id;
                document.getElementById("pesquisaDestino").value = pessoa.nome;

                resultado.innerHTML =
                    '<span class="badge text-bg-success">Pessoa selecionada</span>';
            };

            resultado.appendChild(botao);
        }

    });

}

function alterarTipo() {

    var tipo = document.getElementById("tipo").value;

    var destino = document.getElementById("destino");

    if (tipo === "transferencia") {

        destino.style.display = "block";

    } else {

        destino.style.display = "none";

        document.getElementById("idPessoaDestino").value = "";
        document.getElementById("pesquisaDestino").value = "";
        document.getElementById("resultadoDestino").innerHTML = "";

    }

}

</script>

<?php

$content = ob_get_clean();

include "layout.php";

?>
