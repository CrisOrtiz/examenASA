<?php
    session_start();
    $idPregunta=$_POST['idPregunta'];
    $txt=$_POST['txt'];
    $r1=$_POST['r1'];
    $r2=$_POST['r2'];
    $r3=$_POST['r3'];
    $val1=$_POST['val1'];
    $val2=$_POST['val2'];
    $val3=$_POST['val3'];
    $ida=$_POST['ida'];

   

    

    require "acceso_mysqli.php";
    
    $sql="UPDATE pregunta 
    SET texto = '$txt', respuesta1 = '$r1',respuesta2 = '$r2',respuesta3 = '$r3', valor1=$val1 ,valor2=$val2,valor3=$val3,idArea=$ida
    WHERE idPregunta=$idPregunta;";

    $resultado = $mysqli->query($sql);


    if($resultado){
        header('Location: panel-administracion.php');
    }else{
        die (mysqli_error($mysqli));
       header('Location: panel-administracion.php');
    }
    
?>

