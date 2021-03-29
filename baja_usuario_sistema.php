<?php
require('./includes/header.php');
require('./includes/errors.php');
?>

<h2 class="text-center">Baja de usuario del sistema</h2><br>

<div class="panel panel-default">
    <div class="panel-heading">Lista de usuarios</div>
    <div class="panel-body">
        <div class="mensaje mensaje-info">
            Seleccione el usuario al cual dar de baja:
        </div>

        <?php
        require('./includes/conexion.php');

        $sql = "SELECT * FROM usuarios_sistema;";
        $resultado = $bd->query($sql);

        if ($resultado) {
            if ($resultado->num_rows > 0) {
                ?>
                <form action="eliminar_usuario" method="post">
                    <table border="1" class="tabla2">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Tipo de usuario</th>
                            <th>¿Dar de baja?</th>
                        </tr>
                        <?php
                        while ($row = $resultado->fetch_array()) {
                            $bd_id = $row["id"];
                            $usuario = $row["nombre"] . " " . $row["apellidos"];
                            $bd_contrasena = $row["contrasena"];
                            $bd_tipo_usuario = $row["tipo_usuario"];

                            if (strcmp($bd_tipo_usuario, "ADMINISTRADOR") == 0) {
                                continue;
                            }
                            ?>
                            <tr>
                                <td><?php echo($bd_id); ?></td>
                                <td><?php echo($usuario); ?></td>
                                <td><?php echo($bd_contrasena); ?></td>
                                <td><?php echo($bd_tipo_usuario); ?></td>
                                <td><input type="button" value="Dar de baja" class="btn btn-primary" onclick="location.href = 'eliminar_usuario_sistema.php?id=<?php echo($bd_id); ?>'"</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </form>
                <?php
                $bd->close();
            } else {
                ?>
                <p class="mensaje mensaje-error"><?php echo(Errors::get_error(99)); ?></p>
                <?php
            }
        } else {
            ?>
            <p class="mensaje mensaje-error"><?php echo(Errors::get_error(99)); ?></p>
            <?php
        }
        ?>
    </div>
</div>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php require('./includes/footer.php');
