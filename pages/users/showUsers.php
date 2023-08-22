<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../index.php");
  exit();
}
include("../../includes/conexion.php");
$con = connection();

if ($_SESSION['is_admin'] == 1) {
  $sql = "select users.*, admins.is_admin from users left join admins on users.id = admins.user_id";
  $query = mysqli_query($con, $sql);
} else {
  $sql = "select users.*, admins.is_admin from users left join admins on users.id = admins.user_id where admins.is_admin = 0";
  $query = mysqli_query($con, $sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/mainPage.css">
  <title>Vals Coffee | Ver</title>
</head>
<body>
  <div id="dashboard">
    <a class="tab active">Mostrar Usuario</a>
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
    <a href="myProfile.php" class="tab">Mi Perfil</a>
    <a href="../authentication/logOut.php" class="tab">Cerrar Sesión</a>
  </div>
  <div class="content">
    <h2>Todos los Usuarios ...</h2>
    <div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Username</th>
            <?php if ($_SESSION['is_admin'] == 1): ?>
              <th>Password</th>
            <?php endif; ?>
            <th>Email</th>
            <?php if ($_SESSION['is_admin'] == 1): ?>
              <th>Tipo de Usuario</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_array($query)): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['lastname'] ?></td>
            <td><?= $row['username'] ?></td>
            <?php if ($_SESSION['is_admin'] == 1): ?>
              <td><?= $row['password'] ?></td>
            <?php endif; ?>
            <td><?= $row['email'] ?></td>
            <?php if ($_SESSION['is_admin'] == 1): ?>
              <td>
                <?php if ($row['is_admin'] == 0): ?>
                  Empleado
                <?php elseif ($row['is_admin'] == 1): ?>
                  Gerente
                <?php elseif ($row['is_admin'] == 2): ?>
                  Supervisor
                <?php endif; ?>
              </td>
            <?php endif; ?>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
