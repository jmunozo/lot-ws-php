<?php

require_once '../logica/Empresa.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

$token =$_POST["token"];
$id =$_POST["id"];

try{
    if(validarToken($token)){
        $objE = new Empresa();
        $objE->setId($id);
    
        $resultado = $objE -> listarEmpresasEnAuditoria();
        Funciones::imprimeJSON(200,"",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch (Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}
