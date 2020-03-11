<?php
session_start();
const A1 = 100;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>EXAMEN ASA - BOLIVIA</title>
  <link rel="stylesheet" href="css/bootstrap.css" media="screen" title="no title" charset="utf-8">
  <!-- ICONO-->
  <link rel="icon" type="image/ico" href="img/LOGOAVION.ico" style="border-radius:20px">

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/funciones.js"></script>
  <script type="text/javascript" src="js/funcion.js"></script>
  <script type="text/javascript" src="js/examenjs.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script language="Javascript" type="text/javascript" src="js/clockCountdown.js"></script>




  <style>
    /* agregamos una fuente de dafont, que simula unos leds */
    @font-face {
      font-family: ledbdrev;
      src: url(./Fleftex_M.ttf) format("truetype");
    }

    /* aqui va el estilo que tendra el clock */

    #clock {
      color: white;
    }

    .clockCountdownNumber {
      float: left;
      background: URL('img/numeros.png');
      display: block;
      width: 34px;
      height: 50px;
    }

    .clockCountdownSeparator_dias,
    .clockCountdownSeparator_horas,
    .clockCountdownSeparator_minutos,
    .clockCountdownSeparator_segundos {
      float: left;
      display: block;
      width: 10px;
      height: 50px;
    }

    .clockCountdownFootItem {
      width: 80px;
      float: left;
      text-align: center;
    }
  </style>
</head>

