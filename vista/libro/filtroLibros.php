<?PHP
foreach ($datos as $fila) {
    ?>

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
            Generos Literarios
        </a>
        <a href="#" class="list-group-item list-group-item-action">Ficcion <span class="badge badge-success badge-pill"><?= $fila->Ficcion ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Terror <span class="badge badge-success badge-pill"><?= $fila->Terror ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Drama <span class="badge badge-success badge-pill"><?= $fila->Drama ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Infantil <span class="badge badge-success badge-pill"><?= $fila->Infantil ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Comedia <span class="badge badge-success badge-pill"><?= $fila->Comedia ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Aventura <span class="badge badge-success badge-pill"><?= $fila->Aventura ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Suspenso <span class="badge badge-success badge-pill"><?= $fila->Suspenso ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Historia <span class="badge badge-success badge-pill"><?= $fila->Historia ?></span></a>
        <a href="#" class="list-group-item list-group-item-action">Biografia <span class="badge badge-success badge-pill"><?= $fila->Biografia ?></span></a>

    </div>
    <?PHP
}
?>