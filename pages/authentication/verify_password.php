<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("HTTP/1.1 401 Unauthorized");
  exit();
}

include("../../includes/conexion.php");
$con = connection();

$userId = $_POST['userId'];
$adminPassword = $_POST['adminPassword'];

// Verificar la contraseña del administrador
if ($_SESSION['is_admin'] == 2) {
  $sql = "SELECT u.password from users u join admins a on u.id = a.user_id where a.is_admin = 1";
  $query = mysqli_query($con, $sql);

  if ($query) {
    $row = mysqli_fetch_assoc($query);
    $correctAdminPassword = $row['password'];
  } 
} else {
  $correctAdminPassword = $_SESSION['password'];
}

if ($adminPassword === $correctAdminPassword) {
  echo "success";
} else {
  echo "error";
}
?>
