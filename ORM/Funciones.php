<?php

class Funciones {
    
    private $idFunciones;
    
    private $objTeatro;
    
    private $nombre;
    
    private $hora_inicio; // array indexado
    
    private $durac_Obra;  // array indexado
    
    private $precio;
    
    private $msjError;
    
    public function __construct() {
        $this->idFunciones = "";
        $this->objTeatro = "";
        $this->nombre = "";
        $this->hora_inicio = "" ;
        $this->durac_Obra = "" ;
        $this->precio = "";
        $this->msjError = "";
    }
    
    public function getIdFunciones() {
        return $this->idFunciones;
    }
    
    public function getObjTeatro() {
        return $this->objTeatro;
    }
    
    public function getMsjError() {
        return $this->msjError;
    }
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getHora_inicio()
    {
        return $this->hora_inicio;
    }

    /**
     * @return mixed
     */
    public function getDurac_Obra()
    {
        return $this->durac_Obra;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $hora_inicio
     */
    public function setHora_inicio($hora_inicio)
    {
        $this->hora_inicio = $hora_inicio;
    }

    /**
     * @param mixed $durac_Obra
     */
    public function setDurac_Obra($durac_Obra)
    {
        $this->durac_Obra = $durac_Obra;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    
    public function setIdFunciones($idFun) {
         $this->idFunciones = $idFun;
    }
    
    public function setObjTeatro($objTeatro) {
         $this->objTeatro = $objTeatro;
    }
    
    public function setMsjError($error) {
        $this->msjError = $error;
    }
    
    
    
    //
    //
    // METODOS BASE DE DATOS 
    //
    //
    
    
    
    
    public function Cargar($funcionDatos) {
        $this->setIdFunciones($funcionDatos['id_Funciones']);
        //$this->setObjTeatro($funcionDatos['id_Teatro']);
        $this->setNombre($funcionDatos['nombre_Funcion']);
        $this->setHora_inicio($funcionDatos['horaInicio']);
        $this->setDurac_Obra($funcionDatos['duracion']);
        $this->setPrecio($funcionDatos['precioPublico']);
        $objTeatro = new Teatro();
        $objTeatro->Buscar($funcionDatos['id_Teatro']);
        $this->setObjTeatro($objTeatro);
    }
    //busca una funcion con el id y las setea
    
    public function Buscar($id) {
        $baseDatos = new BaseDatos();
        $consultaBD = "SELECT * FROM Funciones WHERE id_Funciones=".$id;
        $resp = false;
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaBD)) {
                if ($fila = $baseDatos->Registro()) {
                    
                    //$this->Cargar($fila);
                    $this->setIdFunciones($id);                    
                    $this->setNombre($fila['nombre_Funcion']);
                    $this->setHora_inicio($fila['horaInicio']);
                    $this->setDurac_Obra($fila['duracion']);
                    $this->setPrecio($fila['precioPublico']);
                    $objTeatro = new Teatro();
                    $objTeatro->Buscar($fila['id_Teatro']);
                    $this->setObjTeatro($objTeatro);
                    
                    $resp = true;
                }
            }
            else {
                $this->setMsjError($baseDatos->getError());
            }
        }
        else {
            $this->setMsjError($baseDatos->getError());
        }
        
