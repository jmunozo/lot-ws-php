<?php

require_once '../datos/Conexion.clase.php';

class Evaluacion extends Conexion{

    private $id;    //ID EVALUACIÓN
    private $fecha;
    private $estado; 
    private $numExpediente;

    private $idEmpresa; //FK de la TABLA EXPEDIENTE_EMPRESA;
    private $idUsuario; //FK de la TABLA USUARIO
   
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFecha()
    {
        return $this->rfecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getNumExpediente()
    {
        return $this->numExpediente;
    }

    public function setNumExpediente($numExpediente)
    {
        $this->numExpediente = $numExpediente;
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }


    public function registrarEvaluacion(){
        try{
            $sql = "select * from registrar_evaluacion_2
            (
                 :p_id_empresa,
                 :p_num_expediente
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_id_empresa",$this->getIdEmpresa());
            $sentencia -> bindParam(":p_num_expediente",$this->getNumExpediente());

            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function modificarEvaluacion(){
        try{
            $sql = "select * from editar_evaluacion_2
            (
                 :p_id,
                
                 :p_estado,
                 :p_num_expediente
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_id",$this->getId());
            $sentencia -> bindParam(":p_estado",$this->getEstado());
            $sentencia -> bindParam(":p_num_expediente",$this->getNumExpediente());

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

    /* -------- ACCESOS ------- */
    public function registrarAccesoEvaluacion(){
        try{
            $sql = "select * from registrar_acceso_evaluacion(
                    :p_id_usuario,     
                    :p_id_evaluacion
                    )";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id_usuario",$this->getIdUsuario());
            $sentencia -> bindParam( ":p_id_evaluacion",$this->getId());


            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function listarAccesosEvaluacion(){
        try{
            $sql = "select * from listar_accesos_evaluacion(:p_id_usuario)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_id_usuario", $this->getIdUsuario());

            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }       
    }
    
}