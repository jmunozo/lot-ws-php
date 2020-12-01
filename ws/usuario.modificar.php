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
$id = $_POST["id"];
$nombres = $_POST["nombres"];
$correo =$_POST["correo"];
$clave =$_POST["clave"];
$rol =$_POST["rol"];
$firma =$_POST["firma"];
$pais =$_POST["pais"];
$estado =$_POST["estado"];

try{
    if(validarToken($token)){
        $objU = new Usuario();
        $objU->setId($id);
        $objU->setNombres($nombres);
        $objU->setCorreo($correo);
        $objU->setClave($clave);
        $objU->setRol($rol);
        $objU->setFirma($firma);
        $objU->setPais($pais);
        $objU->setEstado($estado);
       
        $resultado = $objU->modificarUsuario();

        Funciones::imprimeJSON(200,"Usuario modificado con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}