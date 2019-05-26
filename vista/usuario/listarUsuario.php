



<table class="table" id="tablaUsuario">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Cédula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Telefono</th>
            <th scope="col">Rol</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Actualizar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datos as $fila) {
            ?>
            <tr>
                <td scope="col"><?= $fila->cedula ?></td>
                <td scope="col"><?= $fila->nombre ?></td>
                <td scope="col"><?= $fila->correo ?></td>
                <td scope="col"><?= $fila->telefono ?></td>
                <td scope="col"><?= $fila->rol ?></td>
                <td scope="col"><button  class="btn btn-secondary btnEditarUsuario" data-id="<?= $fila->cedula ?>">EDITAR</button></td>
                <td scope="col"><button  class="btn btn-danger btnEliminarUsuario" data-id="<?= $fila->cedula ?>">ELIMINAR</button></td>
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