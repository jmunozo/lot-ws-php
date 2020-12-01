<?php

require_once '../logica/Empresa.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["razon_social"])){
    Funciones::imprimeJSON(500,"Debe especificar la razón social de la empresa","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}


$token =$_POST["token"];
$razonSocial = $_POST["razon_social"];
$ruc =$_POST["ruc"];
$pais =$_POST["pais"];
$direccion =$_POST["direccion"];
$telefono =$_POST["telefono"];

try{
    if(validarToken($token)){
        $objE = new Empresa();
        $objE->setRazonSocial($razonSocial);
        $objE->setRuc($ruc);
        $objE->setPais($pais);
        $objE->setDireccion($direccion);
        $objE->setTelefono($telefono);
       
        $resultado = $objE->registrarEmpresa();

        Funciones::imprimeJSON(200,"Empresa registrada con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}