<?php session_start(); 
require_once 'acceso_mysqli.php';

$idPregunta=$_GET['idPregunta'];




?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>ASA - BOLIVIA administrador</title>
  <!--CSS-->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-responsive.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <!--Javascript-->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/carga.js"></script>
  <!-- ICONO-->
  <link rel="icon" type="image/ico" href="img/LOGOAVION.ico" style="border-radius:20px">
  <!--CSS-->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  <!--Javascript-->
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/aspirantejs.js"></script>
  <script src="js/preguntajs.js"></script>
  <script src="js/areajs.js"></script>

  <script type="text/javascript">
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    var f = new Date();
    document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
  </script>
</head>

<body>
  <?php
  if (isset($_SESSION['nombre']) && $_SESSION['status'] == 0) {
    require_once "acceso_mysqli.php";
    ?>


    <nav class="navbar navbar-default navbar-fixed">
      <div class="container-fluid">
        <div class="navbar-header menu">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">ASA - BOLIVIA</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><i aria-hidden="true"></i><span class="sr-only">(current)</span></a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">BIENVENIDO: <?php echo $_SESSION['nombre']; ?></a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> Salir</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-left ">
            <li><a href="panel-administracion.php"> <i class="fa fa-angle-right fa-2x" aria-hidden="true"></i> Inicio</a></li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="row-fluid" id="mensaje"></div>

    <div class="container">
      <?php
        $sql="SELECT * FROM pregunta WHERE idPregunta=$idPregunta";
        $resultado = $mysqli->query($sql);
        $datos = $resultado->fetch_object();
    ?>
            <form id="formpregunta" action="updatepreg.php" method="POST">
                <fieldset>
                    <legend>Registro de preguntas</legend>
                    <div class="form-group">

                    <div class="col-lg-2" >
                      <div class="form-group">
                          <label for="idPregunta" class="control-label">id Pregunta</label>
                          <textarea class="form-control" rows="6" id="idPregunta" name="idPregunta" maxlength="10"><?php echo($idPregunta);?></textarea>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-group">
                          <label for="txt" class="control-label">Pregunta</label>
                          <textarea class="form-control" rows="6" id="txt" name="txt" maxlength="1000"><?php echo($datos->texto);?></textarea>
                      </div>
                    </div>
                    

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="r1" class="control-label">Respuesta inciso A</label>
                            <textarea class="form-control" rows="3" id="r1" name="r1" maxlength="500"><?php echo($datos->respuesta1);?></textarea>
                            <span class="help-block"><p class="text-info">Escribe la primer posible respuesta.</p></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="r2" class="control-label">Respuesta inciso B</label>
                            <textarea class="form-control" rows="3" id="r2" name="r2" maxlength="500"><?php echo($datos->respuesta2);?></textarea>
                            <span class="help-block"><p class="text-info">Escribe la segunda posible respuesta.</p></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="r3" class="control-label">Respuesta inciso C</label>
                            <textarea class="form-control" rows="3" id="r3" name="r3" maxlength="500"><?php echo($datos->respuesta3);?></textarea>
                            <span class="help-block"><p class="text-info">Escribe la tercer posible respuesta.</p></span>
                        </div>
                    </div>
                   
                    <div class="col-lg-12">
                      <h3 class="text-info">Selecciona cual va ser la respuesta correcta, solo una debe ser la correcta.</h3>
                    </div>
                    <?php if($datos->valor1==1){?>
                      <div class="col-lg-2 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso A</label>

                          <div class="radio">
                            <label>
                              <input name="val1" id="val1" type="radio" value="1" checked/>
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val1" id="val1" type="radio" value="0" />
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso B</label>

                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="1" />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="0" checked/>
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso C</label>

                          <div class="radio">
                            <label>
                              <input name="val3" id="val3"type="radio" value="1" />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val3" id="val3" type="radio" value="0" checked/>
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <?php }elseif($datos->valor2==1){ ?>
                      <div class="col-lg-2 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso A</label>

                          <div class="radio">
                            <label>
                              <input name="val1" id="val2" type="radio" value="1" />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val1" id="val1" type="radio" value="0" checked />
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso B</label>

                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="1" checked />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="0" />
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso C</label>

                          <div class="radio">
                            <label>
                              <input name="val3" id="val3" type="radio" value="1" />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val3" id="val3" type="radio" value="0" checked/>
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <?php }elseif($datos->valor3==1){?>

                      <div class="col-lg-2 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso A</label>

                          <div class="radio">
                            <label>
                              <input name="val1" id="val1" type="radio" value="1" />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val1" id="val1" type="radio" value="0" checked/>
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso B</label>

                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="1"  />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="0" checked />
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso C</label>

                          <div class="radio">
                            <label>
                              <input name="val3" id="val3" type="radio" value="1" checked/>
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val3" id="val3"  type="radio" value="0" />
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <?php }else{?>
                      <div class="col-lg-2 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso A</label>

                          <div class="radio">
                            <label>
                              <input name="val1" id="val2" type="radio" value="1" />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val1" id="val1" type="radio" value="0" checked/>
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso B</label>

                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="1"  />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val2" id="val2" type="radio" value="0"  checked/>
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                          <label class="control-label">Valor del inciso C</label>

                          <div class="radio">
                            <label>
                              <input name="val3" id="val3" type="radio" value="1" />
                              Correcta
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="val3" id="val3" type="radio" value="0" checked />
                              Incorrecta
                            </label>
                          </div>

                        </div>
                    </div>
                    <?php }?> 
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="control-label">Area</label>
                          <div class="col-lg-12">
                          <div class="radio">
                            <label>
                              <input name="ida"id="ida"  type="radio" value="1" checked/>
                              A. Examen ASA Bolivia
                            </label>
                          </div>
                          
                        </div>
                    </div> 
                    <div class="col-lg-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"  >Guardar</button>
                      </div>
                    </div>

                    </div>
                </fieldset>
            </form>
        </div>
        <div class="row">&nbsp;</div>
        <div class="col-lg-8 col-lg-offset-2" id="mensaje"></div>


    <div class="col-md-12 text-center">
      <blockquote>
        <h2>Evaluar...</h2>
        <p>Una buena medida para educar mejor.</p>
      </blockquote>
    </div>

    <div class="col-md-12 text-center" style="background:#212121;;">

      <div style="display:inline;padding:2%;">

        <p style="color:white; margin:2%;">
          <h4 style="color:white;">Propietario: Roberto Ortiz Vasquez <br><br> © 2019 - COMDEV</h4>
        </p>
      </div>

    </div>

    </div>

  <?php
} else {
  echo "<h3 class=\"text-warning text-center\">Estas accediendo a una pagina restringida, para ver su contenido debes tener acceso.</h3>
       <br/>
       <p>
       <a href='index.php'><h3 class=\"text-center\">Aceptar</h3></a>
       </p>";
}
?>
</body>

</html>