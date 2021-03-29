<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/conexion.php');
require('./includes/fecha_hora.php');
?>


<h2 class="text-center">Registro de citas</h2><br>

<!--Mostrar mensaje de error si existiera-->
<?php
if (isset($_GET["error"])) {
    $error = Errors::get_error($_GET["error"]);
    ?>
    <div class="mensaje mensaje-error"><?php echo($error); ?></div>
    <div class="relleno"></div>
    <?php
}
?>

<form action="validar_nueva_cita.php" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">Registrar nueva cita</div>
        <div class="panel-body">
            <div class="mensaje mensaje-info">
                ( Para el paquete de 10 consultas, escriba: paquete10 )
            </div>

            <table>
                <tr>
                    <td>ID de la cita:</td>
                    <?php
                    $id_paciente = $_GET["id"];

                    $sql = "SELECT id_paciente FROM paciente WHERE id_paciente = $id_paciente;";
                    $resultado = $bd->query($sql);
                    $registro = $resultado->fetch_array();
                    if (count($registro) == 0) {
                        Errors::mostrar_error("nueva_cita.php", 3);
                    }

                    $sql = "SELECT MAX(id_cita)+1 AS id FROM citas;";
                    $resultado = $bd->query($sql);
                    $registro = $resultado->fetch_array();

                    $id_actual = 1;

                    if (sizeof($registro["id"]) > 0) {
                        $id_actual = $registro["id"];
                    }

                    $sql2 = "SELECT CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS paciente "
                            . "FROM paciente "
                            . "WHERE id_paciente = $id_paciente;";
                    $resultado2 = $bd->query($sql2);
                    $registro2 = $resultado2->fetch_array();

                    $paciente = $registro2["paciente"];
                    ?>
                    <td><input type="text" name="id_cita" size="30" class="form-control" value="<?php echo($id_actual); ?>" readonly class="readonly"></td>
                </tr>
                <tr>
                    <td>Paciente:</td>
                    <td><input type="text" name="paciente" size="30" class="form-control" value="<?php echo($paciente); ?>" readonly class="readonly"></td>
                </tr>
                <tr>
                    <td>ID del Paciente:</td>
                    <td><input type="text" name="id_paciente" size="30" class="form-control" value="<?php echo($id_paciente); ?>" readonly class="readonly"></td>
                </tr>
                <tr>
                    <td>Especialista:</td>
                    <td>
                        <?php
                        $sql3 = "SELECT id, CONCAT(nombre, ' ', apellidos) as nombre FROM usuarios_sistema WHERE tipo_usuario LIKE 'FISIOTERAPEUTA';";

                        $resultado3 = $bd->query($sql3);

                        if ($resultado3) {
                            if ($resultado3->num_rows > 0) {
                                ?>
                                <select name="especialista" class="form-control">
                                    <?php
                                    while ($registro3 = $resultado3->fetch_array()) {
                                        $bd_nombre_especialista = $registro3["nombre"];
                                        $bd_id_especialista = $registro3["id"];
                                        ?>
                                        <option value="<?php echo($bd_id_especialista); ?>"><?php echo($bd_nombre_especialista); ?></option>
                                        <?php
                                    }
                                    $bd->close();
                                    ?>
                                </select>
                                <?php
                            } else {
                                ?>
                                <div class="mensaje mensaje-error"><?php echo(Errors::get_error(99)); ?></div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="mensaje mensaje-error"><?php echo(Errors::get_error(99)); ?></div>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Especialidad:</td>
                    <td>
                        <select name="especialidad" class="form-control">
                            <option value="Enfermería">Enfermería</option>
                            <option value="Fisioterapia">Fisioterapia</option>
                            <option value="Medicina general">Medicina general</option>
                            <option value="Nutrición">Nutrición</option>
                            <option value="Pediatría">Pediatría</option>
                            <option value="Psicología">Psicología</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Área:</td>
                    <td>
                        <select name="area" class="form-control">
                            <option value="Hidro">Hidro</option>
                            <option value="Mecano">Mecano</option>
                            <option value="Electro">Electro</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Importe:</td>
                    <td><input type="text" name="pago" size="30" class="form-control"></td>
                </tr>
                <tr>
                    <td>Paquete:</td>
                    <td><input type="text" name="paquete" size="30" class="form-control"></td>
                </tr>
                <tr>
                    <td>Fecha:</td>
                    <?php
                    $hoy = FechaHora::hoy();
                    ?>
                    <td><input type="date" name="fecha" value="<?php echo($hoy); ?>" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Hora:</td>
                    <td><input type="time" name="hora" value="12:00" class="form-control"></td>
                </tr>
            </table>
            <div class="relleno"></div>
            <input type="button" value="Cancelar" class="btn btn-primary" onclick="location.href = 'nueva_cita.php'">
            <input type="reset" value="Restablecer" class="btn btn-primary">
            <input type="submit" value="Registrar" class="btn btn-primary">
        </div>
    </div>
</form>

<?php
require('./includes/footer.php');
