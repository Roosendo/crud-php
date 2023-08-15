<?php
  include("conexion.php");
  $con = connection();
  
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_GET['username'];
    $password = $_GET['password'];

    $sql = "select password from users where users.username = '$username'";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $pswUser = $row['password'];
    } else { Header("Location: index.html"); }

    if ($pswUser == $password) {
      Header('Location: showUsers.php');
    } else { Header("Location: index.html"); }
  } else { Header("Location: index.html"); }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  }
?>