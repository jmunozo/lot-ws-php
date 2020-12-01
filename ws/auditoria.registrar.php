<?php

require_once '../logica/Auditoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id_expediente_empresa"])){
    Funciones::imprimeJSON(500,"Debe especificar el id del EXPEDIENTE de la empresa","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}
if(!isset($_POST["id_tipo_auditoria"])){
    Funciones::imprimeJSON(500,"Debe especificar el id del tipo de auditoría","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

$token =$_POST["token"];
$idEmpresa = $_POST["id_expediente_empresa"];
$idTipoAuditoria =$_POST["id_tipo_auditoria"];
$idAuditorLider =$_POST["id_auditor_lider"];
$detalleNorma =$_POST["detalle_norma"];

try{
    if(validarToken($token)){
        $objAuditoria = new Auditoria();
        $objAuditoria->setIdEmpresa($idEmpresa);
        $objAuditoria->setIdTipoAuditoria($idTipoAuditoria);
        $objAuditoria->setIdAuditorLider($idAuditorLider);
        $objAuditoria->setDetalleNorma($detalleNorma);
       
        $resultado = $objAuditoria->registrarAuditoria();

        Funciones::imprimeJSON(200,"Auditoría registrada con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}