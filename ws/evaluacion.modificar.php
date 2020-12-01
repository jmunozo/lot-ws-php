<?php

require_once '../logica/Evaluacion.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';


if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar el ID de la Evaluación","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["num_expediente"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar el número de expediente","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

$token =$_POST["token"];
$id =$_POST["id"];
$estado = $_POST["estado"];
$numExpediente = $_POST["num_expediente"];

try{
    if(validarToken($token)){
        $objE = new Evaluacion();
        $objE->setId($id);
        $objE->setEstado($estado);
        $objE->setNumExpediente($numExpediente);
       
        $resultado = $objE->modificarEvaluacion();

        Funciones::imprimeJSON(200,"Evaluación modificada con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}