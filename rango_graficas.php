<?php
require('./includes/header.php');
require('./includes/errors.php');
require('./includes/fecha_hora.php');
?>

<h2 class="text-center">Gráficas</h2><br>

<div class="panel panel-default">
    <div class="panel-heading">Periodo para las gráficas</div>
    <div class="panel-body">
        <div class="mensaje mensaje-info">
          Seleccione el periodo para realizar las gráficas:
        </div>
        <table border="0">
            <tr>
                <td>
                    <label>Mensual: </label>
                </td>
                <td>
                    <input type="button" value="Ver gráfica" onclick="location.href = 'graficas.php?type=1'" class="btn btn-primary">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Quincena: </label>
                </td>
                <td>
                    <input type="button" value="Ver gráfica" onclick="location.href = 'graficas.php?type=2'" class="btn btn-primary">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Semanal: </label>
                </td>
                <td>
                    <input type="button" value="Ver gráfica" onclick="location.href = 'graficas.php?type=3'" class="btn btn-primary">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Para el día de hoy: </label>
                </td>
                <td>
                    <input type="button" value="Ver gráfica"  onclick="location.href = 'graficas.php?type=4'" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="relleno"></div>
<input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">

<?php
require('./includes/footer.php');
