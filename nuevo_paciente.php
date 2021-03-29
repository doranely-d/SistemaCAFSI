<?php require('./includes/header.php'); ?>


<h2 class="text-center">Registro de pacientes</h2><br>

<?php
if (isset($_GET["error"])) {
    $error = Errors::get_error($_GET["error"]);
    ?>
    <div class="mensaje mensaje-error">
    <?php echo($error); ?><div>
    <?php
}
?>

<form action="validar_nuevo_paciente.php" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">Datos generales</div>
        <div class="panel-body">
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" name="nombre" size="30" class="form-control" required></td>
            </tr>
            <tr>
                <td>Apellido paterno:</td>
                <td><input type="text" name="apellido_paterno" size="30" class="form-control" required></td>
            </tr>
            <tr>
                <td>Apellido materno:</td>
                <td><input type="text" name="apellido_materno" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Fecha de nacimiento:</td>
                <td><input type="date" name="fecha_nacimiento" value="1990-01-01" class="form-control" required></td>
            </tr>
            <tr>
                <td>Sexo:</td>
                <td>
                    <input type="radio" name="sexo" value="femenino" checked>Femenino
                    <input type="radio" name="sexo" value="masculino">Masculino
                </td>
            </tr>
            <tr>
                <td>Ocupación:</td>
                <td><input type="text" name="ocupacion" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Estado civil:</td>
                <td>
                    <select name="estado_civil" class="form-control">
                        <option value="soltero">Soltero</option>
                        <option value="casado">Casado</option>
                        <option value="divorciado">Divorciado</option>
                        <option value="viudo">Viudo</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Teléfono:</td>
                <td><input type="text" name="telefono" size="30" maxlength="10" class="form-control" ></td>
            </tr>
            <tr>
                <td>Correo electrónico:</td>
                <td><input type="email" name="email" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Calle:</td>
                <td><input type="text" name="calle" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Número:</td>
                <td><input type="text" name="numero" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Colonia:</td>
                <td><input type="text" name="colonia" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Localidad:</td>
                <td><input type="text" name="localidad" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Código postal:</td>
                <td><input type="text" name="codigo_postal" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Municipio:</td>
                <td><input type="text" name="municipio" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><input type="text" name="estado" size="30" class="form-control"></td>
            </tr>
            <tr>
                <td>Observaciones:</td>
                <td><textarea name="observaciones" rows="5" cols="30" class="form-control"></textarea></td>
            </tr>
        </table>
         </div>
    </div>
    <div class="panel panel-default">
    <div class="panel-heading">Contacto de emergencia</div>
     <div class="panel-body">
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" name="ce_nombre" size="30" class="form-control" required></td>
            </tr>
            <tr>
                <td>Teléfono:</td>
                <td><input type="text" name="ce_telefono" size="30" class="form-control" required></td>
            </tr>
            <tr>
                <td>Calle:</td>
                <td><input type="text" name="ce_calle" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Número:</td>
                <td><input type="text" name="ce_numero" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Colonia:</td>
                <td><input type="text" name="ce_colonia" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Localidad:</td>
                <td><input type="text" name="ce_localidad" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Código postal:</td>
                <td><input type="text" name="ce_codigo_postal" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Municipio:</td>
                <td><input type="text" name="ce_municipio" class="form-control" size="30"></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><input type="text" name="ce_estado" class="form-control" size="30"></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Especialista que lo atiende</div>
     <div class="panel-body">
        <table>
            <tr>
                <td>Nombre:</td>
                <td>
                    <?php
                    require('./includes/conexion.php');
                    require('./includes/errors.php');

                    $sql = "SELECT id, CONCAT(nombre, ' ', apellidos) as nombre FROM usuarios_sistema WHERE tipo_usuario LIKE 'FISIOTERAPEUTA';";

                    $resultado = $bd->query($sql);

                    if ($resultado) {
                        if ($resultado->num_rows > 0) {
                            ?>
                            <select name="especialista" class="form-control">
                                <?php
                                while ($registro = $resultado->fetch_array()) {
                                    $bd_id = $registro["id"];
                                    $bd_nombre = $registro["nombre"];
                                    ?>
                                    <option value="<?php echo($bd_id); ?>"><?php echo($bd_nombre); ?></option>
                                    <?php
                                }
                                $bd->close();
                                ?>
                            </select>
                            <?php
                        } else {
                            ?>
                            <div class="mensaje mensaje-error"><?php echo(Errors::get_error(98)); ?></div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="mensaje mensaje-error"><?php echo(Errors::get_error(98)); ?></div>
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
        </table>
      </div>
    </div>
    <div class="relleno"></div>
    <input type="button" value="Cancelar" class="btn btn-primary" onclick="location.href = 'menu_principal.php'">
    <input type="reset" value="Restablecer" class="btn btn-primary" > 
    <input type="submit" value="Registrar paciente" class="btn btn-primary" >
</form>

<?php require('./includes/footer.php'); ?>
