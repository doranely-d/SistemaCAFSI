<?php
require('./includes/header.php');
require('./includes/conexion.php');
?>

<h2 class="text-center">Registrar nueva cita</h2><br>
<div class="panel panel-default">
    <div class="panel-body">
        <?php
        $id_cita = $_POST["id_cita"];
        $id_paciente = $_POST["id_paciente"];
        $especialista = $_POST["especialista"];
        $especialidad = $_POST["especialidad"];
        $area = $_POST["area"];
        $pago = $_POST["pago"];
        $paquete = $_POST["paquete"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["especialista"];

        $sql = "INSERT INTO citas (id_cita, id_paciente, id_especialista, asistencia, pago, paquete, fecha, especialidad, area, hora) "
                . "VALUES ($id_cita, $id_paciente, $especialista, 'no', '$pago', '$paquete', '$fecha', '$especialidad', '$area', '$hora');";
        $resultado = $bd->query($sql);

        if ($resultado) {
            ?>
            <div class="mensaje mensaje-ok">La cita se ha registrado correctamente.</div>
            <?php
        } else {
            echo($bd->error);
        }

        $bd->close();
        ?>
    </div>
</div>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php
require("./includes/footer.php");
