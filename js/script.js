$(document).ready(function () {

    cargarSensores();

    $("#btt-agregar").button({
        icon: "ui-icon-plusthick"
    });

    $("#btt-agregarM").button({
        icon: "ui-icon-plusthick"
    });
    $("#btt-generarR").button({
        icon:"ui-icon-document"
    });

    $("#boton-guardar").button();


    $('#dialogo').dialog({
        autoOpen: false,
        draggable: false,
        width: 500,
        height: 300,
        modal: true
    });

    $('#dialogoMediciones').dialog({
        autoOpen: false,
        draggable: false,
        width: 500,
        height: 500,
        modal: true
    });

    $("#boton-guardarM").button();
    
    //DatePicker
    $("#fecha").datepicker({
        dateFormat: "yy-mm-dd",
        width:200
    });

    $("#selectMenuId").selectmenu({
        width:200
    });

    

});


function cargarSensores(){
    var datosDB;

    $.ajax({
        type: "GET",
        url: "http://localhost/faniot-sensores/index.php/Principal/recuperarSensoresDB",
        success: function (response) {
            datosDB = JSON.parse(response);

                $(".tabla-sensores").append('<th>Id</th><th>Nombre</th><th>Descripcion</th><th>Eliminar</th><th>Modificar</th>');

                $.each(datosDB, function (i, item) {
                    $(".tabla-sensores").append('<tr><td id="id" name="id">'+item.id+'</td><td>'+item.nombreSensor+'</td><td>'+item.descripcion+'</td><td><button id="btt-eliminar" class="icon-trash-o" onclick="eliminar('+item.id+')" ></button></td><td><button id="btt-modificar" class="icon-edit" onclick="modificar('+item.id+')"></button></td></tr>');
                });
        }
        
    });
}

function eliminar(id){
    var sensorAEliminar = id;

    $.ajax({
        type: "POST",
        url: "http://localhost/faniot-sensores/index.php/Principal/eliminarSensorDB",
        data: {sensorAEliminar},
        success: function (response) {

            if(response){
                alert("Eliminacion realizada con exito");
                $(".tabla-sensores").empty();
                cargarSensores();
            }else{
                alert("No se pudo eliminar el registro");
            }
        }
    });
}

function modificar(id){

    let sensorAModificar = id;

    $("#dialogo").dialog("open");

    $("#boton-guardar").click(function (e) { 
        e.preventDefault();

        var nombreModificacion = $('#nombre').val();
        var descripcionModificacion = $('#descripcion').val();

        $.ajax({
            type: "POST",
            url: "http://localhost/faniot-sensores/index.php/Principal/modificarSensorDB",
            data: {sensorAModificar, nombreModificacion, descripcionModificacion},
            success: function (response) {
    
                if(response){

                    alert("Modificacion realizada con exito");

                    $("#dialogo").dialog( "close" );

                    window.location.replace("http://localhost/faniot-sensores/index.php/Principal/cargarVista");

                }else{
                    alert("No se pudo modificar el registro");
                }

            }
        });
    });
}

function agregarSensor(){
    $("#dialogo").dialog("open");

    $("#boton-guardar").click(function (e) { 
        e.preventDefault();

        var nombre = $('#nombre').val();
        var descripcion = $('#descripcion').val();

        $.ajax({
            type: "POST",
            url: "http://localhost/faniot-sensores/index.php/Principal/nuevoSensorDB",
            data: {nombre, descripcion},
            success: function (response) {
    
                if(response){

                    alert("Alta realizada con exito");

                    $("#dialogo").dialog( "close" );

                    window.location.replace("http://localhost/faniot-sensores/index.php/Principal/cargarVista");

                }else{
                    alert("No se pudo registrar el nuevo sensor");
                }

            }
        });
    });
}

function agregarMediciones(){
    
    //Traigo de la BD todos los id de los sensores disponibles para agregarlos en el selectMenu
    var datosDB;

    $.ajax({
        type: "GET",
        url: "http://localhost/faniot-sensores/index.php/Principal/recuperarSensoresDB",
        success: function (response) {
            datosDB = JSON.parse(response);

            $.each(datosDB, function (i, item) {
                $("#selectMenuId").append('<option value="'+item.id+'">'+item.id+'</option>');
            });

        }
    });

    $("#dialogoMediciones").dialog("open");

    //Ahora recien envio los datos para almacenar las mediciones
    $("#boton-guardarM").click(function (e) { 
        e.preventDefault();

        var fecha = $('#fecha').val();
        var hora = $('#hora').val();
        var temperatura = $('#temperatura').val();
        var sensor = $('#selectMenuId').val();

        $.ajax({
            type: "POST",
            url: "http://localhost/faniot-sensores/index.php/Principal/nuevaMedicionDB",
            data: {fecha, hora, temperatura, sensor},
            success: function (response) {
    
                if(response){

                    alert("Alta realizada con exito");

                    $("#dialogo").dialog( "close" );

                    window.location.replace("http://localhost/faniot-sensores/index.php/Principal/cargarVista");

                }else{
                    alert("No se pudo registrar la nueva medicion del sensor");
                }

            }
        });

    });
}

function generarReporte(){
    var datosDB;
    
    $.ajax({
        type: "GET",
        url: "http://localhost/faniot-sensores/index.php/Principal/datosMedicionesDB",
        success: function (response) {

            console.log(response);
            
            datosDB = JSON.parse(response);

            $("#datosGenerados").append('<h2>Mediciones de los sensores ordenados por fecha</h2>');

            $("#datosGenerados").append('<table class="tablaDatos"><th>Nombre sensor</th><th>Fecha medicion</th><th>Temperatura</th></table>');

            $.each(datosDB, function (i, item) {
                $(".tablaDatos").append('<tr><td>'+item.nombreSensor+'</td><td>'+item.fecha+'</td><td>'+item.temperatura+'</td></tr>');
            });
        }
    });

    




    //Grafico
    // var miCanvas = document.getElementById("myChart").getContext("2d");
    // var chart = new Chart(miCanvas,{
    //     type: "line",
    //     data: {
    //         labels: [],
    //         datasets:[{

    //         }]
    //     }
    // })
}
