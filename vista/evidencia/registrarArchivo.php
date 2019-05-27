
<body>
    <form id="formCargaArchivo" enctype="multipart/form-data">
        <input type="txt" name="inpCedula" id="inpCedula">
        <input type="file" name="inpArchivo" id="inpArchivo">
        <input type="submit" name="inpSubir" id="inpSubir" value="SUBIR" disabled="disabled">
    </form>
</body>

<script>


    //desahabilitar la funciòn por defecto del form
    $("#formCargaArchivo").submit(function () {
        return false;
    })

    //observar el cambio de archivo 
    $("#inpArchivo").change(function () {
        console.log($(this)[0].files[0])
        var nombre = $(this)[0].files[0].name
        var tamaño = $(this)[0].files[0].size
        var tipo = nombre.split(".")
        tipo = tipo[1]
        console.log(nombre + " " + tipo + " " + " " + tamaño)

        if (tipo == 'jpg' && (tamaño >= 0 && tamaño < 2145728)) {
            $("#inpSubir").removeAttr("disabled", "disabled")
        } else {
            $("#inpSubir").attr("disabled", "disabled")
            alert("Archivo no vàlido")
        }


    })

    //subir archivo
    $("#inpSubir").click(function () {
        alert("prueba")
        var formulario = new FormData($("#formCargaArchivo")[0])
        $.ajax({
            url: 'cargarArchivo.php',
            data: formulario,
            type: 'post',
            dataType: 'json',
            processData: false,
            cache: false,
            contentType: false,
            success: function (resultado) {
                console.log(resultado)
                alert("correcto")
            },
            error: function () {
                alert("falla")
            }
        })
    })
</script>

