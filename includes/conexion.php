<?php

/* 
 * Almacena las constantes de conexión con la base de datos y
 * el objeto de conexión.
 */

// Servidor donde está la base de datos
define("SERVIDOR_BASE_DATOS", "localhost");

// Usuario para acceder a la base de datos
define("NOMBRE_USUARIO_BD", "root");

// Contraseña de usuario de la base de datos
define("CONTRASENA_USUARIO_BD", "");

// Nombre de la base de datos
define("BASE_DATOS", "sistema_cafsi");

// Objeto de conexión para realizar las consultas
$bd = new mysqli(SERVIDOR_BASE_DATOS, NOMBRE_USUARIO_BD, CONTRASENA_USUARIO_BD, BASE_DATOS)
        or  die("<p>No se ha podido conectar con el servidor de la base de datos.<br />Verifique usuario y/o contraseña.</p>");

// Esta consulta permite el trato de caracteres especiales entre PHP y MySQL
$bd->query("SET NAMES 'UTF8'");
