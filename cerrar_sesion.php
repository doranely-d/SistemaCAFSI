<?php
/* Cierra la sesión actual */

// Primero se inicia la sesión
session_start();
// Después se destruye
session_destroy();
$_SERVER["session_init"] = 0;
// Re-dirige al index.php
header("Location: index.php");
