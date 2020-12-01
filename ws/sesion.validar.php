<?php
require_once "../logica/Sesion.clase.php";

if(!isset($_POST["correo"]) || !isset($_POST["clave"])){
    Funciones::imprimeJSON(500,"Falta completar los datos requeridos","");
    exit();
}

$correo = $_POST["correo"];
$clave = $_POST["clave"];

try{
    $objSesion = new Sesion();
    $objSesion->setCorreo($correo);
    $objSesion->setClave($clave);
    $resultado = $objSesion->validarSesion();
    //exit(var_dump($resultado));
    
    /*
    $foto = $objSesion->obtenerFoto($resultado["sexo"]);
    $resultado["foto"]=$foto;
    */

    if($resultado["estado"]==200)
    {
        //Generar token de seguridad
        require_once "token.generar.php";
        $token = generarToken(null, 60*60);
        $resultado["token"]=$token;
        Funciones::imprimeJSON(200,"Bienvenido al sistema web de Auditorías",$resultado);

    }else
    {
        Funciones::imprimeJSON(500,$resultado["nombre"],"");

    }

}catch(Exception $ex){
    Funciones::imprimeJSON(500,$ex->getMessage(),"");
}