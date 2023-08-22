<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
} else if ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] == 2) {
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
  <link href="css/miestilo.css" rel="stylesheet">
  <title>Vals Coffee | Crear</title>
</head>
<body>
  <div id="dashboard">
    <a href="showUsers.php" class="tab">Mostrar Usuario</a>
    <?php if ($_SESSION['is_admin'] == 1): ?>
      <a class="tab active">Crear Usuario</a>
      <a href='modifyUsers.php' class='tab'>Modificar Usuario</a>
      <a href='deleteUsers.php' class='tab'>Eliminar Usuario</a>
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
    <div class="users-form">
      <h1>Crear Usuario</h1>
      <?php if (isset($_GET['error'])):
        $error = $_GET['error'];
        if ($error == 'nice'): ?>
          <p>Usuario creado.</p>
        <?php endif; endif; ?>
      <form action="insertar.php" method="POST">
        <input type="text" name="name" placeholder="Nombre" />
        <input type="text" name="lastname" placeholder="Apellidos" />
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <input type="email" name="email" placeholder="Email" />
        <?php if ($_SESSION['is_admin'] == 1): ?>
          <select name="typeUser">
            <option value="1">Gerente</option>
            <option value="2">Supervisor</option>
            <option value="0" selected>Empleado normal</option>
          </select>
        <?php endif; ?>

        <input type="submit" value="Agregar" />
      </form>
    </div>
  </div>
</body>
</html>
<?php } else {
  header("Location: index.php");
  exit();
}
?>
