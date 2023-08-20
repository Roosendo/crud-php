<?php
include("conexion.php");
$con = connection();

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Validación y sanitización de entrada
$name = mysqli_real_escape_string($con, $name);
$lastname = mysqli_real_escape_string($con, $lastname);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);
$email = mysqli_real_escape_string($con, $email);

// Verificar si el usuario ya existe
$sql_check = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
$query_check = mysqli_query($con, $sql_check);

if (mysqli_num_rows($query_check) > 0) {
  header("Location: index.php?error=duplicate");
  exit();
}

// Iniciar transacción
mysqli_begin_transaction($con);

// Insertar usuario en tabla 'users'
$sql_user = "INSERT INTO users (name, lastname, username, password, email) VALUES ('$name', '$lastname', '$username', '$password', '$email')";
$query_user = mysqli_query($con, $sql_user);

if (!$query_user) {
  mysqli_rollback($con);
  header("Location: index.php?error=insert");
  exit();
}

// Obtener el ID del usuario recién insertado
$user_id = mysqli_insert_id($con);

// Insertar registro en tabla 'admins'
$sql_admin = "INSERT INTO admins (user_id, is_admin) VALUES ($user_id, false)";
$query_admin = mysqli_query($con, $sql_admin);

if (!$query_admin) {
  mysqli_rollback($con);
  header("Location: index.php?error=insert");
  exit();
}

// Confirmar transacción exitosa
mysqli_commit($con);

header("Location: index.php");
?>
