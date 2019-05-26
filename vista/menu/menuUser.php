<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#" id="btnListarLibro">Listar Libro <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="btnRegistrarLibro">Registrar libro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"id="btnFiltrarLibro" >Filtrar por Genero</a>
            </li>
            <li class="nav-item float-right" id="btnCerrarSesion">
                <a class="nav-link" href="<?= CERRAR_SESION['url'] ?>">Cerrar Sesion</a>
            </li>      
            <li class="nav-item float-right" id="">
                <a class="nav-link" style="font-size: 20px" ><?= $_SESSION['usuario']->nombre ?></a>
            </li>   
        </ul>
    </div>
</nav>


<div class="contenedorUser" style="margin-top: 20px">



</div>



<script>
    $(document).ready(function () {

        //carga automática de la lista de libros
        $.ajax({
            url: '<?= LIBRO_LISTAR['url'] ?>',
            data: '',
            type: 'post',
            dataType: 'json',
            success: function (resultado) {
                console.log("respuesta: " + resultado.mensaje)
                if (resultado.mensaje == '1') {
                    +
                            console.log("ingresa")
                    $(".contenedorUser").html(resultado.dato)
                    activarEditarEliminar();
                }
            },
            error: function () {
                alert("Error en el listado de los libros")
            }
        })
    })
    //carga  la lista de libros al momento de pulsar en btnListarLibro
    $("#btnListarLibro").click(function () {
        $.ajax({
            url: '<?= LIBRO_LISTAR['url'] ?>',
            data: '',
            type: 'post',
            dataType: 'json',
            success: function (resultado) {
                console.log("respuesta: " + resultado.mensaje)
                if (resultado.mensaje == '1') {
                    $(".contenedorUser").html(resultado.dato)
                    activarEditarEliminar();
                }
            },
            error: function () {
                alert("Error en el listado de los libros")
            }
        })
    })


    $("#btnFiltrarLibro").click(function () {
        $.ajax({
            url: '<?= LIBRO_LISTAR_GENERO['url'] ?>',
            data: '',
            type: 'post',
            dataType: 'json',
            success: function (resultado) {
                console.log("respuesta: " + resultado.mensaje)
                if (resultado.mensaje == '1') {
                    $(".contenedorUser").html(resultado.dato)
                    activarEditarEliminar();
                }
            },
            error: function () {
                alert("Error en el listado de los libros")
            }
        })
    })

    function activarEditarEliminar() {

        $(".btnEditarLibro").click(function () {
            var isbn = $(this).attr("data-id")

            $.ajax({
                url: "<?= LIBRO_VISTA_ACTUALIZAR['url'] ?>",
                data: {isbn: isbn},
                dataType: 'json',
                type: 'post',
                success: function (resultado) {
                    console.log(resultado)
                    if (resultado.mensaje == "1") {
                        $(".contenedorUser").html(resultado.dato);
                        activarEditarEliminar();
                    }
                },
                error: function () {
                    alert("Falla al actualizar")
                }
            })

        })
        $(".btnEliminarLibro").click(function () {
            var isbn = $(this).attr("data-id")
                $("#modal .modal-title").html("Eliminar Libro")
                $("#modal .modal-body").html("Desea eliminar el libro?")
                $("#modal .modal-footer").html("<button type='button' class='text-center btn btn-danger btnEliminarLibros'>Eliminar</button> <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>")
                $("#modal").modal()

                $(".btnEliminarLibros").click(function () {
            console.log("eliminar libro: " + isbn)
            $.ajax({
                url: "<?= LIBRO_ELIMINAR['url'] ?>",
                data: {isbn: isbn},
                dataType: 'json',
                type: 'post',
                success: function (resultado) {
                    console.log(resultado)
                    if (resultado.mensaje == 1) {
                        $(".contenedorUser").html(resultado.dato);
                        activarEditarEliminar();
                        $("#modal .modal-title").html("Libro Eliminado")
                        $("#modal .modal-body").html("Libro eliminado exitosamente")
			$("#modal .modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>")
                        $("#modal").modal()
                    } else {
                        $("#modal .modal-title").html("Falla")
                        $("#modal .modal-body").html("Error comuníquese con el administrador")
			$("#modal .modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>")
                        $("#modal").modal()
                    }

                },
                error: function () {
                    alert("Falla al actualizar")
                }
            })
        })
	   })
    }

    //carga  el formulario de registrar libro
    $("#btnRegistrarLibro").click(function () {
        $.ajax({
            url: '<?= LIBRO_VISTA_REGISTRAR['url'] ?>',
            data: '',
            type: 'post',
            dataType: 'json',
            success: function (resultado) {
                console.log("respuesta: " + resultado.mensaje)
                if (resultado.mensaje == '1') {
                    $(".contenedorUser").html(resultado.dato)
                }
            },
            error: function () {
                alert("Error en el listado de los libros")
            }
        })
    })

</script>
