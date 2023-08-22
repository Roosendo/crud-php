<?php
// En el archivo que maneja el cierre de sesión
session_start(); // Iniciar la sesión

// Limpiar todas las variables de sesión
$_SESSION = array();

// Finalizar la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: ../../index.php");
exit;
?>
