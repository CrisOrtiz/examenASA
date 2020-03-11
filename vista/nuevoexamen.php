<?php
session_start();
require_once "acceso_mysqli.php";
$var = $_GET['idaspirante'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/font-awesome.css">

    <script type="text/javascript" language="javascript" src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>


    
  </head>
  <body>
    <?php

   $sql = "UPDATE aspirante SET presento=0 WHERE idAspirante=$var";
   $mysqli->query($sql);
    
   $sql2 = "DELETE FROM examen WHERE idUsuario = $var";
   $mysqli->query($sql2);

   

   if ($mysqli->query($sql) === TRUE && $mysqli->query($sql2) ===TRUE) {
    header ('Location: comenzarnuevaprueba.php');
    } else {
    echo("ERROR EN LA CONEXION A LA BASE DE DATOS!!!!!");
    echo "Error deleting record: " . $conn->error;
    }
    $mysqli->close();
    ?>
  </body>
</html>
