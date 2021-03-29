<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/conexion.php');

$id = addslashes($_POST["id"]);
$nombre = addslashes($_POST["nombre"]);
$apellidos = addslashes($_POST["apellidos"]);
$contrasena = addslashes($_POST["contrasena"]);
$tipo_usuario = addslashes($_POST["tipo_usuario"]);

$sql = "INSERT INTO usuarios_sistema (id,nombre,apellidos,contrasena,tipo_usuario) "
        . "VALUES ($id,'$nombre','$apellidos','$contrasena','$tipo_usuario');";
$resultado = $bd->query($sql);

if ($resultado) {
    ?>
    <h2 class="text-center">Agregar usuario del sistema</h2><br />
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <p class="mensaje-ok">El usuario se ha agregado correctamente.</p>
        </div>
    </div>
    <?php
} else {
    Errors::mostrar_error("nuevo_usuario_sistema.php", $bd->errno);
}

$bd->close();
?>
<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php
require('./includes/footer.php');
