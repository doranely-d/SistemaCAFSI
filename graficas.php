<?php
require('./includes/header.php');
require('./includes/conexion.php');
require('./includes/fecha_hora.php');
?>
<h2 class="text-center">Gráficas</h2><br />

<div class="panel panel-default">
     <div class="panel-heading"></div>
    <div class="panel-body">
<?php
$type = $_GET["type"];
$where = "";

if ($type == 1) {
    $where = "DATE_FORMAT(fecha, '%m') = DATE_FORMAT(CURDATE(), '%m')";
    ?> 
    <div class="mensaje mensaje-info">
          Se obtuvieron las siguientes gráficas para el mes actual:
    </div>
    <?php
} elseif ($type == 2) {
    $dia = date("d");
    if ($dia <= 15) {
        $where = "DATE_FORMAT(fecha, '%e') <= 15";
        ?>
        <div class="mensaje mensaje-info">
         Se obtuvieron las siguientes gráficas para la primera quincena del mes:
    </div>
    <?php
    } else {
        $where = "DATE_FORMAT(fecha, '%e') > 15";
        ?>
        <div class="mensaje mensaje-info">
         Se obtuvieron las siguientes gráficas para la segunda quincena del mes:
        </div>
        <?php
    }
} elseif ($type == 3) {
    $where = "DATE_FORMAT(fecha, '%U') = DATE_FORMAT(CURDATE(), '%U')";
    ?> 
    <div class="mensaje mensaje-info">
        Se obtuvieron las siguientes gráficas para la semana actual:
    </div>
    <?php
} elseif ($type == 4) {
    $where = "fecha = CURDATE()";
    ?>
    <div class="mensaje mensaje-info">
        Se obtuvieron las siguientes gráficas para el día de hoy:
    </div>
    <?php
}
?>

<!--Fisioterapia-->

<?php
$sql = "SELECT COUNT(*) fisioterapia,
                (SELECT COUNT(*)
                FROM citas
                WHERE pago > 0 AND LOWER(especialidad) LIKE 'fisioterapia' AND $where) pagadas,
                    (SELECT COUNT(*)
                    FROM citas
                    WHERE pago = 0 AND LOWER(especialidad) LIKE 'fisioterapia' AND $where) no_pagadas,
                        (SELECT COUNT(*)
                        FROM citas
                        WHERE LOWER(paquete) LIKE 'paquete10' AND LOWER(especialidad) LIKE 'fisioterapia' AND $where) con_paquete,
                            (SELECT COUNT(*)
                            FROM citas
                            WHERE (asistencia = 1 AND fecha < CURDATE()) AND LOWER(especialidad) LIKE 'fisioterapia' AND $where) asistio,
                                (SELECT COUNT(*)
                                FROM citas
                                WHERE (asistencia = 0 AND fecha < CURDATE()) AND LOWER(especialidad) LIKE 'fisioterapia' AND $where) no_llego,
                                    (SELECT COUNT(*)
                                    FROM citas
                                    WHERE (asistencia = 2 AND fecha < CURDATE()) AND LOWER(especialidad) LIKE 'fisioterapia' AND $where) cancelo
            FROM citas
            WHERE LOWER(especialidad) LIKE 'fisioterapia' AND $where";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();

$fisioterapia = $registro["fisioterapia"];
$pagadas = $registro["pagadas"];
$no_pagadas = $registro["no_pagadas"];
$con_paquete = $registro["con_paquete"];
$asistio = $registro["asistio"];
$no_llego = $registro["no_llego"];
$cancelo = $registro["cancelo"];
?>

<!--Nutrición-->

<?php
$sql = "SELECT COUNT(*) nutricion,
                (SELECT COUNT(*)
                FROM citas
                WHERE pago > 0 AND LOWER(especialidad) LIKE 'nutrición' AND $where) nutricion_pagadas,
                    (SELECT COUNT(*)
                    FROM citas
                    WHERE pago = 0 AND LOWER(especialidad) LIKE 'nutrición' AND $where) nutricion_no_pagadas 
            FROM citas
            WHERE LOWER(especialidad) LIKE 'nutrición' AND $where";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();

$nutricion = $registro["nutricion"];
$nutricion_pagadas = $registro["nutricion_pagadas"];
$nutricion_no_pagadas = $registro["nutricion_no_pagadas"];
?>

<!--Psicología-->

<?php
$sql = "SELECT COUNT(*) psicologia,
                (SELECT COUNT(*)
                FROM citas
                WHERE pago > 0 AND LOWER(especialidad) LIKE 'psicología' AND $where) psicologia_pagadas,
                    (SELECT COUNT(*)
                    FROM citas
                    WHERE pago = 0 AND LOWER(especialidad) LIKE 'psicología' AND $where) psicologia_no_pagadas 
            FROM citas
            WHERE LOWER(especialidad) LIKE 'psicología' AND $where";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();

$psicologia = $registro["psicologia"];
$psicologia_pagadas = $registro["psicologia_pagadas"];
$psicologia_no_pagadas = $registro["psicologia_no_pagadas"];
?>

<!--Pediatría-->

