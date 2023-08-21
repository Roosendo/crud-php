<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("HTTP/1.1 401 Unauthorized");
  exit();
}

include("conexion.php");
$con = connection();

$userId = $_POST['userId'];
$adminPassword = $_POST['adminPassword'];

// Verificar la contraseña del administrador
$correctAdminPassword = $_SESSION['password'];
if ($adminPassword === $correctAdminPassword) {
  echo "success";
} else {
  echo "error";
}
?>
