<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../index.php");
  exit();
}

include("../../includes/conexion.php");
$con = connection();

// Obtener el user_id de la sesión
$user_id = $_SESSION['user_id'];

// Consulta para obtener los datos del usuario
$sql = "SELECT u.*, a.is_admin from users u join admins a on u.id = a.user_id where u.id = $user_id";
$result = mysqli_query($con, $sql);

if ($result) {
  $user_data = mysqli_fetch_assoc($result);
} else {
  // Manejo de error en caso de fallo de consulta
  die("Error al obtener los datos del usuario");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/mainPage.css">
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
    <div class="profile-container">
      <img src="../../assets/imgs/user.png" alt="Profile Picture" class="profile-image">
      <div class="profile-details">
        <p>Tu nombre es: <b><?= $user_data['name']; ?></b></p>
        <p>Tu correo es: <b><?= $user_data['email']; ?></b></p>
        <p>Tu usuario es: <b><?= $user_data['username']; ?></b></p>
        <?php if ($user_data['is_admin'] == 0): ?>
          <p>Eres un: <b>Empleado</b></p>
        <?php elseif ($user_data['is_admin'] == 1): ?>
          <p>Eres un: <b>Gerente</b></p>
        <?php elseif ($user_data['is_admin'] == 2): ?>
          <p>Eres un: <b>Supervisor</b></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>