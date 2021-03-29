<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/conexion.php');
require('./includes/fecha_hora.php');
?>

<div class="panel panel-default">
    <div class="panel-heading">Lista de Citas</div>
    <div class="panel-body">
        <?php
        if (isset($_POST["desde"]) && isset($_POST["hasta"])) {
            $desde = $_POST["desde"];
            $hasta = $_POST["hasta"];

            $sql = "SELECT a.id_cita, CONCAT( d.nombre,  ' ', d.ap_paterno,  ' ', d.ap_materno ) AS  paciente, a.fecha, CONCAT( b.nombre,  ' ', b.apellidos ) AS especialista, a.asistencia, a.pago, a.paquete, a.especialidad, a.area, d.hipertension " .
                    "FROM citas a " .
                    "JOIN usuarios_sistema b ON ( a.id_especialista = b.id ) " .
                    "JOIN paciente d ON ( a.id_paciente = d.id_paciente ) " .
                    "WHERE a.fecha BETWEEN '$desde' AND '$hasta'";

            $resultado = $bd->query($sql);

            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    ?>
                    <div class="mensaje mensaje-info">
                        Se encontraron las siguientes citas:
                    </div>
                    <table border="1" class="tabla2">
                        <tr>
                            <th>Cita</th>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Especialista</th>
                            <th>Asistió</th>
                            <th>Importe</th>
                            <th>Paquete</th>
                            <th>Especialidad</th>
                            <th>Area</th>
                        </tr>
                        <?php
                        while ($registro = $resultado->fetch_array()) {
                            $id_cita = $registro["id_cita"];
                            $paciente = $registro["paciente"];
                            $fecha = $registro["fecha"];
                            $especialista = $registro["especialista"];
                            $asistencia = $registro["asistencia"] == 1 ? "Sí" : "No";
                            $pago = $registro["pago"];
                            $paquete = $registro["paquete"];
                            $especialidad = $registro["especialidad"];
                            $area = $registro["area"];
                            $hipertension = $registro["hipertension"] == 1 ? "orange" : "white";
                            ?>
                            <tr style="background-color: <?php echo($hipertension); ?>;">
                                <td><?php echo($id_cita); ?></td>
                                <td><?php echo($paciente); ?></td>
                                <td><?php echo($fecha); ?></td>
                                <td><?php echo($especialista); ?></td>
                                <td><?php echo($asistencia); ?></td>
                                <td><?php echo($pago); ?></td>
                                <td><?php echo($paquete); ?></td>
                                <td><?php echo($especialidad); ?></td>
                                <td><?php echo($area); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                } else {
                    ?>
                    <div class="mensaje mensaje-error">No se encontraron citas.</div>
                    <?php
                }
            } else {
                ?>
                <div class="relleno"></div>
                <div class="mensaje mensaje-error">Error realizando la consulta: <?php echo($bd->error) ?></div>
                <?php
            }

            $bd->close();
        } else {
            $hoy = FechaHora::hoy();

            $sql = "SELECT a.id_cita, CONCAT( d.nombre,  ' ', d.ap_paterno,  ' ', d.ap_materno ) AS  paciente, a.fecha, CONCAT( b.nombre,  ' ', b.apellidos ) AS especialista, a.asistencia, a.pago, a.paquete, a.especialidad, a.area, d.hipertension " .
                    "FROM citas a " .
                    "JOIN usuarios_sistema b ON ( a.id_especialista = b.id ) " .
                    "JOIN paciente d ON ( a.id_paciente = d.id_paciente ) " .
                    "WHERE a.fecha LIKE '$hoy';";

            $resultado = $bd->query($sql);

            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    ?>
                    <div class="mensaje mensaje-info">
                        Se encontraron las siguientes citas:
                    </div>
                    <table border="1" class="tabla2">
                        <tr>
                            <th>Cita</th>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Especialista</th>
                            <th>Asistió</th>
                            <th>Pago</th>
                            <th>Paquete</th>
                            <th>Especialidad</th>
                            <th>Area</th>
                        </tr>
                        <?php
                        while ($registro = $resultado->fetch_array()) {
                            $id_cita = $registro["id_cita"];
                            $paciente = $registro["paciente"];
                            $fecha = $registro["fecha"];
                            $especialista = $registro["especialista"];
                            $asistencia = $registro["asistencia"] == 0 ? "No" : "Sí";
                            $pago = $registro["pago"];
                            $paquete = $registro["paquete"];
                            $area = $registro["area"];
                            $especialidad = $registro["especialidad"];
                            $hipertension = $registro["hipertension"] == 1 ? "orange" : "white";
                            ?>
                            <tr style="background-color: <?php echo($hipertension); ?>;">
                                <td><?php echo($id_cita); ?></td>
                                <td><?php echo($paciente); ?></td>
                                <td><?php echo($fecha); ?></td>
                                <td><?php echo($especialista); ?></td>
                                <td><?php echo($asistencia); ?></td>
                                <td><?php echo($pago); ?></td>
                                <td><?php echo($paquete); ?></td>
                                <td><?php echo($especialidad); ?></td>
                                <td><?php echo($area); ?></td>
                            </tr>
                <?php
            }
            ?>
                    </table>
                        <?php
                    } else {
                        ?>
                    <div class="mensaje mensaje-error">No se encontraron citas.</div>
                    <?php
                }
            } else {
                ?>
                <div class="relleno"></div>
                <div class="mensaje mensaje-error">Error realizando la consulta: <?php echo($bd->error) ?></div>
        <?php
    }

    $bd->close();
}
?>
    </div>
</div>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php require('./includes/footer.php'); ?>
