<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/conexion.php');

$id = $_GET["id"];
$sql = "DELETE FROM usuarios_sistema WHERE id = $id;";
$resultado = $bd->query($sql);

if ($resultado) {
    ?>
    <h2 class="text-center">Eliminar usuario del sistema</h2><br />
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <p class="mensaje-ok">El usuario se ha eliminado correctamente.</p>
        </div>
    </div>
    <?php
} else {
    Errors::mostrar_error("eliminar_usuario_sistema.php", $bd->errno);
}

$bd->close();
?>
<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php
require('./includes/footer.php');
