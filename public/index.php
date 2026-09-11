<?php

ob_start();

?>

<div class="text-center py-5">

    <h1 class="display-5 fw-bold">
        Bem-vindo ao Sistema de Controle!
    </h1>

    <p class="lead text-muted mt-3">
        Gerencie pessoas e movimentações de forma simples e organizada.
    </p>

</div>

<?php

$content = ob_get_clean();

require "layout.php";

?>

