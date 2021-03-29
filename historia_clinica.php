<?php
require('./includes/header.php');
require('./includes/conexion.php');
require('./includes/fecha_hora.php');
require('./includes/errors.php');
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.show_hide1').click(function() {
            $('.tags_check1').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide2').click(function() {
            $('.tags_check2').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide3').click(function() {
            $('.tags_check3').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide4').click(function() {
            $('.tags_check4').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide5').click(function() {
            $('.tags_check5').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide6').click(function() {
            $('.tags_check6').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide7').click(function() {
            $('.tags_check7').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide8').click(function() {
            $('.tags_check8').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide9').click(function() {
            $('.tags_check9').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide10').click(function() {
            $('.tags_check10').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide11').click(function() {
            $('.tags_check11').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide12').click(function() {
            $('.tags_check12').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide14').click(function() {
            $('.tags_check14').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide15').click(function() {
            $('.tags_check15').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide16').click(function() {
            $('.tags_check16').toggle();
        });
    });
    $(document).ready(function() {
        $('.show_hide17').click(function() {
            $('.tags_check17').toggle();
        });
    });
</script>


<h2 class="text-center">Historia Clínica</h2><br>

<?php
$paciente = $_GET["paciente"];

$sql = "SELECT id_paciente FROM paciente WHERE id_paciente = $paciente;";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();
if (count($registro) == 0) {
    Errors::mostrar_error("consultar_paciente.php", 3);
}

$tipo_usuario = $_SESSION["tipo_usuario"];
?>

