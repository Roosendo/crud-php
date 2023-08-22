<?php
include("conexion.php");
$con = connection();

$sql = "SELECT * FROM users";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/miestilo.css" rel="stylesheet" />
    <title>Users CRUD</title>
  </head>

  <body>
    <div class="users-form">
      <h1>Registrarse</h1>
      <form action="insertar.php" method="POST">
        <input type="text" name="name" placeholder="Nombre" />
        <input type="text" name="lastname" placeholder="Apellidos" />
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="passwordsegunda" placeholder="Confirmar contraseña" />
        <?php
          if (isset($_GET['error']) && $_GET['error'] === 'password_mismatch') {
            echo "<p class='error-message'>Las contraseñas no coinciden. Por favor, intenta de nuevo.</p>";
          }
        ?>
        <input type="email" name="email" placeholder="Email" />

        <input type="submit" value="Agregar" />
      </form>
      <h2><a href="index.html">Cancelar</a></h2>
    </div>
  </body>
</html>
