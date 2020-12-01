<?php

require_once '../logica/Evaluacion.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';


if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id_empresa"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un id de empresa","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["num_expediente"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar el número de expediente","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

$token =$_POST["token"];
$idEmpresa = $_POST["id_empresa"];
$numExpediente = $_POST["num_expediente"];

try{
    if(validarToken($token)){
        $objE = new Evaluacion();
        $objE->setIdEmpresa($idEmpresa);
        $objE->setNumExpediente($numExpediente);
       
        $resultado = $objE->registrarEvaluacion();

        Funciones::imprimeJSON(200,"Evaluación registrada con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}