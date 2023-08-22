<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../index.php");
  exit();
}

include("../../includes/conexion.php");
$con = connection();

$sql = "SELECT * FROM users";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/mainPage.css">
  <title>Vals Coffee | Mi Perfil</title>
</head>
<body>
  <div id="dashboard">
    <a href="showUsers.php" class="tab">Mostrar Usuario</a>
    <?php if ($_SESSION['is_admin'] == 1): ?>
      <a href='createUser.php' class='tab'>Crear Usuario</a>
      <a href='modifyUsers.php' class='tab'>Modificar Usuario</a>
      <a href='deleteUsers.php' class='tab'>Eliminar Usuario</a>
      <a href="printUsers.php" target="_blank" class="tab">Imprimir Usuarios</a>
    <?php elseif ($_SESSION['is_admin'] == 2): ?>
      <a href='createUser.php' class='tab'>Crear Usuario</a>
      <a href='modifyUsers.php' class='tab'>Actualizar Usuario</a>
      <a href="printUsers.php" target="_blank" class="tab">Imprimir Usuarios</a>
    <?php endif; ?>
    <a href="myProfile.php" class="tab active">Mi Perfil</a>
    <a href="../authentication/logOut.php" class="tab">Cerrar Sesión</a>
  </div>
  <div class="content">
    <img src="src/imgs/user.png" alt="Profile Picture">

  </div>
</body>
</html>