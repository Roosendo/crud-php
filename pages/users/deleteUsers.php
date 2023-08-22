<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
} else if ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] == 2) {
  include("conexion.php");
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
  <link rel="stylesheet" href="src/css/mainPage.css">
  <title>Vals Coffee | Eliminar</title>
</head>
<body>
<div id="dashboard">
    <a href="showUsers.php" class="tab">Mostrar Usuario</a>
    <?php if ($_SESSION['is_admin'] == 1): ?>
      <a href='createUser.php' class='tab'>Crear Usuario</a>
      <a href='modifyUsers.php' class='tab'>Modificar Usuario</a>
      <a href='deleteUsers.php' class='tab active'>Eliminar Usuario</a>
      <a href="printUsers.php" target="_blank" class="tab">Imprimir Usuarios</a>
    <?php elseif ($_SESSION['is_admin'] == 2): ?>
      <a href='createUser.php' class='tab'>Crear Usuario</a>
      <a href='modifyUsers.php' class='tab'>Actualizar Usuario</a>
      <a href="printUsers.php" target="_blank" class="tab">Imprimir Usuarios</a>
    <?php endif; ?>
    <a href="myProfile.php" class="tab">Mi Perfil</a>
    <a href="logOut.php" class="tab">Cerrar Sesión</a>
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
            <th>Password</th>
            <th>Email</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_array($query)): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['lastname'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['password'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><a href="" class="users-table--delete" onclick="showConfirmation(<?= $row['id'] ?>)">Eliminar</a></td>
          </tr>
          <?php endwhile; ?>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script>
          function showConfirmation(userId) {
            var confirmation = confirm("¿Estás seguro de que deseas eliminar este usuario?");

            if (confirmation) {
              var adminPassword = prompt("Contraseña propia:");

              if (adminPassword !== null) {
                verifyAdminPassword(userId, adminPassword);
              }
            }
          }

          function verifyAdminPassword(userId, adminPassword) {
            $.ajax({
              type: "POST",
              url: "verify_password.php",
              data: { userId: userId, adminPassword: adminPassword },
              success: function(response) {
                if (response === 'success') {
                  // Contraseña correcta, redirige a delete.php con el ID del usuario
                  window.location.href = `delete.php?id=${userId}`;
                } else if (response === 'error') {
                  alert("Contraseña incorrecta o acción cancelada.");
                }
              }
            });
          }
          </script>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
<?php } else {
  header("Location: index.php");
  exit();
}
?>