        return $resp;
    }
    
    //busca una funcion y las setea , luego las incorpora en una coleccion
    // $condidion tendria que ser el id del teatro, sino listaria todas las funciones
    
    
    public static function Listar($condicion = "") {
        $colFunciones = null;
        $baseDatos = new BaseDatos();
        $consultaBD = "SELECT * FROM Funciones ";
        if ($condicion != "") {
            $consultaBD = $consultaBD . ' WHERE '.$condicion;
        }
        $consultaBD.= " ORDER BY id_Funciones ";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaBD)) {
                $colFunciones = array();
                while ($fila = $baseDatos->Registro()) {
                  /* $idFunc = $fila['id_Funciones'];
                    $idTeatro = $fila['id_Teatro'];
                    $nombre = $fila['nombre_Funcion'];
                    $horaInicio = $fila['horaInicio'];
                    $durac = $fila['duracion'];
                    $precio = $fila['precioPublico']; */
                    
                    //$objTeatro = new Teatro();
                    //$objTeatro->Buscar($fila['id_Teatro']);
                    
                    $funcion = new Funciones();
                    $funcion ->Buscar($fila['id_Funciones']);
                    //$fila['objTeatro'] = $objTeatro; 
                    //$funcion->Cargar($fila);
                    array_push($colFunciones, $funcion);
                }
            }
            else {
                //$this->setMsjError($baseDatos->getError());
            }
        }
        else {
            //$this->setMsjError($baseDatos->getError());
        }
        
        return $colFunciones;
    }
    
    
    
    public function insertar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        $idTeatro = $this->getObjTeatro()->getIdTeatro();
        $consultaBD  = "INSERT INTO Funciones (id_Teatro, nombre_Funcion, horaInicio, duracion, precioPublico)
                        VALUES (".$idTeatro.",'".$this->getNombre()."','".$this->getHora_inicio()."','".$this->getDurac_Obra()."',".$this->obtenerCosto().")";
        if ($baseDatos->Iniciar()) {
            if ($id = $baseDatos->devuelveIDInsercion($consultaBD)) {
                $this->setIdFunciones($id);
                $resp = true;
            }
            else {
                $this->setMsjError($baseDatos->getError());
            }
        }
        else {
            $this->setMsjError($baseDatos->getError());
        }
        
        return $resp;
    }
    
    
    public function Modificar() {
        $resp = false;
        $baseDatos = new BaseDatos();
        $idTeatro = $this->getObjTeatro()->getIdTeatro();
        $consultaBD = "UPDATE Funciones SET id_Teatro =".$idTeatro.", nombre_Funcion='".$this->getNombre()."',horaInicio='".$this->getHora_inicio().
        "',duracion='".$this->getDurac_Obra()."',precioPublico=".$this->obtenerCosto()." WHERE id_Funciones=".$this->getIdFunciones();
        //echo $consultaBD."\n";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaBD)) {
                $resp = true;
            }
            else {
                $this->setMsjError($baseDatos->getError());
            }
        }
        else {
            $this->setMsjError($baseDatos->getError());
        }
        
        return $resp;
    }
    
    public function Eliminar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        
        if ($baseDatos->Iniciar()) {
            $consultaBD = "DELETE FROM Funciones WHERE id_Funciones=".$this->getIdFunciones();
            if ($baseDatos->Ejecutar($consultaBD)) {
                $resp = true;
            }
            else {
                $this->setMsjError($baseDatos->getError());
            }
        }
        else {
            $this->setMsjError($baseDatos->getError());
        }
        
        return $resp;
    }
    
    
    //
    //
    // METODOS DE CLASE
    //
    //
    
    
    
    public function DuracionFinal() {
        $horaInicio = $this->getHora_inicio();
        $horaI = strtotime($horaInicio);
        $duracion = $this->getDurac_Obra();
        $duracHora = strtotime($duracion);
        $horaDurac = date("H",$duracHora);
        $minDurac = date("i",$duracHora);
        $horaDuracAMin = $horaDurac * 60;
        $minutosTotales = $minDurac + $horaDuracAMin;
        
        $horarioFinal = strtotime('+'.$minutosTotales.' minute',$horaI);
        $horarioFinal = date("H:i", $horarioFinal);
        return $horarioFinal;
    }
    
    public function obtenerCosto() {
        $precio = $this->getPrecio();
        return $precio;
    }

    
    public function __toString() {
        $string = "ID Funcion = ".$this->getIdFunciones()."\n".
            "Nombre de la Funcion: ".$this->getNombre()."\n".
            //"Hora Inicio: ".$this->getHora_inicio()[0].":".$this->getHora_inicio()[1]."\n".
            "Hora Inicio: ".$this->getHora_inicio()."\n".
            //"Duracion: ".$this->getDurac_Obra()[0].":".$this->getDurac_Obra()[1]."\n".
            "Duracion: ".$this->getDurac_Obra()."\n".
            "Precio: ".$this->getPrecio()."\n";
        return $string;
    }
}