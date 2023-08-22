<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../index.php");
  exit();
} else if ($_SESSION['is_admin'] == 1 || $_SESSION['is_admin'] == 2) {
  // importar el modulo para crear pdf
  require_once('../../includes/tcpdf/tcpdf.php');
  // importar el archivo de la conexion a la base de datos
  include('../../includes/conexion.php');
  $con = connection();

  // consulta que devuelva solo lo necesario para imprimir
  if ($_SESSION['is_admin'] == 1) {
    $sql = "SELECT concat(name, ' ', lastname) as full_name, username, email from users order by full_name asc";
    $query = mysqli_query($con, $sql);
  } else {
    $sql = "SELECT concat(name, ' ', lastname) as full_name, username, email from users where id not in (select user_id from admins where is_admin != 0) order by full_name asc";
    $query = mysqli_query($con, $sql);
  }

  // si la consulta devuelve un error esto ayudará
  if (!$query) {
    die('Error en la consulta: ' . mysqli_error($con));
  }

  // se crea un nuevo objeto TCPDF
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  // se establece informacion para el documento
  $pdf->setCreator(PDF_CREATOR);
  $pdf->setAuthor('Vals Coffee');
  $pdf->setTitle('Lista de Usuarios');
  $pdf->setSubject('Lista de todos los Usuarios registrados.');
  // agregar una página al pdf
  $pdf->AddPage();

  // escribiendo el contenido del pdf
  $pdf->setFont('times', 'B', 16);
  $pdf->Cell(0, 10, 'Lista de Usuarios', 0, 1, 'C');
  $pdf->Ln(10);

  $pdf->setFont('times', 'B', 12);
  // agregar color de fondo al encabezado de la tabla
  $pdf->setFillColor(200, 220, 255);
  // todo el encabezado de la tabla
  $pdf->Cell(60, 10, 'Nombre completo', 1, 0, 'C', 1);
  $pdf->Cell(60, 10, 'Usuario', 1, 0, 'C', 1);
  $pdf->Cell(60, 10, 'Email', 1, 1, 'C', 1);

  // todas las celdas para cada usuario
  $pdf->setFont('dejavusans', '', 11);
  while ($row = mysqli_fetch_assoc($query)) {
    $pdf->Cell(60, 10, $row['full_name'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['username'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['email'], 1, 1, 'C');
  }

  // generando el pdf
  $pdf->Output('lista_usuarios.pdf', 'I');

  // cerrando la conexion a la base de datos
  mysqli_close($con);
  ?>
<?php } else {
  header("Location: index.php");
  exit();
}
