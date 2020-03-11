<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Examen</title>
    

    <script type="text/javascript" src="js/carga.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </head>
  <body>
    <?php
    require_once "acceso_mysqli.php";
    $var = $_SESSION['idaspirante'];
    $consulta = "SELECT presento FROM aspirante WHERE idAspirante = $var;";
    $resultado = $mysqli->query($consulta);
    $obj = $resultado->fetch_object();
    $r = $obj->presento;
    $resultado->close();

    if(isset($_SESSION['nombre']) && $_SESSION['status'] == 1 && $r == 0) {
    ?>
    <div class="container">
      <div class="page-header">
    		  <h1>Recomendaciones</h1>
      </div>
      <div class="row-fluid">
        <h3><ol>
          <h1 style="color:red;">IMPORTANTE</h1>
          <li> <h3>La duracion de la prueba es de 1 hora y 30 minutos.</h3></li>
          <li> <h3>Conteste todas las preguntas; si alguna de ellas la considera particularmente difícil, no se detenga demasiado. Al finalizar, si tiene tiempo, regrese a ellas y seleccione sus respuestas.</h3></li>
          <li> <h3>No se inquiete, ni se presione. Si le sobra tiempo, revise y verifique sus respuestas.</h3> </li>
          <li> <h3>Recargar la pagina, ocacionara que se borren todas las preguntas marcadas.</h3></li>
          
        </ol></h3>
        <br>
        <div class="col-md-4 col-md-offset-4">
            <a href="examen.php" class="btn btn-lg btn-success btn-block" id="comenzar">Comenzar</a>
        </div>
        <div class="col-md-4">&nbsp;</div>
        </div>
      </div>
      <?php
      }else {
         echo "<div class=\"alert alert-dismissible alert-success container\">
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
              <h3>Genial!</h3>
              <p><h3>Ya presentaste el examen :)</h3></p>

              <center><button onclick=\"location.href='nuevoexamen.php?idaspirante=$var'\" type=\"button\" class=\"btn btn-info\" style=\"color:white;background:04D0C4;margin:5%;\" >VOLVER A TOMAR PRUEBA</button></center>
              </div>"; }
      ?>
  </body>
</html>
