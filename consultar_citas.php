<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/fecha_hora.php');
?>


<h2 class="text-center">Consultar citas</h2><br>

<form action="mostrar_citas_consultadas.php" method="post" id="login">
  <div class="panel panel-default">
     <div class="panel-heading">En un rango de fechas</div>
        <div class="panel-body">
            <table>
                <tr>
                    <td>Desde:</td>
                    <?php
                    $hoy = FechaHora::hoy();
                    ?>
                    <td><input type="date" name="desde" value="<?php echo($hoy) ?>" class="form-control" required></td>
                    <td>Hasta:</td>
                    <td><input type="date" name="hasta" value="<?php echo($hoy) ?>"class="form-control"  required></td>
                </tr>
            </table>
            <div class="relleno"></div>
            <input type="reset" value="Restablecer" class="btn btn-primary"> 
            <input type="submit" value="Consultar" class="btn btn-primary">
        </div>
    </div>
</form>

<form action="mostrar_citas_consultadas.php" method="post" id="login">
    <div class="panel panel-default">
     <div class="panel-heading">Citas del día de hoy:</div>
        <div class="panel-body">
            <table>
                <tr>
                    <?php
                    $fecha = FechaHora::dia(date("l")) . " " . date("j") . " de " .
                                FechaHora::mes(date("F")) . " de " . date("Y");
                    ?>
                    <td>Registro para hoy <?php echo($fecha); ?>:</td>
                    <td><input type="submit" value="Consultar" class="btn btn-primary"></td>
                </tr>
            </table>
       </div>
    </div>
</form>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php
require('./includes/footer.php');
