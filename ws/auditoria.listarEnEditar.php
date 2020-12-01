<?php

require_once '../logica/Auditoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

$token =$_POST["token"];
$id = $_POST["id"];

if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar el ID de auditoría","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

try{
    if(validarToken($token)){
        $objA = new Auditoria();
        $objA->setId($id);

        $resultado = $objA -> listarAuditoriasEnEditarAuditoria();
        Funciones::imprimeJSON(200,"LISTADO DE AUDITORIÍAS",$resultado);
    }else {
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch (Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}
