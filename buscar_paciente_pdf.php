<?php
require('./includes/header.php');
require('./includes/errors.php');
?>

<!--Título e instrucciones de la página sin recibir los cambios-->
<h2 class="text-center">Generar documento de paciente</h2><br>

<script type="text/javascript">
    function buscarPorID() {
        var id = document.getElementById("id").value;
        if (id.toString() !== "") {
            window.open('generar_pdf.php?id=' + id, '_blank');
        } else {
            alert("Por favor ingrese un ID antes de continuar.");
        }
    }
</script>

<form action="buscar_paciente_pdf.php" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">Buscar paciente</div>
        <div class="panel-body">

            <div class="mensaje mensaje-info">
                Ingrese uno o más datos del paciente para buscar:
            </div>

            <!--Mostrar mensaje de error si existiera-->
            <?php
            if (isset($_GET["error"])) {
                $error = Errors::get_error($_GET["error"]);
                ?>
                <div class="mensaje mensaje-error"><?php echo($error); ?></div>
                <?php
            }
            ?>

            <table>
                <tr>
                    <td>Por nombre del paciente:</td>
                    <td><input type="text" name="nombre" size="30" class="form-control"></td>
                    <td><input type="submit" name="submit" value="Buscar" class="btn btn-primary"></td>
                </tr>
                <tr>
                    <td>Por apellido del paciente:</td>
                    <td><input type="text" name="apellido" size="30" class="form-control"></td>
                    <td><input type="submit" name="submit" value="Buscar" class="btn btn-primary"></td>
                </tr>
                <tr>
                    <td>Por id del paciente:</td>
                    <td><input type="text" id="id" size="30" class="form-control"></td>
                    <td><input type="button" value="Buscar" class="btn btn-primary" onclick="buscarPorID()"></td>
                </tr>
            </table>

            <div class="relleno"></div>
            <input type="button" value="Cancelar" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">
            <input type="reset" value="Restablecer" class="btn btn-primary">
        </div>
    </div>
</form>

<?php
if (isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    require('./includes/conexion.php');

    $sql = "SELECT id_paciente, CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS paciente, "
            . "DATE_FORMAT(fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento, hipertension FROM paciente WHERE ";

    if (empty($nombre) && empty($apellido)) {
        Errors::mostrar_error("buscar_paciente_pdf.php", 6);
    } elseif (empty($apellido)) {
        $sql .= "nombre LIKE '%$nombre%';";
    } elseif (empty($nombre)) {
        $sql .= "ap_paterno LIKE '%$apellido%' OR ap_materno LIKE '%$apellido%';";
    } else {
        $sql .= "nombre LIKE '%$nombre%' OR ap_paterno LIKE '%$apellido%' OR ap_materno LIKE '%$apellido%';";
    }

    $resultado = $bd->query($sql);

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Lista de pacientes</div>
                <div class="panel-body">
                    <div class="mensaje mensaje-info">
                        Se encontraron los siguientes pacientes:
                    </div>
                    <table border="1" class="tabla2">
                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Fecha de naciemiento</th>
                            <th>Documento</th>
                        </tr>
                        <?php
                        while ($registro = $resultado->fetch_array()) {
                            $bd_id_paciente = $registro["id_paciente"];
                            $bd_paciente = $registro["paciente"];
                            $bd_fecha_nacimiento = $registro["fecha_nacimiento"];
                            $hipertension = $registro["hipertension"];
                            ?>
                            <tr style="background-color: <?php echo($hipertension == 1? "orange" : "white") ?>">
                                <td><?php echo($bd_id_paciente); ?></td>
                                <td><?php echo($bd_paciente); ?></td>
                                <td><?php echo($bd_fecha_nacimiento); ?></td>
                                <td><input type="button"  class="btn btn-primary" value="Generar..." onclick="window.open('generar_pdf.php?id=<?php echo($bd_id_paciente); ?>', '_blank');"></td>
                            </tr>
                            <?php
                        }
                        $bd->close();
                        ?>
                    </table>
                </div>
            </div>
            <div class="relleno"></div>
            <input type="button" value="Regresar al menú principal" onclick="location.href = 'menu_principal.php'" class="btn btn-primary">
            <?php
        } else {
            Errors::mostrar_error("asistencia_paciente.php", 4);
        }
    } else {
        Errors::mostrar_error("asistencia_paciente.php", 100);
    }
}
?>

<?php
require('./includes/footer.php');
