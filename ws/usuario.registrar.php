<?php

require_once '../logica/Usuario.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["nombres"])){
    Funciones::imprimeJSON(500,"Debe especificar los nombres del Usuario","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}


$token =$_POST["token"];
$nombres = $_POST["nombres"];
$correo =$_POST["correo"];
$clave =$_POST["clave"];
$rol =$_POST["rol"];
$firma =$_POST["firma"];
$pais =$_POST["pais"];

try{
    if(validarToken($token)){
        $objU = new Usuario();
        $objU->setNombres($nombres);
        $objU->setCorreo($correo);
        $objU->setClave($clave);
        $objU->setRol($rol);
        $objU->setFirma($firma);
        $objU->setPais($pais);
       
        $resultado = $objU->registrarUsuario();

        Funciones::imprimeJSON(200,"Usuario registrado con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}