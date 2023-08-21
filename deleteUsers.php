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
  <title>Vals Coffee | Eliminar</title>
</head>
<body>
  <div id="dashboard">
    <a href="showUsers.php" class="tab">Mostrar Usuario</a>
    <a href="modifyUsers.php" class="tab">Modificar Usuario</a>
    <a class="tab active">Eliminar Usuario</a>
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
            <td><a href="" class="users-table--delete" onclick="confirmDeletion(<?= $row['id'] ?>)">Eliminar</a></td>
          </tr>
          <?php endwhile; ?>
          <script>
            var adminPassword = "<?= $_SESSION['password']; ?>";

            function confirmDeletion(userId) {
              var enteredPassword = prompt("Ingrese la contraseña del administrador para confirmar la eliminación:");

              if (enteredPassword !== null && enteredPassword === adminPassword) {
                // Redirige a delete.php con el ID del usuario
                window.location.href = `delete.php?id=${userId}`;
              } else {
                alert("Contraseña de administrador incorrecta. Acción cancelada.");
              }
            }
          </script>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
