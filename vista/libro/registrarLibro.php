<div class="row ">
    <div class="col-md-6 offset-md-3 ">    
        <div class="card align-middle">
            <div class="card-header bg-primary text-white">INGRESE DATOS</div>
            <form id="formRegistrarLibro">
                <div class="card-body">


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">ISBN</label>
                            <input type="text" class="form-control" id="inpIsbn" name="inpIsbn"  value="" placeholder="Digite isbn">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="inpNombre" name="inpNombre" placeholder="Digite nombre">
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" placeholder="Digite el descripcion">
                            
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Publicacion</label>
                            <input type="number" min="1900" max="2019" class="form-control" name="inpPublicacion" id="inpPublicacion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Género</label>
                        <select id="sltGenero" name="sltGenero" class="form-control">
                            <option>Seleccione...</option>
                            <option>ficcion</option>
                            <option>terror</option>
                            <option>drama</option>        
                            <option>infantil</option>
                            <option>comedia</option>
                            <option>aventura</option> 
                            <option>suspenso</option>
                            <option>historia</option>
                            <option>biografia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Autor</label>
                        <input type="text" class="form-control" id="inpAutor"  name="inpAutor" placeholder="Digite autor">
                    </div>
                    <div class="form-group">
                        <label for="">Cedula</label>
                        <input type="text" class="form-control" id="inpCedula"  name="inpCedula" value="<?= $_SESSION['usuario']->cedula ?>" readonly="readonly">
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

    $.validator.addMethod('isbn', function (value) {
        return /^[9][0-9]{13}$/.test(value);
    }, 'Ingrese una un isbn correcto que inicie con el 9 y tenga 14 digitos en total');

    $("#formRegistrarLibro").submit(function () {
        return false
    })


    $("#btnRegistrar").click(function () {
        let formulario = $("#formRegistrarLibro").serialize()
        console.log(formulario)
        $("#formRegistrarLibro").submit()
        $("#formRegistrarLibro").validate({

            rules: {
                inpIsbn: {
                    required: true,
                    isbn: true
                },
                inpNombre: {
                    required: true
                },
                inpAutor: {
                    required: true
                },
                txtDescripcion: {
                    required: true,
                },
                sltGenero: {
                    required: true,
                },
                inpPublicacion: {
                    required: true,
                }
            },
            messages: {
                inpIsbn: {
                    required: "Campo obligatorio",
                },
                inpNombre: {
                    required: "Campo obligatorio",
                },
                inpAutor: {
                    required: "Campo obligatorio",
                },
                txtDescripcion: {
                    required: "Campo obligatorio",
                },
                sltGenero: {
                    required: "Campo obligatorio",
                },
                inpAño: {
                    required: "Campo obligatorio",
                }
            },
            submitHandler: function () {
                console.log("ingresar submit")
                $.ajax({
                    url: '<?= LIBRO_REGISTRAR['url'] ?>',
                    data: formulario,
                    dataType: 'json',
                    type: 'post',
                    success: function (resultado) {
                        console.log(resultado)
                        if (resultado.mensaje == 3) {
                            $("#modal .modal-title").html("Libro Existente")
                            $("#modal .modal-body").html("El isbn ya se encuentra registrado")
                            $("#modal").modal()
                        }
                        if (resultado.mensaje == 2) {
                            $("#modal .modal-title").html("Falla en el registro")
                            $("#modal .modal-body").html("Por favor comuníquese con su administrador")
                            $("#modal").modal()
                        }
                        if (resultado.mensaje == 1) {
                            $("#modal .modal-title").html("Libro registrado!")
                            $("#modal .modal-body").html("Libro registrado con exito")
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