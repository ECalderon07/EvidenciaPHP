



<table class="table" id="tablaUsuario">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Isbn</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Autor</th>
            <th scope="col">Genero</th>
            <th scope="col">Año</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Actualizar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datos as $fila) {
            ?>
            <tr>
                <td scope="col"><?= $fila->isbn ?></td>
                <td scope="col"><?= $fila->nombre ?></td>
                <td scope="col"><?= $fila->descripcion ?></td>
                <td scope="col"><?= $fila->autor ?></td>
                <td scope="col"><?= $fila->genero ?></td>
                <td scope="col"><?= $fila->publicacion ?></td>
                <td scope="col"><button  class="btn btn-secondary btnEditarLibro" data-id="<?= $fila->isbn ?>">EDITAR</button></td>
                <td scope="col"><button  class="btn btn-danger btnEliminarLibro" data-id="<?= $fila->isbn ?>">ELIMINAR</button></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>


<script>
//    $('#tablaUsuario').DataTable({
//        language: {
//            "decimal": "",
//            "emptyTable": "No hay información",
//            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
//            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
//            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
//            "infoPostFix": "",
//            "thousands": ",",
//            "lengthMenu": "Mostrar _MENU_ Entradas",
//            "loadingRecords": "Cargando...",
//            "processing": "Procesando...",
//            "search": "Buscar:",
//            "zeroRecords": "Sin resultados encontrados",
//            "paginate": {
//                "first": "Primero",
//                "last": "Ultimo",
//                "next": "Siguiente",
//                "previous": "Anterior"
//            }
//        }, 
//    });

</script>