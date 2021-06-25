<?php


class ObraTeatral extends Funciones {
    
    
    
    public function __construct() {
        parent::__construct();
    }
    
    //
    //
    //METODOS BASE DE DATOS
    //
    //
    
    /*
    public function Cargar($idFunc, $idTeatro, $nombre, $horaInicio, $durac, $precio) {
        parent::Cargar($idFunc, $idTeatro, $nombre, $horaInicio, $durac, $precio);
    }
    */
    // Carga a traves de un array asociativo
    
    public function Cargar($datosObra){
        parent::Cargar($datosObra);
    }
    
    public function Buscar($id) {
        $baseDatos = new BaseDatos();
        $consultaBD = "SELECT * FROM obraTeatral WHERE id_Funciones=".$id;
        $resp = false;
        
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaBD)) {
                if ($baseDatos->Registro()) {
                    parent::Buscar($id);
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
        
        return  $resp;
    }
    
    
    public static function Listar($condicion = "") {
        $colObraTeatral = null;
        $baseDatos = new BaseDatos();
        $consultaBD = "SELECT * FROM obraTeatral NATURAL JOIN Funciones ";
        if ($condicion !="") {
            $consultaBD = $consultaBD . ' WHERE ' . $condicion;
        }
        //echo $consultaBD;
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaBD)) {
                $colObraTeatral = array();
                while ($fila = $baseDatos->Registro()) {
                    $obraTeatral = new ObraTeatral();
                    $obraTeatral->Buscar($fila['id_Funciones']);
                    array_push($colObraTeatral, $obraTeatral);
                }
            }
            else {
                //$this->setMsjError($baseDatos->getError());
            }
        }
        else {
            //$this->setMsjError($baseDatos->getError());
        }
        return $colObraTeatral;
    }
    
    public function insertar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        
        if(parent::insertar()){
            $consultaBD = "INSERT INTO obraTeatral (id_Funciones) VALUES (". parent::getIdFunciones().")";
            if ($baseDatos->Iniciar()) {
                if ($baseDatos->Ejecutar($consultaBD)) {
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
    
    public function Modificar() {
        $resp = false;
        $baseDatos = new BaseDatos();
        
        if (parent::Modificar()) {
            $resp = true;
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
            $consultaBD = "DELETE FROM ObraTeatral WHERE id_Funciones=".parent::getIdFunciones();
            if ($baseDatos->Ejecutar($consultaBD)) {
                if (parent::Eliminar()) {
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
    
    
    public function obetenerCosto() {
        $precio = parent::obtenerCosto();
        $precio = $precio + (($precio * 45) /100);
        return  $precio;
    }
    
    public function __toString() {
        $resp = parent::__toString();
        return $resp;
    }
    
}