<?php
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/Modelo/Dao/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/Modelo/Beans/pregunta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/Modelo/Dao/procesaParametros.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/Modelo/Dao/pregunta/preguntaSql.php';
class preguntaDao
{
    private $con;
    private $mensaje;

    function __construct() {
        $this->con=  conexion::conectar();
    }
    function __destruct() {
        $this->con->close();
    }    

    function  registrarPreguntaDao($pregunta)
    {        

        $datosArray=array($pregunta->txt,$pregunta->r1,$pregunta->val1,$pregunta->r2,$pregunta->val2,$pregunta->r3,$pregunta->val3,$pregunta->ida);

        $st=  procesaParametros::PrepareStatement(preguntasSql::registrarPregunta(),$datosArray);

        $query=$this->con->query($st);
        if($query!=false){            
          $mensaje='<div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Bien hecho!</strong> Tu pregunta ha sido registrada correctamente.
          </div>';                  
          return $mensaje;          
        }
          $mensaje='<div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4>Error!</h4>
          <p>Ocurrio un error, intentalo de nuevo.</p>
          </div>';  
          return $mensaje;
    }

    function traeDatosPreguntaDao($datos){
        $datosArray = array ($datos->idPregunta);
        $Pp = procesaParametros::PrepareStatement(preguntaSql::traerDatosIdSql(), $datosArray);
        $query= $this->con->query($Pp);                  
        $query->data_seek(0);
        $row=$query->fetch_array();
        $lista= new pregunta();
        $lista-> idPregunta =$row['idPregunta'];
        $lista-> texto =$row['txt'];
        $lista-> respuesta1 =$row['r1'];
        $lista-> valor1 =$row['val1'];
        $lista-> respuesta2 =$row['r2'];
        $lista-> valor2 =$row['val2']; 
        $lista-> respuesta3 =$row['r3'];
        $lista-> valor3 =$row['val3']; 
        return $lista;
      }

      function actualizarPreguntaDao($pregunta){
        $datosArray=array($pregunta->txt,$pregunta->r1,$pregunta->val1,$pregunta->r2,$pregunta->val2,$pregunta->r3,$pregunta->val3);

        $st=  procesaParametros::PrepareStatement(preguntasSql::actualizarPregunta(),$datosArray);

        $query=$this->con->query($st);
        if($query!=false){            
          $mensaje='<div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Bien hecho!</strong> Cambios guardados correctamente.
          </div>';                  
          return $mensaje;          
        }
          $mensaje='<div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4>Error!</h4>
          <p>Ocurrio un error, intentalo de nuevo.</p>
          </div>';  
          return $mensaje;
    }
}
?>
