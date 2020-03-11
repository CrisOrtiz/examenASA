<?php
session_start();

require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Beans/examen.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/examenBo.php';

switch ($_REQUEST['action']) {    
    case "evalua":
        $examen=new examen();    
        $examen->suma=$_POST['sum'];
        $examen->r1=$_POST['sum'];
                
        $examen->id= $_SESSION['idaspirante'];
        $bo=new examenBo();
        $r = $bo->registrarResultadoBo($examen);
        print($r);
        break;
}
?>