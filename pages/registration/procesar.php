<?php
  include("../../includes/conexion.php");
  $con = connection();
  
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_GET['username'];
    $password = $_GET['password'];

    $sql = "select u.id, u.password, a.user_id, a.is_admin from users u inner join admins a on u.id = a.user_id where u.username = '$username';";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $pswUser = $row['password'];
    } else { Header("Location: ../../index.php?error=database"); }

    if ($pswUser == $password) {
      session_start();
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['is_admin'] = $row['is_admin'];
      $_SESSION['password'] = $row['password'];
      header("Location: ../users/showUsers.php");
      exit();
    } else {
      Header("Location: ../../index.php?error=credencial"); 
    }
  } else {
    Header("Location: ../../index.php");
  }
?>
