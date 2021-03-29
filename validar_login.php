<?php

require('./includes/errors.php');
require('./includes/conexion.php');

$id = addslashes($_POST["id"]);
$contrasena = addslashes($_POST["contrasena"]);

$sql = "SELECT * FROM usuarios_sistema;";
$resultado = $bd->query($sql);

$usuario_encontrado = false;
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($registro = $resultado->fetch_array()) {
            $bd_id = $registro["id"];
            $bd_nombre = $registro["nombre"];
            $bd_apellidos = $registro["apellidos"];
            $bd_contrasena = $registro["contrasena"];
            $bd_tipo_usuario = $registro["tipo_usuario"];

            if (strcmp($id, $bd_id) == 0 && strcmp($contrasena, $bd_contrasena) == 0) {
                session_start();
                $_SESSION["id"] = $bd_id;
                $_SESSION["nombre"] = $bd_nombre;
                $_SESSION["apellidos"] = $bd_apellidos;
                $_SESSION["contrasena"] = $bd_contrasena;
                $_SESSION["tipo_usuario"] = $bd_tipo_usuario;
                $_SERVER["session_init"] = 1;

                $bd->close();
                $usuario_encontrado = true;
                header("Location: menu_principal.php");
                break;
            }
        }
        if ($usuario_encontrado == false) {
            Errors::mostrar_error("index.php", 2);
        }
    } else {
        Errors::mostrar_error("index.php", 99);
    }
} else {
    Errors::mostrar_error("index.php", 100);
}

$bd->close();
