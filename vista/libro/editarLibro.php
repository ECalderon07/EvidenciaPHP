<div class="row ">
    <div class="col-md-6 offset-md-3 ">    
        <div class="card align-middle">
            <div class="card-header bg-primary text-white">INGRESE DATOS</div>
            <form id="formEditarLibro">
                <div class="card-body">


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">ISBN</label>
                            <input type="text" class="form-control" id="inpIsbn" name="inpIsbn"  value="<?= $datos->isbn ?>" placeholder="Digite isbn">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="inpNombre" name="inpNombre" value="<?= $datos->nombre ?>"placeholder="Digite nombre">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" value="<?= $datos->genero ?>" placeholder="Digite el descripcion">
                            
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Publicacion</label>
                        <input type="number" min="1900" max="2019" class="form-control" name="inpPublicacion" id="inpPublicacion" value="<?= $datos->publicacion ?>">
                    </div>                   
                    <div class="form-group">
                        <label for="">Genero</label>
                        <select id="sltGenero" name="sltGenero" class="form-control">
                            <option <?= $datos->genero == 'null' ? "selected" : "" ?>>Seleccione...</option>
                            <option <?= $datos->genero == 'ficcion' ? "selected" : "" ?>>ficcion</option>
                            <option <?= $datos->genero == 'terror' ? "selected" : "" ?>>terror</option>
                            <option <?= $datos->genero == 'drama' ? "selected" : "" ?>>drama</option>        
                            <option <?= $datos->genero == 'infantil' ? "selected" : "" ?>>infantil</option>
                            <option <?= $datos->genero == 'comedia' ? "selected" : "" ?>>comedia</option>
                            <option <?= $datos->genero == 'aventura' ? "selected" : "" ?>>aventura</option> 
                            <option <?= $datos->genero == 'suspenso' ? "selected" : "" ?>>suspenso</option>
                            <option <?= $datos->genero == 'historia' ? "selected" : "" ?>>historia</option>
                            <option <?= $datos->genero == 'biografia' ? "selected" : "" ?>>biografia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Autor</label>
                        <input type="text" class="form-control" id="inpAutor"  name="inpAutor" value="<?= $datos->autor ?>" placeholder="Digite autor">
                    </div> 
                    <div class="form-group">
                        <label for="">Cedula</label>
                        <input type="text" class="form-control" id="inpCedula"  name="inpCedula" value="<?= $datos->cedula ?>" readonly="readonly">
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

    $.validator.addMethod('isbn', function (value) {
        return /^[9][0-9]{13}$/.test(value);
    }, 'Ingrese una un isbn correcto que inicie con el 9 y tenga 14 dígitos en total');

    $("#formEditarLibro").submit(function () {
        return false
    })


    $("#btnEditar").click(function () {
        let formulario = $("form").serialize()
        console.log(formulario)
        $("#formEditarLibro").submit()
        $("#formEditarLibro").validate({

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
            }, submitHandler: function () {
                $.ajax({
                    url: '<?= LIBRO_EDITAR['url'] ?>',
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
                            $("#modal .modal-title").html("Libro Actualizado!")
                            $("#modal .modal-body").html("Libro actualizado con éxito")
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