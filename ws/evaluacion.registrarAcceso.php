<?php

require_once '../logica/Evaluacion.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';


if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id_usuario"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un ID del Usuario","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id_evaluacion"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar el ID de la Evaluación.","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

$token =$_POST["token"];
$idUsuario = $_POST["id_usuario"];
$idEvaluacion = $_POST["id_evaluacion"];

try{
    if(validarToken($token)){
        $objE = new Evaluacion();
        $objE->setIdUsuario($idUsuario);
        $objE->setId($idEvaluacion);
       
        $resultado = $objE->registrarAccesoEvaluacion();

        Funciones::imprimeJSON(200,"Acceso a evaluación registrada con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}