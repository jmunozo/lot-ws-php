<?php

require_once '../logica/Evaluacion.clase.php';
require_once '../util/funciones/Funciones.clase.php';

$token =$_POST["token"];

try{
    $objE = new Evaluacion();
    $resultado = $objE -> listarEvaluaciones();
    Funciones::imprimeJSON(200,"",$resultado);

}catch (Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}

