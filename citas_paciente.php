<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/conexion.php');
?>


<h2 class="text-center">Citas del paciente</h2><br>

<div class="panel panel-default">
    <div class="panel-heading">Resultado de la búsqueda</div>
    <div class="panel-body">

        <?php
        $id = addslashes($_GET["id"]);

        $sql = "SELECT id_paciente FROM paciente WHERE id_paciente = $id;";
        $resultado = $bd->query($sql);
        $registro = $resultado->fetch_array();
        if (count($registro) == 0) {
            Errors::mostrar_error("asistencia_paciente.php", 3);
        }

        $sql = "SELECT id_paciente, CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS paciente "
                . "FROM paciente WHERE id_paciente = $id;";

        $resultado = $bd->query($sql);

        if ($resultado) {
            $row = $resultado->fetch_array();

            $bd_id_paciente = $row['id_paciente'];
            $bd_paciente = $row['paciente'];
            ?>

            <table>
                <tr>
                    <td>ID:</td>
                    <td><input type="text" value="<?php echo($bd_id_paciente); ?>" class="form-control" readonly></td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td><input type="text" value="<?php echo($bd_paciente); ?>" class="form-control" readonly></td>
                </tr>
            </table>

            <?php
            $sql = "SELECT a.id_cita, a.fecha, CONCAT( b.nombre, ' ', b.apellidos ) AS especialista, a.asistencia, a.pago, a.paquete, a.especialidad, a.area, p.hipertension AS hipertension "
                    . "FROM citas a JOIN usuarios_sistema b ON ( a.id_especialista = b.id ) "
                    . "JOIN paciente p ON (p.id_paciente = a.id_paciente) "
                    . "WHERE a.id_paciente = $id;";

            $resultado = $bd->query($sql);

            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    ?>
                    <div class="relleno"></div>
                    <table border="1" class="tabla2">
                        <tr>
                            <th>Cita</th>
                            <th>Especialista</th>
                            <th>Asistió</th>
                            <th>Pago</th>
                            <th>Paquete</th>
                            <th>Fecha</th>
                            <th>Especialidad</th>
                            <th>Area</th>
                            <th>Modificar cita</th>
                        </tr>
                        <?php
                        while ($row = $resultado->fetch_array()) {
                            $id_cita = $row["id_cita"];
                            $especialista = $row["especialista"];
                            $asistencia = $row["asistencia"] == 1 ? "Sí" : "No";
                            $pago = $row["pago"];
                            $paquete = $row["paquete"];
                            $fecha = $row["fecha"];
                            $especialidad = $row["especialidad"];
                            $area = $row["area"];
                            $hipertension = $row["hipertension"];

                            $info = "id_cita=$id_cita&especialista=$especialista&asistencia=" . $row['asistencia'] .
                                    "&pago=$pago&paquete=$paquete&fecha=$fecha&especialidad=$especialidad&area=$area&hipertension=$hipertension";

                            $color = $hipertension == 1 ? "orange" : "white";
                            ?>
                            <tr style="background-color: <?php echo($color); ?>;">
                                <td><?php echo($id_cita); ?></td>
                                <td><?php echo($especialista); ?></td>
                                <td><?php echo($asistencia); ?></td>
                                <td><?php echo($pago); ?></td>
                                <td><?php echo($paquete); ?></td>
                                <td><?php echo($fecha); ?></td>
                                <td><?php echo($especialidad); ?></td>
                                <td><?php echo($area); ?></td>
                                <td><input type="button" value="Modificar" class="btn btn-primary" onclick="location.href = 'modificar_cita.php?<?php echo($info); ?>'"></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="mensaje mensaje-error">No se encontraron citas para este paciente.</div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="mensaje mensaje-error">Error realizando la consulta: <?php echo($bd->error) ?></div>
                    <?php
                }
                $bd->close();
                ?>
            </table>
            <?php
        } else {
            Errors::mostrar_error("asistencia_paciente.php", 3);
        }
        ?>
    </div>
</div>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php require('./includes/footer.php'); ?>
