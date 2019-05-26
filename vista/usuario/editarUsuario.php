<div class="row ">
    <div class="col-md-6 offset-md-3 ">    
        <div class="card align-middle">
            <div class="card-header bg-primary text-white">INGRESE DATOS</div>
            <form id="formEditarUsuario">
                <div class="card-body">


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Cedula</label>
                            <input type="text" readonly="readonly" class="form-control" id="inpCedula" value="<?= $datos->cedula ?>" name="inpCedula"  value="" placeholder="Digite cédula">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Nombre</label>
                            <input type="text" class="form-control" id="inputPassword4" value="<?= $datos->nombre ?>" name="inpNombre" placeholder="Digite nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Correo</label>
                        <input type="text" class="form-control" id="inputAddress"  value="<?= $datos->correo ?>" name="inpCorreo" placeholder="Digite correo">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Telefono</label>
                        <input type="text" class="form-control" name="inpTelefono" value="<?= $datos->telefono ?>" placeholder="Digite teléfono">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Rol</label>
                        <select id="sltRol" name="sltRol" class="form-control">
                            <option <?= $datos->rol=='null'?"selected":"" ?> >Escoja opción</option>
                            <option <?= $datos->rol=='admin'?"selected":"" ?>>admin</option>
                            <option <?= $datos->rol=='supervisor'?"selected":"" ?>>supervisor</option>
                            <option <?= $datos->rol=='user'?"selected":"" ?>>user</option>        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Contraseña</label>
                        <input type="password" class="form-control" id="inpContraseña" name="inpContraseña" placeholder="Digite teléfono">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="inpConfirmar" name="inpConfirmar"  placeholder="Digite teléfono">
                    </div>   


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right" id="btnEditar">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>    



<script>

    $.validator.addMethod('contraseña', function (value) {
        return /[0-9a-zA-Z]$/.test(value);
    }, 'Ingrese una contraseña alfanumérica');

    $("#formEditarUsuario").submit(function () {
        return false
    })
 

    $("#btnEditar").click(function () {
        let formulario = $("form").serialize()
        console.log(formulario)
        $("#formEditarUsuario").submit()
        $("#formEditarUsuario").validate({

            rules: {
//                inpCedula: {
//                    required: true,
//                    number: true,
//                    rangelength: [6, 10]
//                },
                inpNombre: {
                    required: true
                },
                inpCorreo: {
                    required: true,
                    email: true,
                },
                inpTelefono: {
                    required: true,
                    number: true,
                    rangelength: [7, 10]
                },
                sltRol: {
                    required: true,
                },
                inpContraseña: {
                    required: true,
                    contraseña: true,
                },
                inpConfirmar: {
                    required: true,
                    contraseña: true,
                    equalTo: "#inpContraseña"
                },
            },
            messages: {
//                inpCedula: {
//                    required: "El campo cédula es obligatorio",
//                    number: "Cédula debe ser númerico",
//                    rangelength: "Debe estar entre 6 a 10 dígitos"
//                },
                inpNombre: {
                    required: "El campo nombre es obligatorio"
                }
            },submitHandler: function () {
                $.ajax({
                    url: '<?= USUARIO_EDITAR['url'] ?>',
                    data: formulario,
                    dataType: 'json',
                    type: 'post',
                    success: function (resultado) {
                        console.log(resultado)
                        if (resultado.mensaje == 3) {
                            $("#modal .modal-title").html("Usuario Existente")
                            $("#modal .modal-body").html("La cédula ya se encuentra registrada")
                            $("#modal").modal()
                        }
                        if (resultado.mensaje == 2) {
                            $("#modal .modal-title").html("Falla en el registro")
                            $("#modal .modal-body").html("Por favor comuníquese con su administrador")
                            $("#modal").modal()
                        }
                        if (resultado.mensaje == 1) {
                            $("#modal .modal-title").html("Usuario Actualizado!")
                            $("#modal .modal-body").html("Usuario actualizado con éxito")
                            $("#modal").modal()
                            $("#principal").html(resultado.dato)
                        }
                    },
                    error: function (error) {
                        alert("falla en conexion")
                    }
                })
            }
        })

//    
    })
</script>