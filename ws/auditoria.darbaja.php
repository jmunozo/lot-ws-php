<?php

require_once '../logica/Auditoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id"])){
    Funciones::imprimeJSON(500,"Debe especificar el id de la auditoria","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

$token =$_POST["token"];
$id = $_POST["id"];

try{
    if(validarToken($token)){
        $objAuditoria = new Auditoria();
        $objAuditoria->setId($id);
       
        $resultado = $objAuditoria->darBajaAuditoria();

        Funciones::imprimeJSON(200,"Auditoría dada de baja con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}