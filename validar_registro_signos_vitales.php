<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/conexion.php');
?>

<h2 class="text-center">Registro de signos vitales</h2><br>

<?php
$id_paciente = $_POST["id_paciente"];
$id_cita = $_POST["cita"];
$frecuencia_cardiaca = $_POST["frecuencia_cardiaca"];
$frecuencia_respiratoria = $_POST["frecuencia_respiratoria"];
$tension_arterial = $_POST["tension_arterial"];
$temperatura = $_POST["temperatura"];
$peso = $_POST["peso"];
$estatura = $_POST["estatura"];
$imc = $_POST["imc"];
$hipertension = $_POST["hipertension"];

$sql = "INSERT INTO signos_vitales (id_signos_vitales, frecuencia_cardiaca, tension_arterial, frecuencia_respiratoria, temperatura, peso, estatura, IMC, id_cita) "
        . "VALUES (NULL, '$frecuencia_cardiaca', '$tension_arterial', '$frecuencia_respiratoria', '$temperatura', $peso, $estatura, $imc, $id_cita);";
$resultado = $bd->query($sql);
if ($resultado) {
    $sql = "UPDATE paciente SET hipertension = $hipertension WHERE id_paciente = $id_paciente;";
    $resultado = $bd->query($sql);
    if ($resultado) {
        ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="mensaje mensaje-ok">Los signos vitales se han registrado correctamente.</div>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <p class="mensaje mensaje-error"><?php echo("Error: " . $bd->error . ". Contacte al administrador"); ?></p>


    <?php
}

$bd->close();
?>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php
require('./includes/footer.php');

