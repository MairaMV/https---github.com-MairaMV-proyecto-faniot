<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de sensores</title>

    <!-- Estilo -->

        <!-- Mis estilos -->
        <link rel="stylesheet" href="<?php echo base_url().'css/stylePrincipal.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'fonts/style.css'?>">

        <!-- Estilos jquery ui -->
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.theme.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.structure.min.css'?>">
    
    <!-- Scripts  -->

        <!-- Scripts jquery + jquery ui -->
        <script src="<?php echo base_url().'js/jquery-3.6.0.min.js'?>"></script>
        <script src="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.js'?>"></script>

        <!-- Mis scripts -->
        <script src="<?php echo base_url().'js/script.js'?>"></script>

        <!-- Grafico -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
        

</head>
<body>
    
    <!-- Sección principal -->
    <section id="global">

        <!-- Cabecera -->
        <header>
            <div id="titulo">
                <h1>Listado de sensores</h1>
            </div>
        </header>

        <!-- Contenido -->
        <section id="contenido">

            <div id="listado-sensores">
                <table class="tabla-sensores">
                </table>
            </div>

            <div id="botones">
                <button id="btt-agregar" onclick="agregarSensor()">Agregar</button>
                <button id="btt-agregarM" onclick="agregarMediciones()">Agregar mediciones</button>
                <button id="btt-generarR" onclick="generarReporte()">Generar reporte</button>
            </div>
        </section>

        <form method="post" id="formulario">
            <div id="dialogo" title="Sensor" style="text-align:center">
                <p>Nombre de sensor</p>
                <input type="text" name="nombre" id="nombre">
                <span id="spanNombre"></span>
                <br><br>
                
                <p>Descripcion del sensor</p>
                <input type="text" name="descripcion" id="descripcion">
                <span id="spanDescripcion"></span>
                <br><br>

                <button id="boton-guardar">Guardar</button>
            </div>
        </form>

        <form method="post" id="formularioMediciones">
            <div id="dialogoMediciones" title="Mediciones del sensor" style="text-align:center">
                <p>Fecha de medicion</p>
                <input type="text" name="fecha" id="fecha">
                <br><br>
                
                <p>Hora de medicion</p>
                <input type="time" name="hora" id="hora" style="width: 200px;">
                <br><br>

                <p>Temperatura de medicion</p>
                <input type="text" name="temperatura" id="temperatura">
                <br><br>

                <p>Seleccionar sensor</p>
                <select name="selectMenuId" id="selectMenuId">
                </select>
                <br><br>


                <button id="boton-guardarM">Guardar</button>
            </div>
        </form>

        <div id="datosGenerados">
        </div>

        <!-- <div>
            <canvas id="myChart" width="400" heigth="400"></canvas>
        </div> -->

    </section>

    <!-- Pie de pagina -->
    <footer>
        <ul id="pie-paginas">
            <li><a href="https://faniot.com.ar/">FANIOT</a></li>
        </ul>
    </footer>
</body>
</html>