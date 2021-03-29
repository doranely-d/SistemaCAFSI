<?php
/*
 * De acuerdo a la sesión actual, muestra el menú principal o
 * la página de inicio.
 */

// Primero se inicia la sesión
session_start();

// Si existe el id significa que se ha iniciado sesión
if (isset($_SESSION["id"])) {
    header("Location: menu_principal.php");
} else { // De lo contrario se redirije al index
    header("Location: index.php?error=0");
}