<?php
$sql = "SELECT COUNT(*) pediatria,
                (SELECT COUNT(*)
                FROM citas
                WHERE pago > 0 AND LOWER(especialidad) LIKE 'pediatría' AND $where) pediatria_pagadas,
                    (SELECT COUNT(*)
                    FROM citas
                    WHERE pago = 0 AND LOWER(especialidad) LIKE 'pediatría' AND $where) pediatria_no_pagadas 
            FROM citas
            WHERE LOWER(especialidad) LIKE 'pediatría' AND $where";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();

$pediatria = $registro["pediatria"];
$pediatria_pagadas = $registro["pediatria_pagadas"];
$pediatria_no_pagadas = $registro["pediatria_no_pagadas"];
?>

<!--Medicina general-->

<?php
$sql = "SELECT COUNT(*) medicina_general,
                (SELECT COUNT(*)
                FROM citas
                WHERE pago > 0 AND LOWER(especialidad) LIKE 'medicina general' AND $where) mg_pagadas,
                    (SELECT COUNT(*)
                    FROM citas
                    WHERE pago = 0 AND LOWER(especialidad) LIKE 'medicina general' AND $where) mg_no_pagadas 
            FROM citas
            WHERE LOWER(especialidad) LIKE 'medicina general' AND $where";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();

$medicina_general = $registro["medicina_general"];
$mg_pagadas = $registro["mg_pagadas"];
$mg_no_pagadas = $registro["mg_no_pagadas"];
?>

<!--Enfermería-->

<?php
$sql = "SELECT COUNT(*) enfermeria,
                (SELECT COUNT(*)
                FROM citas
                WHERE pago > 0 AND LOWER(especialidad) LIKE 'enfermería' AND $where) enfermeria_pagadas,
                    (SELECT COUNT(*)
                    FROM citas
                    WHERE pago = 0 AND LOWER(especialidad) LIKE 'enfermería' AND $where) enfermeria_no_pagadas 
            FROM citas
            WHERE LOWER(especialidad) LIKE 'enfermería' AND $where";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();

$enfermeria = $registro["enfermeria"];
$enfermeria_pagadas = $registro["enfermeria_pagadas"];
$enfermeria_no_pagadas = $registro["enfermeria_no_pagadas"];

$bd->close();
?>

        <div id="grafica" style="width: 1000px; height: 500px;"></div>
    </div>
</div>
<div class="panel panel-default">
     <div class="panel-heading">La tabla de la gráfica es la siguiente:</div>
    <div class="panel-body">
        <table border="1" class="tabla2">
            <tr><th>Área</th><th>Totales</th><th>Pagadas</th><th>No pagadas</th><th>Con paquete</th><th>Asistió</th><th>No asistió</th><th>Canceló</th></tr>
            <tr><?php echo("<td>Fisioterapia</td><td>$fisioterapia</td><td>$pagadas</td><td>$no_pagadas</td><td>$con_paquete</td><td>$asistio</td><td>$no_llego</td><td>$cancelo</td>") ?></tr>
            <tr><?php echo("<td>Nutrición</td><td>$nutricion</td><td>$nutricion_pagadas</td><td>$nutricion_no_pagadas</td><td></td><td></td>") ?></tr>
            <tr><?php echo("<td>Psicología</td><td>$psicologia</td><td>$psicologia_pagadas</td><td>$psicologia_no_pagadas</td><td></td><td></td>") ?></tr>
            <tr><?php echo("<td>Pediatría</td><td>$pediatria</td><td>$pediatria_pagadas</td><td>$pediatria_no_pagadas</td><td></td><td></td>") ?></tr>
            <tr><?php echo("<td>Medicina general</td><td>$medicina_general</td><td>$mg_pagadas</td><td>$mg_no_pagadas</td><td></td><td></td>") ?></tr>
            <tr><?php echo("<td>Enfermería</td><td>$enfermeria</td><td>$enfermeria_pagadas</td><td>$enfermeria_no_pagadas</td><td></td><td></td>") ?></tr>
        </table>
    </div>
</div>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['', 'Fisoterapia', 'Nutrición', 'Psicología', 'Pediatría', 'Medicina general', 'Enfermería'],
            ['Totales', <?php echo($fisioterapia) ?>, <?php echo($nutricion) ?>, <?php echo($psicologia) ?>, <?php echo($pediatria) ?>, <?php echo($medicina_general) ?>, <?php echo($enfermeria) ?>],
            ['Pagadas', <?php echo($pagadas) ?>, <?php echo($nutricion_pagadas) ?>, <?php echo($psicologia_pagadas) ?>, <?php echo($pediatria_pagadas) ?>, <?php echo($mg_pagadas) ?>, <?php echo($enfermeria_pagadas) ?>],
            ['No pagadas', <?php echo($no_pagadas) ?>, <?php echo($nutricion_no_pagadas) ?>, <?php echo($psicologia_no_pagadas) ?>, <?php echo($pediatria_no_pagadas) ?>, <?php echo($mg_no_pagadas) ?>, <?php echo($enfermeria_no_pagadas) ?>],
            ['Con paquete', <?php echo($con_paquete) ?>, 0, 0, 0, 0, 0],
            ['Asistió', <?php echo($asistio) ?>, 0, 0, 0, 0, 0],
            ['No asistió', <?php echo($no_llego) ?>, 0, 0, 0, 0, 0],
            ['Canceló', <?php echo($cancelo) ?>, 0, 0, 0, 0, 0],
        ]);

        var options = {
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('grafica'));
        chart.draw(data, options);
    }
</script>

<?php require('./includes/footer.php'); ?>