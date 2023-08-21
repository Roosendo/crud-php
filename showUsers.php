<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}
include("conexion.php");
$con = connection();

$sql = "SELECT * FROM users";
$query = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/mainPage.css">
  <title>Vals Coffee | Ver</title>
</head>
<body>
  <div id="dashboard">
    <a class="tab active">Mostrar Usuario</a>
    <?php if ($_SESSION['is_admin'] == 1): ?>
      <a href='modifyUsers.php' class='tab'>Modificar Usuario</a>
      <a href='deleteUsers.php' class='tab'>Eliminar Usuario</a>
    <?php endif; ?>
    <a href="printUsers.php" target="_blank" class="tab">Imprimir Usuarios</a>
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
            <?php if ($_SESSION['is_admin'] == 1): ?>
              <th>Password</th>
            <?php endif; ?>
            <th>Email</th>
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
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>

<?php 
if ($_SESSION['is_admin'] == 0) {
  $_SESSION = array();
  session_destroy();
}
?>
