<?php
require('./includes/header.php');
require('./includes/errors.php');
?>

<h2 class="text-center">Alta de usuario al sistema</h2><br>

<div class="panel panel-default">
     <div class="panel-heading">Registrar usuario de sistema (especialista)</div>
    <div class="panel-body">
    <div class="mensaje mensaje-info">
        A continuación, llene todos los campos para dar de alta un nuevo usuario del sistema:
    </div>

<?php
if (isset($_GET["error"])) {
    $error = Errors::get_error($_GET["error"]);
    ?>
    <div class="mensaje mensaje-error"><?php echo($error); ?></div>
    <?php
}
?>

<form action="validar_nuevo_usuario_sistema.php" method="post">
    <table>
        <tr>
            <td>ID:</td>
            <td><input type="text" name="id" size="30" class="form-control" required></td>
        </tr>
        <tr>
            <td>Nombre:</td>
            <td><input type="text" name="nombre" size="30" class="form-control" required></td>
        </tr>
        <tr>
            <td>Apellidos:</td>
            <td><input type="text" name="apellidos" size="30" class="form-control" required></td>
        </tr>
        <tr>
            <td>Contraseña:</td>
            <td><input type="text" name="contrasena" size="30" class="form-control" required></td>
        </tr>
        <tr>
            <td>Tipo de usuario (especialidad):</td>
            <td>
                <select name="tipo_usuario" class="form-control">
                    <option value="RECEPCION">Recepción</option>
                    <option value="ENFERMERIA">Enfermería</option>
                    <option value="FISIOTERAPEUTA">Fisioterapeuta</option>
                    <option value="MEDICINA_GENERAL">Medicina general</option>
                    <option value="PEDIATRIA">Pediatría</option>
                    <option value="PSICOLOGIA">Psicología</option>
                </select>
            </td>
        </tr>
    </table>
    <div class="relleno"></div>
    <input type="button" value="Cancelar"  class="btn btn-primary" onclick="location.href='menu_principal.php'">
    <input type="reset" value="Restablecer" class="btn btn-primary">
    <input type="submit" value="Agregar usuario" class="btn btn-primary">
</form>

<?php require('./includes/footer.php'); ?>