<body onload="setInterval('contador()',1000)">
  <?php
  require_once "acceso_mysqli.php";
  if (isset($_SESSION['idaspirante'])) {
    $var = $_SESSION['idaspirante'];
  } else {
    header("location:panel-aspirante.php");
  }

  $consulta = "SELECT * FROM aspirante WHERE idAspirante = $var;";
  $resultado = $mysqli->query($consulta);
  $obj = $resultado->fetch_object();
  $r = $obj->presento;
  $idUsuario = $obj->idAspirante;

  $resultado->close();

  if (isset($_SESSION['nombre']) && $_SESSION['status'] == 1 && $r == 0) {
    ?>
    <div class="container">
      <div class="row">
        <h3 class="text-center">Tiempo restante</h3>
      </div>
      <div class="row-fluid">
        <div class="col-md-4 col-md-offset-4" id='clock'></div>
        <br>
        <div class="col-md-4"></div>
        <br>
      </div>
      <div class="row-fluid">


        <div class="page-header">
          <h1>Examen</h1>
        </div>
        <!-- INICIO ÁREA 1-->

        <div class="row-fluid" style="position:relative">
          <a id="primero">Selecciona una respuesta de cada pregunta.</a>
          <div class="panel panel-default" id="ver1" name="primero">
            <?php $consulta = "SELECT nombre FROM area WHERE idArea = 1;";
            $resultado = $mysqli->query($consulta);
            $row = $resultado->fetch_array();
            $r = $row['nombre'];
            $resultado->close();
            ?>
            <div class="panel-heading" id="ver-area1">
              <h3><strong><?php print($r); ?></strong></h3>
              <div class="row">
                <div class="col-md-3 col-md-offset-9">
                  <ul class="nav nav-pills">
                    <li class="active"><span class="label label-info">Preguntas</span><span class="badge"><?php print(A1); ?></span></li>
                    <li class="active"><span class="label label-info badge1">Contestadas</span><span class="badge cambiar1">0</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel-body" id="area1" name="area1" style="height:auto">
              <?php

              $consulta = 'SELECT texto, respuesta1, valor1, respuesta2, valor2, respuesta3, valor3, idArea FROM pregunta WHERE idArea = 1 ORDER BY RAND() LIMIT ' . A1 . ';';



              if ($resultado = $mysqli->query($consulta)) {
                /* Obtener el array de objetos*/
                $id = 1;
                $lleno = "SELECT * FROM examen WHERE idUsuario='$idUsuario'";
                $resultado2 = $mysqli->query($lleno);
                $n = $resultado2->num_rows;
                if ($n == 0) {
                  while ($obj = $resultado->fetch_object()) {
                    $sql2 = ("INSERT INTO examen (idUsuario,idpregunta,texto,respuesta1, valor1, respuesta2, valor2, respuesta3, valor3, idArea) 
                                   VALUES ('$idUsuario', '$id','$obj->texto', '$obj->respuesta1', '$obj->valor1','$obj->respuesta2','$obj->valor2','$obj->respuesta3','$obj->valor3','$obj->idArea')");

                    require_once "acceso_mysqli.php";

                    $mysqli->query($sql2);

                    $id++;
                  }
                  /* Liberar el conjunto de resultados*/
                  $resultado->close();
                }
              }




              $respcolor = "black";$font_w="fontweight:bolder;";
              $consulta3 = ("SELECT idUsuario,idpregunta,texto, respuesta1, valor1, respuesta2, valor2, respuesta3, valor3, idArea FROM examen WHERE  idArea = 1 AND idUsuario='$var' ORDER BY idpregunta");
              if ($resultado3 = $mysqli->query($consulta3)) {


                while ($obj2 = $resultado3->fetch_object()) {
                  ?>

                  <?php if ($obj2->idpregunta == 1) { ?>

                    <div class="form-group" id="<?php echo ($obj2->idpregunta); ?>" style="position:relative;">
                      <h4 class="text-justify" style="font-weight:bolder;"><?php print($obj2->idpregunta . ".-  " . $obj2->texto); ?></h4>
                      <div class="row-fluid">


                        <div class="radio">
                          <label>
                            <h4><input class="calc" name="'radioa<?php printf($obj2->idpregunta); ?>'" type="radio" value="<?php printf($obj2->valor1); ?>" />
                              <p style="font-style: bolder; color:<?php if ($obj2->valor1 == 1) {
                                                print($respcolor);
                                              } else {
                                                print "";
                                              } ?>"><?php printf($obj2->respuesta1); ?></p>
                            </h4>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <h4><input class="calc" name="'radioa<?php printf($obj2->idpregunta); ?>'" type="radio" value="<?php printf($obj2->valor2); ?>" />
                              <p style="font-style: bolder; color:<?php if ($obj2->valor2 == 1) {
                                                print($respcolor);
                                              } else {
                                                print "";
                                              } ?>"><?php printf($obj2->respuesta2); ?></p>
                            </h4>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <h4><input class="calc" name="'radioa<?php printf($obj2->idpregunta); ?>'" type="radio" value="<?php printf($obj2->valor3); ?>" />
                              <p style="font-style: bolder; color:<?php if ($obj2->valor3 == 1) {
                                                print($respcolor);
                                              } else {
                                                print "";
                                              } ?>"><?php printf($obj2->respuesta3); ?></p>
                            </h4>
                          </label>
                        </div>

                        <div class="form-group">
                          <?php if ($obj2->idpregunta == 1) { ?>
                            <div class="col-sm-offset-2 col-sm-10">

                              <button onclick="mostrar_siguiente(<?php echo ($obj2->idpregunta); ?>)" id="botocultarcon" class="btn btn  btn-success" style="margin:20px;float:right">Siguiente</button>

                            </div>
                          <?php } elseif ($obj2->idpregunta == 100) { ?>

                            <div class="col-sm-offset-2 col-sm-10">
                              <button onclick="mostrar_anterior(<?php echo ($obj2->idpregunta); ?>)" id="botmostrarcon" class="btn btn-warning" style="margin:20px;float:left">Anterior</button>

                            </div>
                          <?php } else { ?>
                            <div class="col-sm-offset-2 col-sm-10">

                              <button onclick="mostrar_anterior(<?php echo ($obj2->idpregunta); ?>)" id="botmostrarcon" class="btn btn-warning" style="margin:20px;float:left">Anterior</button>

                              <button onclick="mostrar_siguiente(<?php echo ($obj2->idpregunta); ?>)" id="botocultarcon" class="btn btn-success" style="margin:20px;float:right">Siguiente</button>

                            </div>
                          <?php } ?>

                        </div>
                      </div>
                    </div>
                  <?php
                } else { ?>
                    <div class="form-group" id="<?php echo ($obj2->idpregunta); ?>" hidden style="position:relative;">
                      <h4 class="text-justify" style="font-weight:bolder;"><?php print($obj2->idpregunta . ".-  " . $obj2->texto); ?></h4>
                      <div class="row-fluid">
                        <div class="radio">
                          <label>

                            <h4><input class="calc" name="'radioa<?php printf($obj2->idpregunta); ?>'" type="radio" value="<?php printf($obj2->valor1);  ?>" checked />
                              <p style="color:<?php if ($obj2->valor1 == 1) {
                                                print($respcolor);
                                              } else {
                                                print "";
                                              } ?>"><?php printf($obj2->respuesta1); ?></p>
                            </h4>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <h4><input class="calc" name="'radioa<?php printf($obj2->idpregunta); ?>'" type="radio" value="<?php printf($obj2->valor2); ?>" />
                              <p style="color:<?php if ($obj2->valor2 == 1) {
                                                print($respcolor);
                                              } else {
                                                print "";
                                              } ?>"><?php printf($obj2->respuesta2); ?></p>
                            </h4>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <h4><input class="calc" name="'radioa<?php printf($obj2->idpregunta); ?>'" type="radio" value="<?php printf($obj2->valor3); ?>" />
                              <p style="color:<?php if ($obj2->valor3 == 1) {
                                                print($respcolor);
                                              } else {
                                                print "";
                                              } ?>"><?php printf($obj2->respuesta3); ?></p>
                            </h4>
                          </label>

                        </div>

                        <div class="form-group">
                          <?php if ($obj2->idpregunta == 1) { ?>
                            <div>

                              <button onclick="mostrar_siguiente(<?php echo ($obj2->idpregunta); ?>)" id="botocultarcon" class="btn btn  btn-success" style="margin:20px;float:right">Siguiente</button>

                            </div>
                          <?php } elseif ($obj2->idpregunta == 100) { ?>

                            <div>
                              <button onclick="mostrar_anterior(<?php echo ($obj2->idpregunta); ?>)" id="botmostrarcon" class="btn btn-warning" style="margin:20px;float:left">Anterior</button>

                            </div>
                          <?php } else { ?>
                            <div>

                              <button onclick="mostrar_anterior(<?php echo ($obj2->idpregunta); ?>)" id="botmostrarcon" class="btn btn-warning" style="margin:20px;float:left">Anterior</button>

                              <button onclick="mostrar_siguiente(<?php echo ($obj2->idpregunta); ?>)" id="botocultarcon" class="btn btn-success" style="margin:20px;float:right">Siguiente</button>

                            </div>


                          <?php } ?>

                        </div>
                      </div>
                    </div>


                  <?php
                }
              }

              /* Liberar el conjunto de resultados*/
              $resultado2->close();
            }
            ?>

            </div>

            <!-- FIN ÁREA 1-->



            <label style="margin-left:10px" for="navpreg">Ir a la pregunta:</label><br>
            <select style="width:300px" name="navpreg" id="navpreg" onchange="mostrar_preg(this.selectedIndex)" class="form-control">

              <?php
              $consulta4 = ("SELECT idUsuario,idpregunta,texto, respuesta1, valor1, respuesta2, valor2, respuesta3, valor3, idArea FROM examen WHERE  idArea = 1 AND idUsuario='$var' ORDER BY idpregunta");
              $resultado4 = $mysqli->query($consulta4);
              $contador = 1;
              while ($contador <= 100) {
                ?>
                <option value="<?php echo ($contador + 1) ?>"> Pregunta <?php echo (" " . $contador) ?> </option>
                <?php
                $contador = $contador + 1;
              }

              ?>

            </select>



            <div class="col-md-3 col-md-offset-9">
              <ul class="nav nav-pills">
                <li class="active"><span class="label label-info">Preguntas</span><span class="badge"><?php print(A1); ?></span></li>
                <li class="active"><span class="label label-info badge1">Contestadas</span><span class="badge cambiar1">0</span></li>
              </ul>
            </div>
            <div class="col-md-12">
              <br>

            </div>



            <form id="formexamen">
              <!-- EVALUAR INICIO-->
              <input type="text" name="sum" hidden />


              <div class="form-group" name="finalizar">
                <div class="col-md-12">

                  <button type="button" class="btn  btn-danger btn-block" value="green" onclick="rgResult(); mostrar_botpreg();">Finalizar examen</button>
                </div>
              </div>
            </form>
            <div class="col-md-12" id="mensaje"></div><!-- EVALUAR FIN-->
          </div>
        </div>





      </div> <!-- FIN DIV ROW-FLUID -->

      <div class="col-md-12 text-center" style="background:gray;margin-top:2%;">

        <div style="display:inline;padding:2%;">

          <p style="color:white; margin:2%;">
            <h4 style="color:white;">Propietario: Roberto Ortiz Vasquez <br><br> © 2019 - COMDEV</h4>
          </p>
        </div>

      </div>
  </body>
  </div> <!-- FIN DIV CONTAINER -->


  <div class="row">&nbsp;</div>
