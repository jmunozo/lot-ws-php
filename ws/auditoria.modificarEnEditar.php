<?php

require_once '../logica/Auditoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'token.validar.php';

if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["id"])){
    Funciones::imprimeJSON(500,"Debe especificar el id de la auditoría a modificar","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["fecha"])){
    Funciones::imprimeJSON(500,"Debe especificar la fecha de la auditoría","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

if(!isset($_POST["codigo_nace"])){
    Funciones::imprimeJSON(500,"Debe especificar el código NACE de la auditoría","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}

$token =$_POST["token"];
$id = $_POST["id"];
$fecha = $_POST["fecha"];
$codigoNace =$_POST["codigo_nace"];
$criterios =$_POST["criterios"];
$objetivos = $_POST["objetivos"];
$auditores =$_POST["auditores"];
$auditoresPracticantes =$_POST["auditores_practicantes"];
$expertosTecnicos =$_POST["expertos_tecnicos"];
$observadores =$_POST["observadores"];
$resumenProcesos =$_POST["resumen_procesos"];
$fechaEntregaInforme =$_POST["fecha_entrega_informe"];
$numInforme =$_POST["num_informe"];
$descripcion =$_POST["descripcion"];
$estado =$_POST["estado"];

try{
    if(validarToken($token)){
        $objA = new Auditoria();
        $objA->setId($id);
        $objA->setFecha($fecha);
        $objA->setCodigoNace($codigoNace);
        $objA->setCriterios($criterios);
        $objA->setObjetivos($objetivos);
        $objA->setAuditores($auditores);
        $objA->setAuditoresPracticantes($auditoresPracticantes);
        $objA->setExpertosTecnicos($expertosTecnicos);
        $objA->setObservadores($observadores);
        $objA->setResumenProcesos($resumenProcesos);
        $objA->setFechaEntregaInforme($fechaEntregaInforme);
        $objA->setNumInforme($numInforme);
        $objA->setDescripcion($descripcion);
        $objA->setEstado($estado);
       
        $resultado = $objA->modificarAuditoriaEnEditarAuditoria();

        Funciones::imprimeJSON(200,"Auditoría modificada con éxito",$resultado);
    }else{
        Funciones::imprimeJSON(500,"TOKEN no registrado","");
    }
}catch(Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}