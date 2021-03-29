<?php
require('./includes/header.php');

if (isset($_POST["submit"])) {
    ?>
    
    <h2 class="text-center">Modificar cita</h2><br>

    <?php
    $id_cita = $_POST["id_cita"];
    $asistencia = $_POST["asistencia"];
    $pago = $_POST["pago"];
    $paquete = $_POST["paquete"];

    require('./includes/conexion.php');

    $sql = "UPDATE citas "
            . "SET asistencia = '$asistencia', pago = '$pago', paquete = '$paquete' "
            . "WHERE id_cita = $id_cita;";

    $resultado = $bd->query($sql);

    if ($resultado) {
        ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="mensaje mensaje-ok">Los cambios a la cita se han realizado correctamente.</div>
                <div class="relleno"></div>
                <input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">
                <?php
            } else {
                ?>
                <div class="mensaje mensaje-error">Error al ejecutar la consulta: <?php echo($bd->error); ?></div>
                <?php
            }

            $bd->close();
        } else {
            ?>
            <!--Título e instrucciones de la página sin recibir los cambios-->
            <h2 class="text-center">Modificar cita</h2><br>
            <div class="panel panel-default">
                <div class="panel-heading">Datos generales de la cita</div>
                <div class="panel-body">

                    <div class="mensaje mensaje-info">
                        Por favor modifique los datos de la cita que sean necesarios:</br>
                        ( Para el paquete de 10 consultas, escriba: paquete10 )
                    </div>
                    <?php
                    $id_cita = $_GET["id_cita"];
                    $especialista = $_GET["especialista"];
                    $asistencia = $_GET["asistencia"];
                    $pago = $_GET["pago"];
                    $paquete = $_GET["paquete"];
                    $fecha = $_GET["fecha"];
                    $especialidad = $_GET["especialidad"];
                    $area = $_GET["area"];
                    $hipertension = $_GET["hipertension"] == 1 ? "orange" : "white";
                    ?>

                    <form action="modificar_cita.php" method="post">
                        <table border="1" class="tabla2" style="background-color: <?php echo($hipertension); ?>;">
                            <tr>
                                <td>ID de la cita:</td>
                                <td><input type="text" name="id_cita" value="<?php echo($id_cita); ?>"  class="form-control" readonly class="readonly"></td>
                            </tr>
                            <tr>
                                <td>Especialista:</td>
                                <td><input type="text" value="<?php echo($especialista); ?>"  class="form-control" readonly class="readonly"></td>
                            </tr>
                            <tr>
                                <td>Asistencia:</td>
                                <td>
                                    <input type="radio" name="asistencia"  value="1" <?php echo($asistencia == 1 ? "checked" : "") ?>>Sí
                                    <input type="radio" name="asistencia" value="0" <?php echo($asistencia == 0 ? "checked" : "") ?>>No
                                    <input type="radio" name="asistencia" value="2" <?php echo($asistencia == 2 ? "checked" : "") ?>>Canceló
                                </td>
                            </tr>
                            <tr>
                                <td>Pago:</td>
                                <td><input type="text" name="pago"  class="form-control" value="<?php echo($pago); ?>"></td>
                            </tr>
                            <tr>
                                <td>Paquete:</td>
                                <td><input type="text" name="paquete"  class="form-control" value="<?php echo($paquete); ?>"></td>
                            </tr>
                            <tr>
                                <td>Fecha:</td>
                                <td><input type="text" value="<?php echo($fecha); ?>"  class="form-control" readonly class="readonly"></td>
                            </tr>
                            <tr>
                                <td>Especialidad:</td>
                                <td><input type="text" value="<?php echo($especialidad); ?>"  class="form-control" readonly class="readonly"></td>
                            </tr>
                            <tr>
                                <td>Area:</td>
                                <td><input type="text" value="<?php echo($area); ?>"  class="form-control" readonly class="readonly"></td>
                            </tr>
                        </table>
                        <div class="relleno"></div>
                        <input type="button" value="Cancelar" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">
                        <input type="reset" value="Restablecer" class="btn btn-primary">
                        <input type="submit" name="submit" value="Modificar cita" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php require('./includes/footer.php'); ?>
