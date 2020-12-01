<?php

require_once '../logica/Empresa.clase.php';
require_once '../util/funciones/Funciones.clase.php';

$token =$_POST["token"];

try{
    $objE = new Empresa();
    $resultado = $objE -> listarDetallesEmpresa();
    Funciones::imprimeJSON(200,"",$resultado);

}catch (Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}
