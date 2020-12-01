<?php

require_once '../datos/Conexion.clase.php';

class Empresa extends Conexion{

    private $id;
    private $razonSocial;
    private $ruc; 
    private $representanteLegal;
    private $correo;
    private $direccion;
    private $multisitio;
    private $numTrabajadores;
    private $turno;
    private $telefono;
    private $alcance;
    private $justificacionExclusion;
    private $gerenteGeneral;
    private $personaContacto;
    private $estado;
    private $pais;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this-> id = $id;
    }

    public function getRazonSocial(){
        return $this->razonSocial;
    }

    public function setRazonSocial($razonSocial){
        $this-> razonSocial = $razonSocial;
    }

    public function getRuc() {
        return $this->ruc;
    }

    public function setRuc($ruc) {
        $this->ruc = $ruc;
    }

    public function getRepresentanteLegal() {
        return $this->representanteLegal;
    }

    public function setRepresentanteLegal($representanteLegal) {
        $this->representanteLegal = $representanteLegal;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getMultisitio() {
        return $this->multisitio;
    }

    public function setMultisitio($multisitio) {
        $this->multisitio = $multisitio;
    }

    public function getNumTrabajadores() {
        return $this->numTrabajadores;
    }

    public function setNumTrabajadores($numTrabajadores) {
        $this->numTrabajadores = $numTrabajadores;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getAlcance() {
        return $this->alcance;
    }

    public function setAlcance($alcance) {
        $this->alcance = $alcance;
    }

    public function getJustificacionExclusion() {
        return $this->justificacionExclusion;
    }

    public function setJustificacionExclusion($justificacionExclusion) {
        $this->justificacionExclusion = $justificacionExclusion;
    }

    public function getGerenteGeneral() {
        return $this->gerenteGeneral;
    }

    public function setGerenteGeneral($gerenteGeneral) {
        $this->gerenteGeneral = $gerenteGeneral;
    }

    public function getPersonaContacto() {
        return $this->personaContacto;
    }

    public function setPersonaContacto($personaContacto) {
        $this->personaContacto = $personaContacto;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public  function listarEmpresas(){
        try{
            $sql = "select * from listar_empresas_2()";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    public function registrarEmpresa(){
        try{
            $sql = "select * from registrar_empresa_2
            (
                :p_razon_social,
                :p_ruc,
                :p_pais,
                :p_direccion,
                :p_telefono,
                :p_estado
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_razon_social",$this->getRazonSocial());
            $sentencia -> bindParam(":p_ruc",$this->getRuc());
            $sentencia -> bindParam(":p_pais",$this->getPais());
            $sentencia -> bindParam(":p_direccion",$this->getDireccion());
            $sentencia -> bindParam(":p_telefono",$this->getTelefono());
            $sentencia -> bindParam(":p_estado",$this->getEstado()); 
            //Se inserta, porque habrá Empresas HISTÓRICAS con estados != ACTIVO;
           
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function modificarEmpresa(){
        try{
            $sql = "select * from editar_empresa_2(
                :p_id,
                :p_razon_social,
                :p_ruc,
                :p_pais,
                :p_direccion,
                :p_telefono,
                :p_estado
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_id", $this->getId());
            $sentencia -> bindParam(":p_razon_social",$this->getRazonSocial());
            $sentencia -> bindParam(":p_ruc",$this->getRuc());
            $sentencia -> bindParam(":p_pais",$this->getPais());
            $sentencia -> bindParam(":p_direccion",$this->getDireccion());
            $sentencia -> bindParam(":p_telefono",$this->getTelefono());
            $sentencia -> bindParam(":p_estado",$this->getEstado()); 

            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function darBajaEmpresa(){
        try{
            $sql = "select * from darbaja_empresa_2 (:p_id)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id",$this->getId());

            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    public function listarDetallesEmpresa(){
        try{
            $sql = "select * from listar_detalles_empresa()";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }
  
    //Funciones del módulo 1.1 Auditoría -> Listar Empresa en Auditoría//
       public function listarEmpresasEnAuditoria(){
        try{
            $sql = "select * from listar_empresas_2(:p_id )";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id",$this->getId());

            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    //Funciones del módulo 1.1 Auditoría -> Modificar Empresa en Auditoría//
    public function modificarEmpresaEnAuditoria(){
        try{
            $sql = "select * from modificar_empresa_2(	
                :p_id,
                :p_rep_legal,
                :p_correo,
                :p_direccion,
                :p_multisitio,
                :p_num_trabajadores,
                :p_turno,
                :p_telefono,
                :p_alcance,
                :p_justi_exclusion,
                :p_gerente_general,
                :p_persona_contacto,
                :p_estado
            )";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id",$this->getId());
            $sentencia -> bindParam( ":p_rep_legal",$this->getRepresentanteLegal());
            $sentencia -> bindParam( ":p_correo",$this->getCorreo());
            $sentencia -> bindParam( ":p_direccion",$this->getDireccion());
            $sentencia -> bindParam( ":p_multisitio",$this->getMultisitio());
            $sentencia -> bindParam( ":p_num_trabajadores",$this->getNumTrabajadores());
            $sentencia -> bindParam( ":p_turno",$this->getTurno());
            $sentencia -> bindParam( ":p_telefono",$this->getTelefono());
            $sentencia -> bindParam( ":p_alcance",$this->getAlcance());
            $sentencia -> bindParam( ":p_justi_exclusion",$this->getJustificacionExclusion());
            $sentencia -> bindParam( ":p_gerente_general",$this->getGerenteGeneral());
            $sentencia -> bindParam( ":p_persona_contacto",$this->getPersonaContacto());
            $sentencia -> bindParam( ":p_estado",$this->getEstado());

            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }  

}