<?php
$sql = "SELECT id_historial_general AS id FROM historial_clinico_general WHERE id_paciente = $paciente;";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();
$id = $registro["id"];
?>
<form action="validar_historia_clinica.php" method="post" class="historial_clinico">
    <div class="panel panel-default">
        <div class="panel-heading">Datos del paciente</div>
        <div class="panel-body">
            <!--Encabezado-->
            <table>
                <tr>
                    <th>
                        No. de expediente: 
                    </th>
                    <th>
                        <input type="text" class="form-control" name="id_historia_clinica" value="<?php echo($id) ?>" size="20" readonly>
                        </td>
                    <th>
                        Fecha : 
                    </th>
                    <td>
                        <input type="text" class="form-control" value="<?php echo(FechaHora::hoyl()) ?>" size="20" readonly>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <?php
    // Se obtienen los datos de Ficha de identificación
    $sql = "SELECT *, year(curdate()) - year(fecha_nacimiento) + if (date_format(curdate(), '%m-%d') > date_format(fecha_nacimiento, '%m-%d'), 0, 1) AS edad 
        FROM paciente p 
        JOIN domicilio d ON (p.id_domicilio = d.id_domicilio)
        WHERE p.id_paciente = $paciente";
    $resultado = $bd->query($sql);
    $registro = $resultado->fetch_array();

    $nombre = $registro["nombre"] . " " . $registro["ap_paterno"] . " " . $registro["ap_materno"];
    $fecha_nacimiento = $registro["fecha_nacimiento"];
    $edad = $registro["edad"];
    $sexo = $registro["sexo"];
    $ocupacion = $registro["ocupacion"];
    $estado_civil = $registro["estado_civil"];
    $telefono = $registro["telefono"];
    $correo_electronico = $registro["correo_electronico"];
    $hipertension = $registro["hipertension"];
    $domicilio = $registro["calle"] . " " . $registro["numero"];
    $colonia = $registro["colonia"];
    $localidad = $registro["localidad"];
    $codigo_postal = $registro["codigo_postal"];
    $municipio = $registro["municipio"];
    $estado = $registro["estado"];
    $observaciones = $registro["observaciones"];

    // Se obtienen los datos de los signos vitales    
    $sql = "SELECT a.id_signos_vitales, a.frecuencia_cardiaca, a.tension_arterial, a.frecuencia_respiratoria, a.temperatura, a.peso, a.estatura, a.IMC, a.id_cita
            FROM signos_vitales a JOIN citas b ON (a.id_cita = b.id_cita) 
            WHERE b.fecha = (SELECT MIN(fecha) FROM citas WHERE id_paciente = $paciente)";
    $resultado = $bd->query($sql);
    $registro = $resultado->fetch_array();

    $resultado = $bd->query($sql);
    $registro = $resultado->fetch_array();
    $frecuencia_cardiaca = $registro["frecuencia_cardiaca"];
    $tension_arterial = $registro["tension_arterial"];
    $frecuencia_respiratoria = $registro["frecuencia_respiratoria"];
    $temperatura = $registro["temperatura"];
    $peso = $registro["peso"];
    $estatura = $registro["estatura"];
    $imc = round($registro["IMC"], 2);
    ?>

    <!--Ficha de identificación-->
    <div class="panel panel-default">
        <div class="panel-heading show_hide1 ">Ficha de identificación</div>
        <div class="panel-body">
            <div class="tags_check1">
                <input type="hidden" name="id_paciente" value="<?php echo($paciente) ?>">
                <label>Nombre: </label><input type="text" value="<?php echo($nombre) ?>" size="30" readonly>
                <label>Fecha nacimiento: </label><input type="text" value="<?php echo($fecha_nacimiento) ?>" size="10" readonly>
                <label>Edad: </label><input type="text" value="<?php echo($edad) ?>" size="5" readonly>
                <br />
                <label>Sexo: </label><input type="text" value="<?php echo($sexo) ?>" size="10" readonly>
                <label>Estatura: </label><input type="text" value="<?php echo($estatura) ?>" size="10" readonly>
                <label>Peso: </label><input type="text" value="<?php echo($peso) ?>" size="10" readonly>
                <label>IMC: </label><input type="text" value="<?php echo($imc) ?>" size="10" readonly>
                <br />
                <label>Ocupación: </label><input type="text" value="<?php echo($ocupacion) ?>" size="30" readonly>
                <label>Estado civil: </label><input type="text" value="<?php echo($estado_civil) ?>" size="10" readonly>
                <br />
                <label>Domicilio actual: </label><input type="text" value="<?php echo($domicilio) ?>" size="20" readonly>
                <label>Colonia: </label><input type="text" value="<?php echo($colonia) ?>" size="15" readonly>
                <br />
                <label>Localidad: </label><input type="text" value="<?php echo($localidad) ?>" size="15" readonly>
                <label>C.P.: </label><input type="text" value="<?php echo($codigo_postal) ?>" size="5" readonly>
                <label>Municipio: </label><input type="text" value="<?php echo($municipio) ?>" size="15" readonly>
                <label>Estado: </label><input type="text" value="<?php echo($estado) ?>" size="15" readonly>
                <br />
                <label>Teléfono: </label><input type="text" value="<?php echo($telefono) ?>" size="15" readonly>
                <label>Correo electrónico: </label><input type="text" value="<?php echo($correo_electronico) ?>" size="20" readonly>
                <br />
                <label>Observaciones: </label><textarea rows="5" cols="30" readonly><?php echo($observaciones) ?></textarea>
            </div>
        </div>
    </div>
    
    <br/>
    
    <!--Signos vitales-->
    <div class="panel panel-default">
        <div class="panel-heading show_hide2 cur">Signos vitales</div>
        <div class="panel-body">
            <div class="tags_check2">
                <table>
                    <tr>
                        <td>Frecuencia cardiaca:
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?php echo($frecuencia_cardiaca) ?>" size="10" readonly>
                        </td>
                        <td>Frecuencia respiratoria:
                        </td>
                        <td><input type="text" class="form-control" value="<?php echo($frecuencia_respiratoria) ?>" size="10" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Tensión arterial:
                        </td>
                        <td><input type="text" class="form-control" value="<?php echo($tension_arterial) ?>" size="10" readonly></td>
                        <td>Temperatura:
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?php echo($temperatura) ?>" size="10" readonly>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <?php
    $sql = "SELECT * FROM historial_clinico_general WHERE id_historial_general = $id";
    $resultado = $bd->query($sql);
    $registro = $resultado->fetch_array();
    $motivo_consulta = $registro["motivo_consulta"];
    $antecedentes_heredofamiliares = $registro["antecedentes_heredofamiliares"];
    $tratamientos_afines = $registro["tratamientos_afines"];
    $antecedentes_personales_patologicos = $registro["antecedentes_personales_patologicos"];
    $conocimiento_entorno = $registro["conocimiento_entorno"];
    $inspeccion_global = $registro["inspeccion_global"];
    $inspeccion_local = $registro["inspeccion_local"];
    $problema_fisioterapeutico = $registro["problema_fisio"];
    $programa_fisioterapeutico = $registro["programa_fisio"];
    $diagnostico_funcional = $registro["diagnostico_funcional"];
    $exploracion_fisica = $registro["exploracion_fisica"];
    $plan_intervencion = $registro["plan_intervencion"];
    $pronostico = $registro["pronostico"];
    $hoja_evaluacion = $registro["hoja_evaluacion"];
    ?>

    <br />

    <?php
    $sql = "SELECT marked FROM historial_clinico_general WHERE id_paciente =  $paciente;";
    $resultado = $bd->query($sql);
    $registro = $resultado->fetch_array();
    $marked = $registro["marked"];
    $readonly = "";
    if ($marked == 1) {
        $readonly = "readonly";
    }
    ?>
    
    <!--Motivo de consulta-->
    <div class="panel panel-default show_hide3 cur">
        <div class="panel-heading  ">Motivo de consulta</div>
    </div>
    <div class="panel-body">
        <div class="tags_check3">
            <textarea class="form-control" name="motivo_consulta" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($motivo_consulta) ?></textarea>
        </div>
    </div>
    
    <br />
    
    <!--Antecedentes personales patológicos-->
    <div class="panel panel-default show_hide6 cur">
        <div class="panel-heading ">Antecedentes personales patológicos</div>
    </div>
    <div class="panel-body">
        <div class="tags_check6">
            <textarea  class="form-control" name="antecedentes_personales_patologicos" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($antecedentes_personales_patologicos) ?></textarea>
        </div>
    </div>
    
    <br />
    
    <!--Tratamientos afines y farmacológicos-->
    <div class="panel panel-default show_hide5 cur">
        <div class="panel-heading ">Tratamientos afines y farmacológicos</div>
    </div>
    <div class="panel-body">
        <div class="tags_check5">
            <textarea  class="form-control" name="tratamientos_afines" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($tratamientos_afines) ?></textarea>
        </div>
    </div>
    
    <br />
    
    <!--Antecedentes heredofamiliares-->
    <div class="panel panel-default show_hide4 cur">
        <div class="panel-heading ">Antecedentes heredofamiliares</div>
    </div>
    <div class="panel-body">
        <div class="tags_check4">
            <textarea   class="form-control" name="antecedentes_heredofamiliares" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($antecedentes_heredofamiliares) ?></textarea>
        </div>
    </div>

    <br />
  
    <!--Conocimiento del entorno (Medio labooral, físico-ambiental y socio-cultural-->
    <div class="panel panel-default show_hide7 cur">
        <div class="panel-heading ">Conocimiento del entorno (Medio labooral, físico-ambiental y socio-cultural)</div>
    </div>
    <div class="panel-body">
        <div class="tags_check7">
            <textarea  class="form-control" name="conocimiento_entorno" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($conocimiento_entorno) ?></textarea>
        </div>
    </div>

    <br />
    
    <!--Inspección global-->
    <div class="panel panel-default show_hide8 cur">
        <div class="panel-heading ">Inspección global</div>
    </div>
    <div class="panel-body">
        <div class="tags_check8">
            <textarea  class="form-control" name="inspeccion_global" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($inspeccion_global) ?></textarea>
        </div>
    </div>

    <br />
    
    <!--Inspección local-->
    <div class="panel panel-default show_hide9 cur">
        <div class="panel-heading ">Inspección local</div>
    </div>
    <div class="panel-body">
        <div class="tags_check9">
            <textarea class="form-control"  name="inspeccion_local" cols="100" rows="10"><?php echo($inspeccion_local) ?></textarea>
        </div>
    </div>
    
    <!--Exploración física-->
    <div class="panel panel-default show_hide14 cur">
        <div class="panel-heading ">Exploración física</div>
    </div>
    <div class="panel-body">
        <div class="tags_check14">
            <textarea  class="form-control" name="exploracion_fisica" cols="100" rows="10"><?php echo($exploracion_fisica) ?></textarea>
        </div>
    </div>
    
    <br />

    <!--Problema Fisoterapéutico-->
    <div class="panel panel-default show_hide10 cur">
        <div class="panel-heading ">Problema Fisoterapéutico</div>
    </div>
    <div class="panel-body">
        <div class="tags_check10">
            <textarea class="form-control" name="problema_fisioterapeutico" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($problema_fisioterapeutico) ?></textarea>
        </div>
    </div>

    <br />
    
    <!--Programa de intervención por objetivo-->
    <div class="panel panel-default show_hide11 cur">
        <div class="panel-heading ">Programa de intervención por objetivo</div>
    </div>
    <div class="panel-body">
        <div class="tags_check11">
            <textarea class="form-control" name="programa_fisioterapeutico" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($programa_fisioterapeutico) ?></textarea>
        </div>
    </div>

    <br />
    
    <!--Diagnóstico Funcional-->
    <div class="panel panel-default show_hide12 cur">
        <div class="panel-heading ">Diagnóstico Funcional</div>
    </div>
    <div class="panel-body">
        <div class="tags_check12">
            <textarea class="form-control" name="diagnostico_funcional" cols="100" rows="10"><?php echo($diagnostico_funcional) ?></textarea>
        </div>
    </div>
    
    <br />
    
    <!--Pronóstico-->
    <div class="panel panel-default show_hide16 cur">
        <div class="panel-heading ">Pronósitco</div>
    </div>
    <div class="panel-body">
        <div class="tags_check16">
            <textarea class="form-control" name="pronostico" cols="100" rows="10" <?php echo($readonly) ?>><?php echo($pronostico) ?></textarea>
        </div>
    </div>
        
    <br />
    
    <!--Plan de intervención-->
    <div class="panel panel-default show_hide15 cur">
        <div class="panel-heading ">Plan de intervención</div>
    </div>
    <div class="panel-body">
        <div class="tags_check15">
            <textarea class="form-control" name="plan_intervencion" cols="100" rows="10"><?php echo($plan_intervencion) ?></textarea>
        </div>
        
    </div>
    
    <!--Notas de evaluación-->
    <div class="panel panel-default show_hide17 cur">
        <div class="panel-heading ">Notas de evaluación</div>
    </div>
    <div class="panel-body">
        <div class="tags_check17">
            <textarea class="form-control" name="hoja_evaluacion" cols="100" rows="50"><?php echo($hoja_evaluacion) ?></textarea>
        </div>
    </div>

    <br /><br />
    
    <input type="button" value="Regresar" class="btn btn-primary" onclick="location.href='consultar_paciente.php'"> 
    <input type="reset" value="Restablecer" class="btn btn-primary"> 
    <input type="submit" value="Guardar" class="btn btn-primary">
</form>

<script type="text/javascript">
    $('.tags_check2').toggle();
    $('.tags_check3').toggle();
    $('.tags_check4').toggle();
    $('.tags_check5').toggle();
    $('.tags_check6').toggle();
    $('.tags_check7').toggle();
    $('.tags_check8').toggle();
    $('.tags_check9').toggle();
    $('.tags_check10').toggle();
    $('.tags_check11').toggle();
    $('.tags_check12').toggle();
    $('.tags_check14').toggle();
    $('.tags_check15').toggle();
    $('.tags_check16').toggle();
    $('.tags_check17').toggle();
</script>

<?php require('./includes/footer.php'); ?>