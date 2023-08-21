<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/main.css" />
    <title>Log Vals Coffee | Log in</title>
  </head>
  <body>
    <div class="container">
      <h1>Log in</h1>
      <form method="get" action="./procesar.php">
        <label>Username:</label>
        <input type="text" name="username" required /><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required /><br><br>
        
        <input type="submit" value="Iniciar Sesión" class="button"/>
      </form>
      <?php
      if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == 'duplicate'): ?>
          <p>Usuario o correo ya registrado.</p>
        <?php elseif ($error == 'insert'): ?>
          <p>Error al registrarse.</p>
        <?php elseif ($error == 'database'): ?>
          <p>Error en la base de datos</p>
        <?php elseif ($error == 'nice'): ?>
          <p>Registrado exitosamente!</p>
        <?php elseif ($error == 'credencial'): ?>
          <p>Usuario o Contraseña incorrectos.</p>
        <?php else: ?>
          <p></p>
        <?php endif;
      }
      ?>

      <div>
        <p><a href="olvidarContraseña.html">¿Olvidaste tu Contraseña?</a></p><br>
        <p><a href="registro.php">¡Regístrate!</a></p>
      </div>
    </div>
  </body>
</html>
