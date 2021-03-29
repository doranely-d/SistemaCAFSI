<?php
require('./includes/header.php');
require('./includes/usuarios.php');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        
        <h2 class="text-center">Menú principal</h2>
    </div>
    <div class="panel-body">

        <?php
        $tipo_usuario = $_SESSION["tipo_usuario"];

        if (strcmp($tipo_usuario, "RECEPCION") == 0) {
            ?>
            <table>
                <tr>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'nuevo_paciente.php'">
                            <span class="grande glyphicon  glyphicon-user"  ></span>
                        </a>
                        <p>Registrar nuevo paciente</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'nueva_cita.php'">
                            <span class="grande glyphicon  glyphicon-list-alt" ></span>
                        </a>
                        <p>Registrar nueva cita</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'asistencia_paciente.php'">
                            <span class="grande glyphicon  glyphicon-edit" ></span>
                        </a>
                        <p>Registrar asistencia de paciente</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'consultar_citas.php'">
                            <span class="grande glyphicon  glyphicon-calendar" ></span>
                        </a>
                        <p>Consultar citas</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'buscar_paciente_pdf.php'">
                            <span class="grande glyphicon  glyphicon-file"  ></span>
                        </a>
                        <p>Generar documento de paciente</p>
                    </td>
                <tr>
            </table>
            <?php
        }
        if (strcmp($tipo_usuario, "ENFERMERIA") == 0) {
            ?>
            <table>
                <tr>
                    <td>
                        <div class="opcion_menu">
                        </div>
                    </td>
                    <td>
                        <div class="opcion_menu">
                        </div>
                    </td>
                    <td>
                        <div class="opcion_menu">
                        </div>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'buscar_paciente.php'">
                            <span class="grande glyphicon  glyphicon-heart" ></span>
                        </a>
                        <p>Registrar signos vitales</p>
                    </td>
                </tr>
            </table>
            <?php
        }
        if (strcmp($tipo_usuario, "FISIOTERAPEUTA") == 0) {
            ?>
            <table>
                <tr>
                    <td>
                        <div class="opcion_menu">
                        </div>
                    </td>
                    <td>
                        <div class="opcion_menu">
                        </div>
                    </td>
                    <td>
                        <div class="opcion_menu">
                        </div>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'consultar_paciente.php'">
                            <span class="grande glyphicon  glyphicon-folder-open" ></span>
                        </a>
                        <p>Historia clinica</p>
                    </td>
                </tr>
            </table>
            <?php
        }
        if (strcmp($tipo_usuario, "ADMINISTRADOR") == 0) {
            ?>
            <table class="tableMenu">
                <tr>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'nuevo_paciente.php'">
                            <span class="grande glyphicon  glyphicon-user"  ></span>
                        </a>
                        <p>Registrar nuevo paciente</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'nueva_cita.php'">
                            <span class="grande glyphicon  glyphicon-list-alt" ></span>
                        </a>
                        <p>Registrar nueva cita</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'asistencia_paciente.php'">
                            <span class="grande glyphicon  glyphicon-edit" ></span>
                        </a>
                        <p>Registrar asistencia de paciente</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'consultar_citas.php'">
                            <span class="grande glyphicon  glyphicon-calendar" ></span>
                        </a>
                        <p>Consultar citas</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'buscar_paciente_pdf.php'">
                            <span class="grande glyphicon  glyphicon-file"  ></span>
                        </a>
                        <p>Generar documento de paciente</p>
                    </td>

                </tr>
                <tr>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'consultar_paciente.php'">
                            <span class="grande glyphicon  glyphicon-folder-open" ></span>
                        </a>
                        <p>Historia clinica</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'buscar_paciente.php'">
                            <span class="grande glyphicon  glyphicon-heart" ></span>
                        </a>
                        <p>Registrar signos vitales</p>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'rango_graficas.php'">
                            <span class="grande glyphicon  glyphicon-stats" ></span>
                            <p>Gráficas</p>
                        </a>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'nuevo_usuario_sistema.php'">
                            <span class="grande glyphicon  glyphicon-circle-arrow-up" ></span>
                            <p>Alta de usuario al sistema</p>
                        </a>
                    </td>
                    <td>
                        <a class="opcion_menu" onclick="location.href = 'baja_usuario_sistema.php'">
                            <span class="grande glyphicon  glyphicon-circle-arrow-down" ></span>
                            <p>Baja de usuario del sistema</p>
                        </a>
                    </td>
                </tr>
            </table>
            <?php
        }
        ?>
        <?php require('./includes/footer.php'); ?>
