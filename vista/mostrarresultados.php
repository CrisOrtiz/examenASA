<?php
session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ASA - BOLIVIA Resultados </title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen" title="no title" charset="utf-8">

      <!-- ICONO-->
    <link rel="icon" type="image/ico" href="img/LOGOAVION.ico" style="border-radius:20px">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <script type="text/javascript" src="js/funcion.js"></script>
    <script type="text/javascript" src="js/examenjs.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

<style>
/* agregamos una fuente de dafont, que simula unos leds */
@font-face {
	font-family: ledbdrev;
	src: url(./Fleftex_M.ttf) format("truetype");
}
/* aqui va el estilo que tendra el clock */


</style>
  </head>
  <body>
    <?php
    require_once "acceso_mysqli.php";
    $var = $_SESSION['idaspirante'];
    $consulta = "SELECT * FROM aspirante WHERE idAspirante = $var;";
    $resultado = $mysqli->query($consulta);
    $obj = $resultado->fetch_object();
    $r = $obj->presento;
    $idUsuario=$obj->idAspirante;

    $resultado->close();

    if(isset($_SESSION['nombre']) && $_SESSION['status'] == 1) {
    ?>
  
<div class="row-fluid">


  <div class="page-header">
		  <h1><?php echo($_SESSION['nombre']),' ';?> estos son tus resultados:</h1>
  </div>

  <table class="table table-striped table-bordered" >
  <thead>
      <tr>
        <th style="color:#04ABD0;text-align:center;"><h2>Fecha</h2></th>
        <th style="color:#04ABD0;text-align:center;"><h2>Respuestas Correctas</h2></th>
        <th style="color:#04ABD0;text-align:center;"><h2>Resultado Final</h2></th>
      </tr>
  </thead>
      <?php 
        $consulta2="SELECT * FROM resultado WHERE idAspirante=$_SESSION[idaspirante]";
        $resultado2 = $mysqli->query($consulta2);
        $row_cnt = $resultado2->num_rows;

        if($row_cnt==0){
          ?>
        <tbody>
            <tr>
            <td style="text-align:center;" colspan=3><h3>NO HAY RESULTADOS AUN</h3></td>
              
            </tr>
        </tbody>
        <?php

        }else{
        while ($obj2 = $resultado2->fetch_object()) { 
          ?>
        <tbody>
            <tr>
              <td style="text-align:center;"><h3><?php echo($obj2->fecha);?></h3></td>
              <td style="text-align:center;"><h3><?php echo($obj2->totalRespuestas);echo('/100');?></h3></td>
              <?php 
              $color=""; $res="REPROBADO";
              if($obj2->totalRespuestas>=75){
                $res=("APROBADO");$color="green";
                }else{
                  $color="red";}?>

              <td  style="color:<?php echo($color);?>;text-align:center;"><h3><?php echo($res)?></h3></td>
              
            </tr>
        </tbody>

      <?php
        }
      }
      ?>
      </table> 
</div> 


<button type="button" style="background:#04A2D0;color:white;"class="btn  btn-blue btn-block" onclick="location.href='panel-aspirante.php'" >Volver</button>

    </div> <!-- FIN DIV ROW-FLUID -->
    </div> <!-- FIN DIV CONTAINER -->


      <div class="row">&nbsp;</div>
      <?php
      }else {
         echo "<div class=\"alert alert-dismissible alert-warning container\">              
              <h1>Error!  :(</h1>
              
              </div>"; }
      ?>


  </body>
</html>
