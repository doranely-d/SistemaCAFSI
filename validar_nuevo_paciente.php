<?php
require('./includes/header.php');
require('./includes/conexion.php');
require('./includes/errors.php');
?>


<h2 class="text-center">Registrar nuevo paciente</h2><br>
<div class="panel panel-default">
    <div class="panel-body">

        <?php
// Datos del paciente
        $nombre = $_POST["nombre"];
        $apellido_paterno = $_POST["apellido_paterno"];
        $apellido_materno = $_POST["apellido_materno"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $sexo = $_POST["sexo"];
        $ocupacion = $_POST["ocupacion"];
        $estado_civil = $_POST["estado_civil"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];
        $calle = $_POST["calle"];
        $numero = $_POST["numero"];
        $colonia = $_POST["colonia"];
        $localidad = $_POST["localidad"];
        $codigo_postal = $_POST["codigo_postal"];
        $municipio = $_POST["municipio"];
        $estado = $_POST["estado"];
        $observaciones = $_POST["observaciones"];

// Datos del contacto de emergencia del paciente
        $ce_nombre = $_POST["ce_nombre"];
        $ce_telefono = $_POST["ce_telefono"];
        $ce_calle = $_POST["ce_calle"];
        $ce_numero = $_POST["ce_numero"];
        $ce_colonia = $_POST["ce_colonia"];
        $ce_localidad = $_POST["ce_localidad"];
        $ce_codigo_postal = $_POST["ce_codigo_postal"];
        $ce_municipio = $_POST["ce_municipio"];
        $ce_estado = $_POST["ce_estado"];

// Datos del médico que atiende al paciente
        if (!isset($_POST["especialista"])) {
            ?> <div class="mensaje mensaje-error"><?php echo(Errors::get_error(98)); ?></div><?php
            require('./includes/footer.php');
            die();
        }

        $especialista = $_POST["especialista"];
        $especialidad = $_POST["especialidad"];
        $area = $_POST["area"];


        $sql1 = "INSERT INTO domicilio (id_domicilio, calle, numero, colonia, localidad, codigo_postal, municipio, estado) "
                . "VALUES (NULL, '$ce_calle', '$ce_numero', '$ce_colonia', '$ce_localidad', '$ce_codigo_postal', '$ce_municipio', '$ce_estado');";
        $resultado1 = $bd->query($sql1);
        if ($resultado1) {
            $ce_id_domicilio = $bd->insert_id;
            $sql2 = "INSERT INTO contacto_emergencia (id_contacto, nombre, telefono, id_domicilio) "
                    . "VALUES (NULL, '$ce_nombre', '$ce_telefono', $ce_id_domicilio);";
            $resultado2 = $bd->query($sql2);
            if ($resultado2) {
                $id_contacto_emergencia = $bd->insert_id;
                $sql3 = "INSERT INTO domicilio (id_domicilio, calle, numero, colonia, localidad, codigo_postal, municipio, estado) "
                        . "VALUES (NULL, '$calle', '$numero', '$colonia', '$localidad', '$codigo_postal', '$municipio', '$estado');";
                $resultado3 = $bd->query($sql3);
                if ($resultado3) {
                    $id_domicilio = $bd->insert_id;
                    $sql4 = "INSERT INTO paciente (id_paciente, nombre, ap_paterno, ap_materno, fecha_nacimiento, sexo, ocupacion, estado_civil, telefono, correo_electronico, hipertension, id_especialista, id_domicilio, id_contacto, observaciones, especialidad, area) "
                            . "VALUES (NULL, '$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$sexo', '$ocupacion', '$estado_civil', '$telefono', '$email', '0', '$especialista', $id_domicilio, $id_contacto_emergencia, '$observaciones', '$especialidad', '$area');";
                    $resultado4 = $bd->query($sql4);
                    if ($resultado4) {
                        $id_paciente = $bd->insert_id;
                        $sql5 = "INSERT INTO historial_clinico_general (id_historial_general, id_paciente) 
                    VALUES (NULL, $id_paciente)";
                        $resultado5 = $bd->query($sql5);
                        if ($resultado4) {
                            ?>
                            <div class="mensaje mensaje-ok">El paciente se ha registrado correctamente.</div>
                            <?php
                            $bd->close();
                        } else {
                            ?> <div class="mensaje mensaje-error">Se encontró el siguiente error, por favor reportelo: <?php echo(Errors::get_error($bd->error)); ?></div><?php
                            require('./includes/footer.php');
                            die();
                        }
                    } else {
                        ?> <div class="mensaje mensaje-error">Se encontró el siguiente error, por favor reportelo: <?php echo(Errors::get_error($bd->error)); ?></div><?php
                        require('./includes/footer.php');
                        die();
                    }
                } else {
                    ?> <div class="mensaje mensaje-error">Se encontró el siguiente error, por favor reportelo: <?php echo(Errors::get_error($bd->error)); ?></div><?php
                    require('./includes/footer.php');
                    die();
                }
            } else {
                ?> <div class="mensaje mensaje-error">Se encontró el siguiente error, por favor reportelo: <?php echo(Errors::get_error($bd->error)); ?></div><?php
                require('./includes/footer.php');
                die();
            }
        } else {
            ?> <div class="mensaje mensaje-error">Se encontró el siguiente error, por favor reportelo: <?php echo(Errors::get_error($bd->error)); ?></div><?php
            require('./includes/footer.php');
            die();
        }
        ?>
    </div>
</div>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php
require("./includes/footer.php");
