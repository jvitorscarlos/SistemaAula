
<?php

echo "<h1>MOVIMENTAÇÃO</h1>";

echo '
<form action="movimentacao-depositar.php" method="POST">

    <label>Pessoa:</label>
    <input type="text" name="idPessoa">

    <br><br>

    <label>Valor:</label>
    <input type="number" name="valor" step="0.01">

    <br><br>

    <label>Observação:</label>
    <input type="text" name="observacao">

    <br><br>

    <button type="submit">Depositar</button>

</form>
';

?>

