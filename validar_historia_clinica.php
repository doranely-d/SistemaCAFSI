<?php
require('./includes/header.php');
require('./includes/conexion.php');
?>


<h2 class="text-center">Validar cambios de la Historia Clínica</h2><br>

<?php
$id_historia_clinica = $_POST["id_historia_clinica"];
$id_paciente = $_POST["id_paciente"];
$motivo_consulta = $_POST["motivo_consulta"];
$antecedentes_heredofamiliares = $_POST["antecedentes_heredofamiliares"];
$tratamientos_afines = $_POST["tratamientos_afines"];
$antecedentes_personales_patologicos = $_POST["antecedentes_personales_patologicos"];
$conocimiento_entorno = $_POST["conocimiento_entorno"];
$inspeccion_global = $_POST["inspeccion_global"];
$inspeccion_local = $_POST["inspeccion_local"];
$problema_fisioterapeutico = $_POST["problema_fisioterapeutico"];
$programa_fisioterapeutico = $_POST["programa_fisioterapeutico"];
$diagnostico_funcional = $_POST["diagnostico_funcional"];
$exploracion_fisica = $_POST["exploracion_fisica"];
$plan_intervencion = $_POST["plan_intervencion"];
$pronostico = $_POST["pronostico"];
$hoja_evaluacion = $_POST["hoja_evaluacion"];

$sql = "UPDATE historial_clinico_general SET 
            motivo_consulta = '$motivo_consulta', 
            antecedentes_heredofamiliares = '$antecedentes_heredofamiliares' ,
            tratamientos_afines = '$tratamientos_afines', 
            antecedentes_personales_patologicos = '$antecedentes_personales_patologicos', 
            conocimiento_entorno = '$conocimiento_entorno', 
            inspeccion_global = '$inspeccion_global', 
            inspeccion_local = '$inspeccion_local', 
            problema_fisio = '$problema_fisioterapeutico', 
            programa_fisio = '$programa_fisioterapeutico', 
            diagnostico_funcional = '$diagnostico_funcional',
            exploracion_fisica = '$exploracion_fisica', 
            plan_intervencion = '$plan_intervencion', 
            pronostico = '$pronostico', 
            hoja_evaluacion = '$hoja_evaluacion' 
        WHERE id_historial_general = $id_historia_clinica AND id_paciente = id_paciente";
$resultado = $bd->query($sql);

if ($resultado) {
    $sql = "SELECT marked FROM historial_clinico_general WHERE id_paciente = $id_paciente;";
    $resultado = $bd->query($sql);
    $registro = $resultado->fetch_array();
    $marked = $registro["marked"];
    if ($marked == 0) {
        $sql = "UPDATE historial_clinico_general SET marked = 1 WHERE id_paciente = $id_paciente";
        $resultado = $bd->query($sql);
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <p class="mensaje mensaje-ok">Los cambios se han realizado correctamente.</p>
        </div>
    </div>
    <?php
    $bd->close();
} else {
    ?> <div class="mensaje_error"><?php echo($bd->error); ?></div><?php
}
?>
<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">
<?php
require('./includes/footer.php');
