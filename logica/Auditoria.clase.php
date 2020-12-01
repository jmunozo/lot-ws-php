<?php

require_once '../datos/Conexion.clase.php';

class Auditoria extends Conexion{

    private $id;
    private $idEmpresa;
    private $idTipoAuditoria; 
    private $idAuditorLider;
    private $fecha;
    private $codigoNace;
    private $criterios;
    private $objetivos;
    private $auditores;
    private $auditoresPracticantes;
    private $expertosTecnicos;
    private $observadores;
    private $resumenProcesos;
    private $fechaEntregaInforme;
    private $numInforme;
    private $descripcion;
    private $estado;

    private $detalleNorma; //Recibe el json del detalle de la norma


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this-> id = $id;
    }

    public function getIdEmpresa() {
        return $this->idEmpresa;
    }

    public function  setIdEmpresa($idEmpresa){
        $this-> idEmpresa = $idEmpresa;
    }

    public function getIdTipoAuditoria(){
        return $this->idTipoAuditoria;
    }

    public function  setIdTipoAuditoria($idTipoAuditoria){
        $this-> idTipoAuditoria = $idTipoAuditoria;
    }

    public function  getIdAuditorLider(){
        return $this->idAuditorLider;
    }

    public function setIdAuditorLider($idAuditorLider) {
        $this-> idAuditorLider = $idAuditorLider;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getCodigoNace() {
        return $this->codigoNace;
    }

    public function setCodigoNace($codigoNace){
        $this-> codigoNace = $codigoNace;
    }

    public function getCriterios() {
        return $this-> criterios;
    }

    public function setCriterios($criterios){
        $this->criterios = $criterios;
    }

    public function getObjetivos() {
        return $this-> objetivos;
    }

    public function setObjetivos($objetivos){
        $this-> objetivos = $objetivos;
    }

    public function getAuditores() {
        return $this->auditores;
    }

    public function setAuditores($auditores){
        $this->auditores = $auditores;
    }

    public function getAuditoresPracticantes() {
        return $this-> auditoresPracticantes;
    }

    public function setAuditoresPracticantes($auditoresPracticantes){
        $this-> auditoresPracticantes = $auditoresPracticantes;
    }

    public function getExpertosTecnicos() {
        return $this-> expertosTecnicos;
    }

    public function setExpertosTecnicos($expertosTecnicos){
        $this-> expertosTecnicos = $expertosTecnicos;
    }

    public function getObservadores() {
        return $this-> observadores;
    }

    public function setObservadores($observadores){
        $this-> observadores = $observadores;
    }

    public function getResumenProcesos() {
        return $this-> resumenProcesos;
    }

    public function setResumenProcesos($resumenProcesos){
        $this-> resumenProcesos = $resumenProcesos;
    }

    public function getFechaEntregaInforme() {
        return $this->fechaEntregaInforme;
    }

    public function setFechaEntregaInforme($fechaEntregaInforme){
        $this-> fechaEntregaInforme = $fechaEntregaInforme;
    }

    public function getNumInforme() {
        return $this-> numInforme;
    }

    public function setNumInforme($numInforme){
        $this-> numInforme = $numInforme;
    }

    public function getDescripcion() {
        return $this-> descripcion;
    }

    public function setDescripcion($descripcion) {
        $this-> descripcion = $descripcion;
    }

    public function getEstado() {
        return $this-> estado;
    }

    public function setEstado($estado){
        $this-> estado = $estado;
    }

    public function getDetalleNorma(){
        return $this -> detalleNorma;
    }

    public function setDetalleNorma($detalleNorma){
        $this -> detalleNorma = $detalleNorma;
    }
        
    public function  registrarAuditoria(){
        try{
            $sql = "select * from registrar_auditoria_json
            (
                :p_id_expediente_empresa, 
                :p_id_tipo_auditoria,
                :p_id_auditor_lider, 
                :p_detalle_norma
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_id_expediente_empresa",$this->getIdEmpresa());
            $sentencia -> bindParam(":p_id_tipo_auditoria",$this->getIdTipoAuditoria());
            $sentencia -> bindParam(":p_id_auditor_lider",$this->getIdAuditorLider());
            $sentencia -> bindParam(":p_detalle_norma",$this->getDetalleNorma());
           

            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function  modificarAuditoria(){
        try{
            $sql = "select * from modificar_auditoria_json(	
                :p_id,
                :p_id_expediente_empresa,
                :p_id_tipo_auditoria,
                :p_id_auditor_lider,
                :p_estado,
                :p_detalle_norma 
            )";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_id", $this->getId());
            $sentencia -> bindParam(":p_id_expediente_empresa", $this->getIdEmpresa());
            $sentencia -> bindParam(":p_id_tipo_auditoria",$this->getIdTipoAuditoria());
            $sentencia -> bindParam(":p_id_auditor_lider",$this->getIdAuditorLider());
            $sentencia -> bindParam(":p_estado",$this->getEstado());
            $sentencia -> bindParam(":p_detalle_norma",$this->getDetalleNorma());

            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function darBajaAuditoria(){
        try{
            $sql = "select * from darbaja_auditoria(:p_id )";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id",$this->getId());

            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }

    public function  listarAuditorias(){
        try{
            $sql = "select * from listar_auditorias()";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }
    
    //Funciones del módulo 1.1 Auditoría -> Editar  Auditoria//

    public function listarAuditoriasEnEditarAuditoria(){
        try{
            $sql = "select * from listar_auditorias_2(:p_id)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id",$this->getId());
            
            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }   

    public function  modificarAuditoriaEnEditarAuditoria(){
        try{
            $sql = "select * from modificar_auditoria_2(	
                :p_id,
                :p_fecha,
                :p_codigo_nace,
                :p_criterios,
                :p_objetivos,
                :p_auditores,
                :p_auditores_practicantes,
                :p_expertos_tecnicos,
                :p_observadores,
                :p_resumen_procesos,
                :p_fecha_entrega_informe,
                :p_num_informe,
                :p_descripcion,
                :p_estado
            )";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam( ":p_id",$this->getId());
            $sentencia -> bindParam( ":p_fecha",$this->getFecha());
            $sentencia -> bindParam( ":p_codigo_nace",$this->getCodigoNace());
            $sentencia -> bindParam( ":p_criterios",$this->getCriterios());
            $sentencia -> bindParam( ":p_objetivos",$this->getObjetivos());
            $sentencia -> bindParam( ":p_auditores",$this->getAuditores());
            $sentencia -> bindParam( ":p_auditores_practicantes",$this->getAuditoresPracticantes());
            $sentencia -> bindParam( ":p_expertos_tecnicos",$this->getExpertosTecnicos());
            $sentencia -> bindParam( ":p_observadores",$this->getObservadores());
            $sentencia -> bindParam( ":p_resumen_procesos",$this->getResumenProcesos());
            $sentencia -> bindParam( ":p_fecha_entrega_informe",$this->getFechaEntregaInforme());
            $sentencia -> bindParam( ":p_num_informe",$this->getNumInforme());
            $sentencia -> bindParam( ":p_descripcion",$this->getDescripcion());
            $sentencia -> bindParam( ":p_estado",$this->getEstado());

            $sentencia->execute();
            return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            throw $ex;
        }
    }   
 
}