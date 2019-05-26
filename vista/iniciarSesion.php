
<html>
    <head>
        <title>title</title>
        <link href="<?= CSS ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?= CSS ?>datatables.css" rel="stylesheet" type="text/css"/>
        
        <style>
            .error{
                color: red;
            }
        </style>
        <script src="<?= JS ?>jquery-3.3.1.js" type="text/javascript"></script>
        <script src="<?= JS ?>popper.min.js" type="text/javascript"></script>
        <script src="<?= JS ?>bootstrap.js" type="text/javascript"></script>       

        
        <!-- Validación -->
        
        <script src="<?= JS ?>jquery.validate.js" type="text/javascript"></script>   
        <script src="<?= JS ?>additional-methods.js" type="text/javascript"></script>
        
        
        <!-- Datatable -->
        <script src="<?= JS ?>datatables.js" type="text/javascript"></script>
        
    </head>
    <body>



        <div id="principal">     



            <div class="row ">
                <div class="col-md-6 offset-md-3 ">    
                    <div class="card align-middle">
                        <div class="card-header bg-primary text-white">INGRESE DATOS</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label >Cedula</label>
                                    <input type="text" class="form-control" name="inpCedula" id="inpCedula"  placeholder="Dígite su cédula">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contrasena</label>
                                    <input type="password" class="form-control" name="inpContrasena" id="exampleInputPassword1" placeholder="Dígite su contraseña">
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input col-sm-12" name="cbxRecordar" id="cbxRecordar">
                                    <label class="form-check-label col-sm-12" for="">Recordarme</label>
                                </div>                    
                            </form>

                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary float-left" id="btnRecuperar">Recuperar contrasena</a>
                            <button type="submit" class="btn btn-success float-right " id="btnRegistrar">Registrar</button>
                            <button type="submit" class="btn btn-primary float-right " id="btnIngresar">Ingresar</button>
                        </div>
                    </div>
                </div>
            </div>                


        </div>                        


        <!--        Mensaje Modal--><!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Cambiar mensaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>




<script>
    $("#btnIngresar").click(function () {
        let formulario = $("form").serialize();
        $.ajax({
            url: '<?= USUARIO_AUTENTICAR['url'] ?>',
            data: formulario,
            dataType: 'json',
            type: 'post',
            success: function (resultado) {
                console.log(resultado)
                if (resultado.mensaje == '0') {
                    $("#modal .modal-title").html("Error al ingresar")
                    $("#modal .modal-body").html("La cedula o contrase�a no coinciden, intentelo nuevamente.")
                    $("#modal").modal()
                } else if (resultado.mensaje == '1') {
                    $("#principal").html(resultado.dato)
                }
            },
            error: function (error) {
                alert("falla en conexion")
            }
        })
    })
    
    $("#btnRegistrar").click(function () {
    //Llama la vista registrar usuario
        $.ajax({
            url: '<?= USUARIO_VISTA_REGISTRAR['url'] ?>',
            data: '',
            dataType: 'json',
            type: 'post',
            success: function (resultado) {
                console.log(resultado)
                $("#principal").html(resultado.dato)
            },
            error: function (error) {
                alert("falla en conexion")
            }
        })
    })    
</script>





