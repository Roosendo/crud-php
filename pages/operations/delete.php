<?php

include("../../includes/conexion.php");
$con = connection();

$id = $_GET["id"];

// Eliminar de la tabla admins
$sql1 = "DELETE FROM admins WHERE user_id = ?";
$stmt1 = mysqli_prepare($con, $sql1);
mysqli_stmt_bind_param($stmt1, "i", $id);
$query1 = mysqli_stmt_execute($stmt1);

// Eliminar de la tabla users
$sql2 = "DELETE FROM users WHERE id = ?";
$stmt2 = mysqli_prepare($con, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $id);
$query2 = mysqli_stmt_execute($stmt2);

if ($query1 && $query2) {
  header("Location: ../users/deleteUsers.php");
}

?>
