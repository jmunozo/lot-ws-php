<?php

require_once '../logica/Empresa.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["rep_legal"])){
    Funciones::imprimeJSON(500,"Debe especificar el representante legal de la Empresa","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

$token =$_POST["token"];
$id = $_POST["id"];
$repLegal = $_POST["rep_legal"];
$correo =$_POST["correo"];
$direccion =$_POST["direccion"];
$multisitio =$_POST["multisitio"];
$numTrabajadores =$_POST["num_trabajadores"];
$turno = $_POST["turno"];
$telefono = $_POST["telefono"];
$alcance = $_POST["alcance"];
$justiExclusion = $_POST["justi_exclusion"];
$gerenteGeneral = $_POST["gerente_general"];
$personaContacto = $_POST["persona_contacto"];
$estado = $_POST["estado"];

try{
    if(validarToken($token)){
        $objE = new Empresa();
        $objE->setId($id);
        $objE->setRepresentanteLegal($repLegal);
        $objE->setCorreo($correo);
        $objE->setDireccion($direccion);
        $objE->setMultisitio($multisitio);
        $objE->setNumTrabajadores($numTrabajadores);
        $objE->setTurno($turno);
        $objE->setTelefono($telefono);
        $objE->setAlcance($alcance);
        $objE->setJustificacionExclusion($justiExclusion);
        $objE->setGerenteGeneral($gerenteGeneral);
        $objE->setPersonaContacto($personaContacto);
        $objE->setEstado($estado);
       
        $resultado = $objE->modificarEmpresaEnAuditoria();

        Funciones::imprimeJSON(200,"Empresa modificada con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}