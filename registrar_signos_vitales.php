<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/conexion.php');
?>

<h2 class="text-center">Registrar de  signos vitales</h2><br>

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

<!--
Script que calcula automáticamente el IMC de acuerdo al peso y estatura
introducidos.
-->
<script>
    function calcularIMC() {
        var peso = document.getElementById('peso').value;
        var estatura = document.getElementById('estatura').value;
        var imc = peso / (estatura * estatura);

        if (peso > 0 && estatura > 0)
            document.getElementById('imc').value = imc;
        else
            document.getElementById('imc').value = 0;
    }
</script>

<!--Formulario de inicio de sesión-->
<form action="validar_registro_signos_vitales.php" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">Datos del paciente</div>
        <div class="panel-body">
            <table>
                <?php
                $id = $_GET["paciente"];
                $cita = $_GET["cita"];

                $sql = "SELECT CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS paciente, " .
                        "year(curdate()) - year(fecha_nacimiento) + if (date_format(curdate(), '%m-%d') > date_format(fecha_nacimiento, '%m-%d'), 0, 1) AS edad " .
                        "FROM paciente WHERE id_paciente = $id;";
                $resultado = $bd->query($sql);
                $registro = $resultado->fetch_array();
                $paciente = $registro["paciente"];
                $edad = $registro["edad"];
                $bd->close();
                ?>
                <tr>
                    <td>ID de la cita:</td>
                    <td><input type="text" value="<?php echo($cita); ?>"  class="form-control"  name="cita" size="30" readonly></td>
                </tr>
                <tr>
                    <td>ID del paciente:</td>
                    <td><input type="text" value="<?php echo($id); ?>"  class="form-control" name="id_paciente" size="30" readonly></td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td><input type="text" value="<?php echo($paciente); ?>"  class="form-control" name="nombre_paciente" size="30" readonly></td>
                </tr>
                <tr>
                    <td>Edad:</td>
                    <td><input type="text" value="<?php echo($edad); ?>"  class="form-control" name="edad" size="30" readonly></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Signos vitales</div>
        <div class="panel-body">
            <table>
                <tr>
                    <td>Frecuencia cardiaca:</td>
                    <td><input type="text" name="frecuencia_cardiaca" size="30"  class="form-control" required></td>
                </tr>
                <tr>
                    <td>Frecuencia respiratoria:</td>
                    <td><input type="text" name="frecuencia_respiratoria" size="30"  class="form-control" required></td>
                </tr>
                <tr>
                    <td>Tensión arterial:</td>
                    <td><input type="text" name="tension_arterial" size="30" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Temperatura:</td>
                    <td><input type="text" name="temperatura" size="30" class="form-control" required></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Masa corporal</div>
        <div class="panel-body">
            <table>
                <tr>
                    <td>Peso:</td>
                    <td><input type="text" name="peso" id="peso" size="30"  class="form-control" onkeypress="calcularIMC()" placeholder="En kilogramos" required></td>
                </tr>
                <tr>
                    <td>Estatura:</td>
                    <td><input type="text" name="estatura" id="estatura"  class="form-control" size="30" onkeypress="calcularIMC()" placeholder="En metros" required></td>
                </tr>
                <tr>
                    <td>IMC:</td>
                    <td><input type="text" name="imc" value="0"  class="form-control" id="imc" size="30" readonly></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Hipertensión</div>
        <div class="panel-body">
            <input type="radio" name="hipertension" value="1">Sí
            <input type="radio" name="hipertension" value="0" checked>No
        </div>
    </div>
    <div class="relleno"></div>
    <input type="button" value="Regresar" class="btn btn-primary" onclick="location.href = 'buscar_paciente.php'">
    <input type="reset" value="Restablecer" class="btn btn-primary"> 
    <input type="submit" value="Registrar signos" class="btn btn-primary">
</form>

<?php
require('./includes/footer.php');