<?php
} else {
  echo "<div class=\"alert alert-dismissible alert-warning container\">              
              <h1>Error!  :(</h1>
              <button type=\"button\" style=\"background:#04A2D0;float: right;\"class=\"btn  btn-blue\" onclick=\"location.href='panel-aspirante.php'\" >Volver</button>
              </div>";
}
?>



<script type="text/javascript">
  var num = 5400;

  function contador() {
    num--;
    if (num == 900) {
      alert("Quedan 5 minutos!!");

    } else {
      if (num == 0) {
        alert("EL TIEMPO SE A AGOTADO!!");
        location = 'panel-aspirante.php';
      }
    }
    document.getElementById('seg').innerHTML = num;
  }
</script>

<script>
  function mostrar_siguiente(id) {

    var sig = id + 1;
    var str1 = "#";
    var idstr = str1.concat(id);
    var sigstr = str1.concat(sig);

    $(idstr).hide();
    $(sigstr).show();

  }
</script>

<script>
  function mostrar_anterior(id) {

    var ant = id - 1;
    var str2 = "#";
    var idstr = str2.concat(id);
    var antstr = str2.concat(ant);

    $(idstr).hide();
    $(antstr).show();

  }
</script>

<script>
  function mostrar_preg(id) {
    var str2 = "#";
    var idstr = str2.concat(id + 1);
    var pregstr = "";

    for (let i = 0; i <= 100; i++) {
      if (i != id + 1) {
        pregstr = str2.concat(i);
        $(pregstr).hide();
      } else {
        $(idstr).show();
      }
    }
  }
</script>

<script>
  function mostrar_botpreg() {
    // $("#botonres").show();
    document.getElementById('botonres').style.display = "block";
  }
</script>






</html>