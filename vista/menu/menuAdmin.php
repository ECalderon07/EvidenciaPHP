<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="btnListarUsuario">Listar Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="btnRegistrarUsuario">Registrar Usuario</a>
            </li>
            <div class="float-right">
                <li class="nav-item float-right" id="btnCerrarSesion">
                    <a class="nav-link" href="<?= CERRAR_SESION['url'] ?>">Cerrar Sesión</a>
                </li>          
            </div>
        </ul>
    </div>
</nav>

<div class="contenendorAdministrador">



</div>


<script>
    $("#btnListarUsuario").click(function () {
        $.ajax({
            url: '<?= USUARIO_LISTAR['url'] ?>',
            data: '',
            dataType: 'json',
            type: 'post',
            success: function (resultado) {
                console.log(resultado)
                if (resultado.mensaje == '1') {
                    $(".contenendorAdministrador").html(resultado.dato)

                    activarEditarEliminar();
                }
            },
            error: function (error) {

            }
        })
    })

    function activarEditarEliminar() {
        $(".btnEditarUsuario").click(function () {
            var inpCedula = $(this).attr("data-id")
            //console.log("editar usuario: "+cedula)

            //1ra forma
//            $("#modal .modal-title").html("EDITAR USUARIO")
//            
//            $("#modal .modal-body").html("<form><input type='text'></input></form>")
//            
//            $("#modal").modal()


            $.ajax({
                url: "<?= USUARIO_VISTA_ACTUALIZAR['url'] ?>",
                data: {cedula: inpCedula},
                dataType: 'json',
                type: 'post',
                success: function (resultado) {
                    console.log(resultado)
                    if (resultado.mensaje == "1") {
                        $(".contenendorAdministrador").html(resultado.dato);
                        activarEditarEliminar();
                    }
                },
                error: function () {
                    alert("Falla al actualizar")
                }
            })

        })
        
        $(".btnEliminarUsuario").click(function () {
            var cedula = $(this).attr("data-id")
            console.log("eliminar usuario: " + cedula)
            $.ajax({
                url: "<?= USUARIO_ELIMINAR['url'] ?>",
                data: {cedula: cedula},
                dataType: 'json',
                type: 'post',
                success: function (resultado) {
                    console.log(resultado)
                    if (resultado.mensaje == 1) {
                        $(".contenendorAdministrador").html(resultado.dato);
                        activarEditarEliminar();
                        $("#modal .modal-title").html("Usuario Eliminado")
                        $("#modal .modal-body").html("usuario eliminado exitosamente")
                        $("#modal").modal()
                    }else{
                        $("#modal .modal-title").html("Falla")
                        $("#modal .modal-body").html("Error comuníquese con el administrador")
                        $("#modal").modal()
                    }
                    
                },
                error: function () {
                    alert("Falla al actualizar")
                }
            })
        })
    }
    

</script>


