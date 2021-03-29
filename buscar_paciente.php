<?php
require('./includes/header.php');
require('./includes/errors.php');
?>


<h2 class="text-center">Registrar signos vitales</h2><br>

<form action="buscar_paciente.php" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">Buscar paciente</div>
        <div class="panel-body">

            <div class="mensaje mensaje-info">
                Ingrese uno o más datos del paciente para buscar:
            </div>


            <!--Mostrar mensaje de error si existiera-->
            <?php
            if (isset($_GET["error"])) {
                $error = Errors::get_error($_GET["error"]);
                ?>
                <div class="mensaje mensaje-error"><?php echo($error); ?></div>
                <?php
            }
            ?>

            <table>
                <tr>
                    <td>Por nombre del paciente:</td>
                    <td><input type="text" name="nombre" size="30" class="form-control"></td>
                </tr>
                <tr>
                    <td>Por apellido del paciente:</td>
                    <td><input type="text" name="apellido" size="30" class="form-control"></td>
                </tr>
                <tr>
                    <td>Por id del paciente:</td>
                    <td><input type="text" name="id" size="30" class="form-control"></td>
                </tr>
            </table>

            <div class="relleno"></div>
            <input type="button" value="Cancelar" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">
            <input type="reset" value="Restablecer" class="btn btn-primary">
            <input type="submit" name="submit" value="Buscar" class="btn btn-primary">
        </div>
    </div>
</form>

<?php
if (isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $id = $_POST["id"];

    require('./includes/conexion.php');
    require('./includes/fecha_hora.php');

    $where = "";

    if (empty($nombre) && empty($apellido) && empty($id)) {
        Errors::mostrar_error("buscar_paciente.php", 6);
    } else if (!empty($id)) {
        $where = "p.id_paciente = $id";
    } else if (empty($apellido)) {
        $where = "p.nombre LIKE '%$nombre%'";
    } elseif (empty($nombre)) {
        $where = "p.ap_paterno LIKE '%$apellido%' OR p.ap_materno LIKE '%$apellido%'";
    } else {
        $where = "p.nombre LIKE '%$nombre%' OR p.ap_paterno LIKE '%$apellido%' OR p.ap_materno LIKE '%$apellido%'";
    }

    $sql = "SELECT a.id_cita, p.id_paciente, CONCAT( p.nombre, ' ', p.ap_paterno, ' ', p.ap_materno ) AS paciente, CONCAT(b.nombre, ' ', b.apellidos) AS especialista, a.especialidad, a.area, p.hipertension "
            . "FROM citas a "
            . "JOIN usuarios_sistema b ON ( a.id_especialista = b.id ) "
            . "JOIN paciente p ON (p.id_paciente = a.id_paciente) "
            . "WHERE $where AND a.fecha = curdate();";

    $resultado = $bd->query($sql);

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Datos registrados del Paciente</div>
                <div class="panel-body">
                    <div class="mensaje mensaje-info">
                        Los siguientes pacientes tienen cita para el día de hoy <?php echo(FechaHora::hoyl()) ?>
                    </div>

                    <table border="1" class="tabla2">
                        <tr>
                            <th>Cita</th>
                            <th>Paciente</th>
                            <th>Especialista</th>
                            <th>Especialidad</th>
                            <th>Area</th>
                            <th></th>
                        </tr>
                        <?php
                        while ($row = $resultado->fetch_array()) {
                            $id_cita = $row["id_cita"];
                            $id_paciente = $row["id_paciente"];
                            $paciente = $row["paciente"];
                            $especialista = $row["especialista"];
                            $especialidad = $row["especialidad"];
                            $area = $row["area"];
                            $hipertension = $row["hipertension"];

                            $sql2 = "SELECT COUNT(*) AS tomados FROM signos_vitales WHERE id_cita = $id_cita;";
                            $resultado2 = $bd->query($sql2);
                            $registro2 = $resultado2->fetch_array();
                            $tomados = $registro2["tomados"];

                            $info = "paciente=$id_paciente&cita=$id_cita";

                            $color = $hipertension == 1 ? "orange" : "white";
                            ?>
                            <tr style="background-color: <?php echo($color); ?>;">
                                <td><?php echo($id_cita); ?></td>
                                <td><?php echo($paciente); ?></td>
                                <td><?php echo($especialista); ?></td>
                                <td><?php echo($especialidad); ?></td>
                                <td><?php echo($area); ?></td>
                                <?php if ($tomados == 0) { ?>
                                    <td><input type="button" value="Registrar S.V." class="btn btn-primary" onclick="location.href = 'registrar_signos_vitales.php?<?php echo($info); ?>'"></td>
                                <?php } else { ?>
                                    <td>Registrados</td>
                                <?php } ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="relleno"></div>
            <input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">
            <?php
        } else {
            $error = Errors::get_error(3);
            ?>
            <div class="mensaje mensaje-error"><?php echo($error); ?></div>
            <?php
        }
    } else {
        ?>
        <div class="relleno"></div>
        <p class="mensaje_error">Error realizando la consulta: <?php echo($bd->error) ?></p>
        <?php
    }
    $bd->close();
}
?>

<?php require('./includes/footer.php'); ?>