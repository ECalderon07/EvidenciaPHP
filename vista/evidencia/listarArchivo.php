
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ruta</th>
            <th>Ver</th>
            <th>Descargar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>

    </tbody>        
</table>
</body>
<script>
    $("#btnListarEvidencia").click(function () {

        var inpCedula = $("#inpCedula").val();
        $.ajax({
            url: 'cargarArchivo.php',
            data: {inpCedula: inpCedula},
            type: 'post',
            dataType: 'json',
            success: function (resultado) {
                console.log(resultado)
                alert("correcto")
                var acum = ""
                $.each(resultado.mensaje, function (fila, valor) {
                    acum += "<tr>";
                    acum += "<td>" + valor.idEvidencia + "</td><td><img src='" + valor.ruta + "' /></td></td><button></button><td><a href='" + valor.ruta + "'>VER</a></td><td><button><a href='" + valor.ruta + "' download>DESCARGAR</a></button></td><td><button>eliminar</button></td>"
                    acum += "</tr>"
                })
                $("table tbody").html(acum)

            },
            error: function () {
                alert("falla")
            }
        })
    })
</script>

