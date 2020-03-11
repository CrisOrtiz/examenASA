<?php
session_start();
require_once "acceso_mysqli.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>
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
  <script>
    $(function() {
      // Create the chart

      $('#container').highcharts({
        chart: {
          type: 'pie'
        },
        title: {
          text: 'Indice de acertividad en el examen ASA - BOLIVIA.'
        },
        subtitle: {
          text: 'Detalles'
        },
        plotOptions: {
          series: {
            dataLabels: {
              enabled: true,
              format: '{point.name}: {point.y:.1f}%'
            }
          }
        },

        tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> total en el examen<br/>'
        },
        series: [{
          name: 'ASA - BOLIVIA',
          colorByPoint: true,
          data: [
            <?php
            $var = $_SESSION['idaspirante'];
            $sql = $mysqli->query("select fecha,  totalRespuestas*100/100 as aciertos, (100-totalRespuestas)*(100)/100 as errores from resultado where idAspirante=$var order by idResultado DESC ; ");

            $obj = $sql->fetch_object()
            ?>['Aciertos', <?php printf($obj->aciertos); ?>],
            ['Errores', <?php printf($obj->errores); ?>],

            <?php $sql->close(); ?>

          ]
        }]
      });
    });
  </script>

</head>

<body>
  <?php
  $var = $_SESSION['idaspirante'];
  $consulta = "SELECT presento FROM aspirante WHERE idAspirante = $var;";
  $resultado = $mysqli->query($consulta);
  $obj = $resultado->fetch_object();
  $r = $obj->presento;
  $resultado->close();

  if (isset($_SESSION['nombre']) && $_SESSION['status'] == 1 && $r == 1) {
    $var = $_SESSION['idaspirante'];
    $sql = "select resultado.fecha as faplicacion, resultado.totalRespuestas as aciertos, resultadoA1,resultadoA2,resultadoA3,resultadoA4,resultadoA5, resultadoA6, resultadoA7, resultadoA8, 
      resultadoA9, resultadoA10, porcentaje(resultadoA1,100) as porcientoA1, porcentaje(resultadoA2,100) as porcientoA2, porcentaje(resultadoA3,100) as porcientoA3, 
      porcentaje(resultadoA4,100) as porcientoA4, porcentaje(resultadoA5,100) as porcientoA5, porcentaje(resultadoA6,100) as porcientoA6, porcentaje(resultadoA7,100) as porcientoA7, 
      porcentaje(resultadoA8,100) as porcientoA8, porcentaje(resultadoA9,100) as porcientoA9, porcentaje(resultadoA10,100) as porcientoA10, 
      CONCAT(aspirante.nombre,' ',aspirante.paterno,' ',aspirante.materno) as alumno, aspirante.idAspirante as folio, institucion.nombre as escuela, 
      institucion.direccion as direccion, institucion.CCT as cct from resultado join aspirante using(idAspirante) join institucion using(idInstitucion) where idAspirante = $var order by idResultado DESC;";

    if ($r = $mysqli->query($sql)) {
      /* Obtener el array de objetos*/

      $obj = $r->fetch_object()

      ?>
      <div class="container">
        <div class="col-md-2 col-md-offset-10"><a href="#" onclick="javascript:window.print();"><i class="fa fa-print fa-3x" aria-hidden="true"></i> Imprimir</a>&nbsp;</div>
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading text-center">
              REPORTE INDIVIDUAL DE RESULTADOS
            </div>
          </div>
        </div>
        <div class="row-fluid">

          <div class="col-md-6">
            <div class="panel panel-default" id="container">
            </div>
          </div>


          <div class="col-md-6">
            <div class="row-fluid">
              <div class="panel panel-primary">
                <div class="panel-heading text-center">Datos del aspirante</div>
                <div class="panel-body">
                  <table class="table table-hover ">
                    <tbody>
                      <tr>
                        <td width="550px" class="text-right">Folio: </td>
                        <td width="550px"><strong><?php printf($obj->folio); ?></strong></td>
                      </tr>
                      <tr>
                        <td class="text-right">Nombre del aspirante: </td>
                        <td><strong><?php printf($obj->alumno); ?></strong></td>
                      </tr>
                      <tr>
                        <td class="text-right">Fecha de evaluacion: </td>
                        <td><strong><?php printf($obj->faplicacion); ?></strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="panel panel-primary">
                <div class="panel-heading text-center">Resultado general en el examen</div>
                <div class="panel-body text-center">
                  <?php

                  $ds = 0;
                

                  $desempeñoA1 = "";


                  if ($obj->porcientoA1 <= 75) {
                    $ds=0;
                    $desempeñoA1 = "No satisfactorio";
                  } elseif ($obj->porcientoA1 >= 76) {
                    $ds = 1;
                    $desempeñoA1 = "Satisfactorio";
                  }



                  if ($ds >= 1) {
                    echo "<h4 style='color:green'>Aprobado</h4>";
                  } else {
                    echo "<h4 style='color:red'>Reprobado</h4>";
                  }
                  ?>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="row-fluid">

          <div class="col-md-12">
            <div class="panel panel-primary">
              <div class="panel-heading text-center">Criterios de desempeño en el examen</div>
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
            <div class="panel panel-primary">
              <div class="panel-heading text-center">Desempeño del examen</div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>
                        </th>
                        <?php
                        $consulta = "SELECT * FROM area LIMIT 10";

                        if ($resultado = $mysqli->query($consulta)) {
                          /* Obtener el array de objetos*/
                          while ($objarea = $resultado->fetch_object()) { ?>
                            <th><?php print($objarea->nombre); ?></th>
                          <?php }
                        /* Liberar el conjunto de resultados*/
                        $resultado->close();
                      } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          PORCENTAJE
                        </td>
                        <td><?php printf($obj->porcientoA1); ?>%</td>

                      </tr>
                      <tr>
                        <td>
                          ACIERTOS
                        </td>
                        <td><?php printf($obj->resultadoA1); ?></td>

                      </tr>
                      <tr>
                        <td>
                          DESEMPEÑO
                        </td>
                        <td><?php printf($desempeñoA1); ?></td>

                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <center><button type="button" style="background:green;color:white;max-width:500px;" class="btn  btn-blue btn-block" onclick="location.href='panel-aspirante.php'">Volver</button></center><br>
            <center><a href="#1"><button type="button" id="botonres" class="btn  btn-block" style="background:#04A2D0;color:white;max-width:500px;" onclick="javascript:$('#respuestas').show();">⇓⇓ MOSTRAR RESPUESTAS ⇓⇓</button></a></center><br><br><br>


          </div>


        </div>
      </div>

      <div hidden id="respuestas">
        <?php
        $respcolor = "green";;
        $consulta3 = ("SELECT idUsuario,idpregunta,texto, respuesta1, valor1, respuesta2, valor2, respuesta3, valor3, idArea FROM examen WHERE  idArea = 1 AND idUsuario='$var' ORDER BY idpregunta");
        if ($resultado3 = $mysqli->query($consulta3)) {


          while ($obj2 = $resultado3->fetch_object()) {
            ?><center>

              <div class="form-group" id="<?php echo ($obj2->idpregunta); ?>" style="position:relative; max-width:1000px;">
                <h4 class="text-justify" style="font-weight:bolder;"><?php print($obj2->idpregunta . ".-  " . $obj2->texto); ?></h4>
                <div class="row-fluid">


                  <div class="radio">
                    <label>
                      <h4>
                        <p style="color:<?php if ($obj2->valor1 == 1) {
                                          print($respcolor);
                                        } else {
                                          print "";
                                        } ?>;font-weight:<?php if ($obj2->valor1 == 1) {
                                          print("800");
                                        } else {
                                          print "";
                                        }?>"><?php printf($obj2->respuesta1); ?></p>
                      </h4>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <h4>
                        <p style="color:<?php if ($obj2->valor2 == 1) {
                                          print($respcolor);
                                        } else {
                                          print "";
                                        } ?>;font-weight:<?php if ($obj2->valor2 == 1) {
                                          print("800");
                                        } else {
                                          print "";
                                        }?>"><?php printf($obj2->respuesta2); ?></p>
                      </h4>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <h4>
                        <p style="color:<?php if ($obj2->valor3 == 1) {
                                          print($respcolor);
                                        } else {
                                          print "";
                                        } ?>;font-weight:<?php if ($obj2->valor3 == 1) {
                                          print("800");
                                        } else {
                                          print "";
                                        }?>"><?php printf($obj2->respuesta3); ?></p>
                      </h4>
                    </label>

                  </div>
                </div>
              </div>


            </center>




          <?php
        }
      }

      ?>
        <center><button type="button" style="background:green;color:white;max-width:500px;" class="btn  btn-blue btn-block" onclick="location.href='panel-aspirante.php'">Volver</button></center><br><br><br>
      </div>




    <?php
  }
  $r->close();
} else {
  echo "<div class=\"alert alert-dismissible alert-info container\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            <h4>Hey!</h4>
            <p>Aun no has presentado el examen, :)</p>
            </div>";
}
?>

</body>


</html>