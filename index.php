<?php
require('./includes/header.php');
require('./includes/errors.php');
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="text-center">Acceso al sistema</h2></div>
    <div class="panel-body">
        <div class="mensaje mensaje-info">
            Bienvenido. Inicie sesión para acceder al sistema:
        </div>
        <br />
        <!--Mostrar mensaje de error si existiera-->
        <?php
        if (isset($_GET["error"])) {
            $error = Errors::get_error($_GET["error"]);
            ?>
            <p class="mensaje mensaje-error"><?php echo($error); ?></p>
            <?php
        }
        ?>
        <!--Formulario de inicio de sesión-->
        <form action="validar_login.php" class="form-signin" method="post" id="login">
            <table>
                <tr>
                    <td><input  class="form-control" type="text" name="id" size="15" placeholder="ID" required=""></td>
                </tr>
                <tr>
                    <td><input  class="form-control" type="password" name="contrasena" size="15" placeholder="Contraseña" required=""></td>
                </tr>
            </table>
            <div class="relleno"></div>
            <input type="reset" class="btn btn-primary" value="Restablecer" > 
            <input  class="btn btn-primary"type="submit" value="Entrar">
        </form>
    </div>
</div>
<?php
require('./includes/footer.php');
