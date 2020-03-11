<?php

require_once "acceso_mysqli.php"; // incluímos los datos de acceso a la BD

if(isset($_GET['id'])){

    $id = htmlspecialchars($_GET['id']);     
    
    $query = "DELETE FROM aspirante where idAspirante='$id'";
    $mysqli->query($query);

    header("location: panel-administracion.php");
}

if(isset($_GET['idpre'])){

    $idpre = htmlspecialchars($_GET['idpre']);     
    
    $query = "DELETE FROM pregunta where idPregunta='$idpre'";
    $mysqli->query($query);

    header("location: panel-administracion.php");
}


if(isset($_GET['idusres'])){
    
    $idusres=$_GET['idusres'];
    $query = "DELETE FROM resultado WHERE idAspirante = $idusres";
    $mysqli->query($query);

    header("location: reporte.php?id=7");
  
}

?>