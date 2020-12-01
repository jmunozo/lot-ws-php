<?php
require_once "../datos/Conexion.clase.php";
class Sesion extends Conexion{
    private $correo;
    private $clave;

    public function validarSesion(){
        try{
            $sql = "select * from validar_sesion(:p_correo, :p_clave)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_correo",$this->getCorreo());
            $sentencia->bindParam(":p_clave",$this->getClave());
            $sentencia->execute();
            return $sentencia -> fetch(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    
    public function obtenerFoto($sexo){
        $foto="../imagenes-mantenimiento/".$sexo;
        if(file_exists($foto.".png")){
            $foto = $foto.".png";

        }else if(file_exists($foto.".PNG")){//tambien existe este tipo de formato de foto. Servidores Linux lo reconocen
            $foto = $foto.".PNG";
        }else if(file_exists($foto.".jpg")){
            $foto = $foto.".jpg";
        }else if(file_exists($foto.".JPG")){
            $foto = $foto.".JPG";
        }else{
            $foto == "none";
        }
        if($foto == "none"){
            return $foto;
        }else{
            return Funciones::$DIRECCION_WEB_SERVICE.$foto;
        }
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }


}
