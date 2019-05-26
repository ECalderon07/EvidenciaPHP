<div class="row ">
    <div class="col-md-6 offset-md-3 ">    
        <div class="card align-middle">
            <div class="card-header bg-primary text-white">INGRESE DATOS</div>
            <form id="formRegistrarUsuario">
                <div class="card-body">


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Cedula</label>
                            <input type="text" class="form-control" id="inpCedula" name="inpCedula"  value="" placeholder="Digite cédula">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Nombre</label>
                            <input type="text" class="form-control" id="inputPassword4" name="inpNombre" placeholder="Digite nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Correo</label>
                        <input type="text" class="form-control" id="inputAddress"  name="inpCorreo" placeholder="Digite correo">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Telefono</label>
                        <input type="text" class="form-control" name="inpTelefono" placeholder="Digite teléfono">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Rol</label>
                        <select id="sltRol" name="sltRol" class="form-control">
                            <option>Escoja opción</option>
                            <option>admin</option>
                            <option>supervisor</option>
                            <option>user</option>        
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
                    <button type="submit" class="btn btn-primary float-right" id="btnRegistrar">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>    



<script>

    $.validator.addMethod('contraseña', function (value) {
        return /[0-9a-zA-Z]$/.test(value);
    }, 'Ingrese una contraseña alfanumérica');

    $("#formRegistrarUsuario").submit(function () {
        return false
    })


    $("#btnRegistrar").click(function () {
        let formulario = $("form").serialize()
        console.log(formulario)
        $("#formRegistrarUsuario").submit()
        $("#formRegistrarUsuario").validate({

            rules: {
                inpCedula: {
                    required: true,
                    number: true,
                    rangelength: [6, 10]
                },
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
                inpCedula: {
                    required: "El campo cédula es obligatorio",
                    number: "Cédula debe ser númerico",
                    rangelength: "Debe estar entre 6 a 10 dígitos"
                },
                inpNombre: {
                    required: "El campo nombre es obligatorio"
                }
            },
            submitHandler: function () {
                console.log("ingresar submit")
                $.ajax({
                    url: '<?= USUARIO_REGISTRAR['url'] ?>',
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
                            $("#modal .modal-title").html("Usuario registrado!")
                            $("#modal .modal-body").html("Usuario registrado con éxito")
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

     
    })
</script>