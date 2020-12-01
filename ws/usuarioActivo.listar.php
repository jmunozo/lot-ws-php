<?php

require_once '../logica/Usuario.clase.php';
require_once '../util/funciones/Funciones.clase.php';

$token =$_POST["token"];

try{
    $objU = new Usuario();
    $resultado = $objU -> listarUsuariosActivos();
    Funciones::imprimeJSON(200,"",$resultado);

}catch (Exception $e){
    Funciones::imprimeJSON(500,$e->getMessage(),"");
}