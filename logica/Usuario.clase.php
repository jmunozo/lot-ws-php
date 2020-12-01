<?php

require_once '../datos/Conexion.clase.php';

class Usuario extends Conexion{

    private $id;
    private $rol;
    private $nombres; 
    private $correo;
    private $clave;
    private $estado;
    private $firma;
    private $pais;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
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

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFirma()
    {
        return $this->firma;
    }

    public function setFirma($firma)
    {
        $this->firma = $firma;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function registrarUsuario(){
        try{
            $sql = "select * from registrar_usuario_2
            (
                 :p_nombres,
                 :p_correo,
                 :p_clave,
                 :p_rol,
                 :p_firma,
                 :p_pais
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_nombres",$this->getNombres());
            $sentencia -> bindParam(":p_correo",$this->getCorreo());
            $sentencia -> bindParam(":p_clave",$this->getClave());
            $sentencia -> bindParam(":p_rol",$this->getRol());
            $sentencia -> bindParam(":p_firma",$this->getFirma());
            $sentencia -> bindParam(":p_pais",$this->getPais());

            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function modificarUsuario(){
        try{
            $sql = "select * from editar_usuario_2
            (
                :p_id,
                :p_nombres,
                :p_correo,
                :p_clave,
                :p_rol, 
                :p_firma,
                :p_pais,
                :p_estado
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_id", $this->getId());
            $sentencia -> bindParam(":p_nombres",$this->getNombres());
            $sentencia -> bindParam(":p_correo",$this->getCorreo());
            $sentencia -> bindParam(":p_clave",$this->getClave());
            $sentencia -> bindParam(":p_rol", $this->getRol());
            $sentencia -> bindParam(":p_firma",$this->getFirma());
            $sentencia -> bindParam(":p_pais",$this->getPais());
            $sentencia -> bindParam(":p_estado",$this->getEstado());

            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function darBajaUsuario(){
        try{
            $sql = "select * from darbaja_usuario_2(:p_id)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id",$this->getId());

            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    public function listarUsuariosActivos(){
        try{
            $sql = "select * from listar_usuarios()";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    public function listarUsuarios(){
        //Módulo 4.- Listar usuarios
        try{
            $sql = "select * from listar_usuarios_2()";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    public function listarUsuariosGeneral(){
        //Incluye toda la información (select * from usuario)
        try{
            $sql = "select * from listar_usuarios_general()";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    
}