<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ASA - BOLIVIA Aspirante</title>
    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- ICONO-->
    <link rel="icon" type="image/ico" href="img/LOGOAVION.ico" style="border-radius:20px">
    <!--Javascript-->
    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" language="javascript" src="js/carga.js"></script>   
    <script type="text/javascript">
    
      var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
      var f=new Date();
      document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
    </script> 
  </head>
  <body>
    <?php
    if(isset($_SESSION['nombre']) && $_SESSION['status'] == 1) {
      require_once "acceso_mysqli.php";
    ?>
    <div class="row-fluid text-center" style="background-color: #303F9F;">
      &nbsp;
    </div>
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
              <li class="active"><a href="#"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i><span class="sr-only">(current)</span></a></li>
            </ul>  
            <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> Salir</a></li>                             
            </ul>
            <ul class="nav navbar-nav navbar-right menu">
              <li><a><i class="fa fa-user fa-2x" aria-hidden="true"></i> BIENVENIDO: <?php echo $_SESSION['nombre']; ?></a></li>
              <li><a href="home.php"> <i class="fa fa-angle-right fa-2x" aria-hidden="true"></i> Inicio</a></li>
              <li><a href="inicioExamen.php"> <i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i> Examen</a></li>
              <li><a href="mostrarresultados.php"> <i class="fa fa-pie-chart  fa-2x" aria-hidden="true"></i> Resultados</a></li>        
            </ul>              
          </div>
        </div>
      </nav>

    <div class="panel panel-default">
      <div class="panel-body" id="detalles">
      <div class="row text-center" style="background-color: #F5F5F5">
      <h3>EXAMEN <br>LICENCIA<br>ASA - BOLIVIA</h3>
      <img src="img/LOGOAVION.jpg" style="border-radius:35%" alt="" width="519px" height="434px"/>

      
    </div>
      </div>
    </div>
      <div class="col-md-12 text-center ">
              <blockquote>
          <h2>Evaluar...</h2>
          <p>Una buena medida para educar mejor.</p>
        </blockquote>              
          </div>
      

    <div class="col-md-12 text-center" style="background:#212121;;">
      
      <div style="display:inline;padding:2%;">
        
        <p  style="color:white; margin:2%;"><h4 style="color:white;">Propietario: Roberto Ortiz Vasquez <br><br> © 2019 - COMDEV</h4></p>
      </div>
               
    </div>
    <?php
    }else {
       echo "<h3 class=\"text-warning text-center\">Estas accediendo a una pagina restringida, para ver su contenido debes tener acceso.</h3>
       <br/>
       <p>
       <a href='index.php'><h3 class=\"text-center\">Aceptar</h3></a>
       </p>"; }
    ?>
  </body>
</html>
