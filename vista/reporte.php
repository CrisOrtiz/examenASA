<?php
session_start();
require_once "acceso_mysqli.php";
$var = $_GET['id'];


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reporte</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/font-awesome.css">

      <!-- ICONO-->
      <link rel="icon" type="image/ico" href="img/LOGOAVION.ico" style="border-radius:20px">

    <script type="text/javascript" language="javascript" src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script src="libs/Highcharts/js/highcharts.js"></script>
    <script src="libs/Highcharts/js/highcharts-3d.js"></script>
    <script src="libs/Highcharts/js/modules/exporting.js"></script>
   
  </head>
  <body>
    <?php

    $consulta = "SELECT presento FROM aspirante WHERE idAspirante = $var;";
    $resultado = $mysqli->query($consulta);
    $obj = $resultado->fetch_object();
    
    $resultado->close();

    if(isset($_SESSION['nombre']) && $_SESSION['status'] == 0) {
     
      $sql = "select resultado.fecha as faplicacion, resultado.totalRespuestas as aciertos, resultadoA1,resultadoA2,resultadoA3,resultadoA4,resultadoA5, resultadoA6, resultadoA7, resultadoA8, 
      resultadoA9, resultadoA10, porcentaje(resultadoA1,100) as porcientoA1, porcentaje(resultadoA2,100) as porcientoA2, porcentaje(resultadoA3,100) as porcientoA3, 
      porcentaje(resultadoA4,100) as porcientoA4, porcentaje(resultadoA5,100) as porcientoA5, porcentaje(resultadoA6,100) as porcientoA6, porcentaje(resultadoA7,100) as porcientoA7, 
      porcentaje(resultadoA8,100) as porcientoA8, porcentaje(resultadoA9,100) as porcientoA9, porcentaje(resultadoA10,100) as porcientoA10, 
      CONCAT(aspirante.nombre,' ',aspirante.paterno,' ',aspirante.materno) as alumno, aspirante.idAspirante as folio, institucion.nombre as escuela, 
      institucion.direccion as direccion, institucion.CCT as cct from resultado join aspirante using(idAspirante) join institucion using(idInstitucion) where idAspirante = $var;";

      $r = $mysqli->query($sql);
      $totalFilas= mysqli_num_rows($r);  
      if($totalFilas!=0){
          /* Obtener el array de objetos*/

          $obj = $r->fetch_object();

    ?>
      <div class="container">          
          <div class="col-md-2 col-md-offset-10"><a href="#" onclick="javascript:window.print();"><i class="fa fa-print fa-3x" aria-hidden="true"></i> Imprimir</a>&nbsp;
        </div>          
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">            
          REPORTE INDIVIDUAL DE RESULTADOS          
        </div>
      </div>
    </div>
    <div class="row-fluid">

    


        <div class="col-md-6" >
           <div class="row-fluid" >
          <div class="panel panel-primary"style="float:middle;display:block;height: 270px;  " >
            <div class="panel-heading text-center">Datos del aspirante</div><br><br>
            <div class="panel-body" >
              <table class="table table-hover ">
              <tbody>
              <tr>
              <td class="text-left" ><h4>Nombre del aspirante:</h4> </td>
              <td><h4><strong><?php printf($obj->alumno);?></strong></h4></td>
              </tr>
              <tr>
              <td width="550px" class="text-left"><h4>Folio: </h4></td>
              <td width="550px"><h4><strong><?php printf($obj->folio);?></strong></h4></td>
              </tr>
              

              </tbody>
              </table>
            </div>
        </div>
        </div>
        <div class="row-fluid" >
       </div>
    </div>


    <div class="col-md-6">
        <div class="panel panel-default" id="container" >
        <h3><p style="text-align:center;"><img style=" width: auto;height: 180px;" src="img/LOGOAVION.jpg" > <br> EXAMEN LICENCIA <br>ASA - BOLIVIA</p></h3>
         </div>
    </div>

</div>
    <div class="row-fluid">

    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">Criterios  de desempeño en el examen</div>
        <div class="panel-body">
          <table class="table table-hover ">
            <tbody>
              <tr>
                <td><strong>Desempeño Satisfactorio </strong></td>
                <td>75 o mas preguntas contestadas correctamente</td>
              </tr>
              <tr>
                <td><strong>Desempeño NO satisfactorio</strong></td>
                <td>Menos de 75 preguntas contestadas correctamente</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>

    
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary"><a class="btn  btn-danger"  href='del.php?idusres=<?php echo($var);?>' onclick="return confirm('¿Seguro que desea eliminar todos los resultados?')" style="color:white;float:right;font-size:80%;margin-top:5px;margin-right:10px;border-radius:20px;">Eliminar todos <br> los resultados</a>
          <div class="panel-heading "><h4>Desempeño en cada examen: </h4></div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
              <thead>    
                  <tr>
                    <th style="color:#04ABD0;text-align:center;"><h5>Fecha</h5></th>
                    <th style="color:#04ABD0;text-align:center;"><h5>Respuestas Correctas</h5></th>
                    <th style="color:#04ABD0;text-align:center;"><h5>Resultado Final</h5></th>
                  </tr>
              </thead>
                  <?php 
                    $consulta2="SELECT * FROM resultado WHERE idAspirante=$var";
                    $resultado2 = $mysqli->query($consulta2);
                  
                    while ($obj2 = $resultado2->fetch_object()) { 
                      ?>
                    <tbody>
                        <tr>
                          <td style="text-align:center;"><h4><?php echo($obj2->fecha);?></h4></td>
                          <td style="text-align:center;"><h4><?php echo($obj2->totalRespuestas);?></h4></td>
                          <?php 
                          $color=""; $res="REPROBADO";
                          if($obj2->totalRespuestas>=75){
                            $res="APROBADO";$color="green";
                            }else{
                              $color="red";}?>

                          <td  style="color:<?php echo($color);?>;text-align:center;"><h4><?php echo($res)?></h4></td>
                          
                        </tr>
                    </tbody>

                  <?php
                    }
                
                  ?>
              </table>
            </div>
          </div>
        </div>
        <button type="button" style="background:green;color:white;"class="btn  btn-green btn-block" onclick="location.href='panel-administracion.php'" >Volver</button><br><br><br>
      </div>
     
      
    </div>
    
          </div>
          

         
    <?php
  }else{
    ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">   
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">            
          REPORTE INDIVIDUAL DE RESULTADOS          
        </div>
      </div>
    </div>
    <div class="row-fluid">

    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">Resultados</div>
        <div class="panel-body">
          <center><h1 style="color:Red">El aspirante no tiene resutlados disponibles aun.</h1></center>
        </div>
      </div>
      <button type="button" style="background:green;color:white;"class="btn  btn-green btn-block" onclick="location.href='panel-administracion.php'" >Volver</button><br><br><br>
    </div>
    
    </div>
  
  </div>


    
<?php

  }
  $r->close();
  
      }else {
       echo "<div class=\"alert alert-dismissible alert-info container\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            <h4>Hey!</h4>
            <p>Aun no has presentado el examen, :)</p>
            </div>"; }
    ?>

  </body>
</html>
     