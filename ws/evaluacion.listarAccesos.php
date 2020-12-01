<?php

require_once '../logica/Evaluacion.clase.php';
require_once '../util/funciones/Funciones.clase.php';

$idUsuario = $_POST["id_usuario"];

try{
    $objE = new Evaluacion();
    $objE->setIdUsuario($idUsuario);
    
    $resultado = $objE -> listarAccesosEvaluacion();

    Funciones::imprimeJSON(200,"",$resultado);

}catch (Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}

