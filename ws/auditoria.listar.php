<?php

require_once '../logica/Auditoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';

$token =$_POST["token"];


/* if(!isset($_POST["token"])){//SE VERIFICA SI ENVIA TOKEN
    Funciones::imprimeJSON(500,"Debe especificar un Token","");//MENSAJE PARA EXIGIR UN TOKEN
    exit();
}*/

try{
    $objA = new Auditoria();
    $resultado = $objA -> listarAuditorias();
    Funciones::imprimeJSON(200,"",$resultado);

}catch (Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}
