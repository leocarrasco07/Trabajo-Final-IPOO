<?php

    class Musical extends Funciones {
        
        private $director;
        
        private $cantPersonasEnEscena;
        
        public function __construct() {
            parent::__construct();
            $this->director = "";
            $this->cantPersonasEnEscena = "";
        }
        
        /**
         * @return mixed
         */
        public function getDirector()
        {
            return $this->director;
        }
    
        /**
         * @return mixed
         */
        public function getCantPersonasEnEscena()
        {
            return $this->cantPersonasEnEscena;
        }
    
        /**
         * @param mixed $director
         */
        public function setDirector($director)
        {
            $this->director = $director;
        }
    
        /**
         * @param mixed $cantPersonasEnEscena
         */
        public function setCantPersonasEnEscena($cantPersonasEnEscena)
        {
            $this->cantPersonasEnEscena = $cantPersonasEnEscena;
        }
        
        
        //
        //
        // METODOS BASE DE DATOS
        //
        //
        
        /*
        public function Cargar($idFunc, $objTeatro, $nombre, $horaInicio, $durac, $precio, $director, $cantPersonasEnEscena) {
            parent::Cargar($idFunc, $objTeatro, $nombre, $horaInicio, $durac, $precio);
            $this->setDirector($director);
            $this->setCantPersonasEnEscena($cantPersonasEnEscena);
        }
        */
        //nuevo metodo cargar como parametro un arrayasociativo
        
        public function Cargar($datosMusical){
            parent::Cargar($datosMusical);
            $this->setDirector($datosMusical['director']);
            $this->setCantPersonasEnEscena($datosMusical['cantPersonas']);
        }
        
        
        public function Buscar($id) {
            $baseDatos = new BaseDatos();
            $resp = false;
            $consultaBD = "SELECT * FROM Musical WHERE id_Funciones=".$id;
            
            if ($baseDatos->Iniciar()) {
                if ($baseDatos->Ejecutar($consultaBD)) {
                    if ($fila = $baseDatos->Registro()) {
                        parent::Buscar($id);
                        $this->setDirector($fila['director']);
                        $this->setCantPersonasEnEscena($fila['cantPersonas']);
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
        
        // seguir 
        
        
        public static function Listar($condicion = "") {
            $colMusical = null;
            $baseDatos = new BaseDatos();
            $consultaBD = "SELECT * FROM Musical NATURAL JOIN Funciones";
            if ($condicion != "") {
                $consultaBD = $consultaBD . ' WHERE '. $condicion;
            }
            //echo $consultaBD;
            if ($baseDatos->Iniciar()) {
                if ($baseDatos->Ejecutar($consultaBD)) {
                    $colMusical = array();
                    while ($fila = $baseDatos->Registro()) {
                        $objMusical = new Musical();
                        $objMusical->Buscar($fila['id_Funciones']);
                        //$objMusical->Cargar($fila);
                        array_push($colMusical,$objMusical);
                    }
                }
            }
            return $colMusical;
        }
        
        
        
        public function insertar() {
            $baseDatos = new BaseDatos();
            $resp = false;
            
            if (parent::insertar()) {
                $consultaBD = "INSERT INTO Musical (id_Funciones, director, cantPersonas) 
                              VALUES (".parent::getIdFunciones().",'".$this->getDirector()."','".$this->getCantPersonasEnEscena()."')";
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
            }
            return $resp;
        }
        
        public function Modificar() {
            $baseDatos = new BaseDatos();
            $resp = false;
            
            if (parent::Modificar()) {
                $consultaBD = "UPDATE Musical SET director='".$this->getDirector()."', cantPersonas='".$this->getCantPersonasEnEscena()."' WHERE id_Funciones=".parent::getIdFunciones();
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
            }
            return $resp;
        }
        
        
        public function Eliminar() {
            $baseDatos = new BaseDatos();
            $resp = false;
            
            if ($baseDatos->Iniciar()) {
                $consultaBD = "DELETE FROM Musical WHERE id_Funciones=".parent::getIdFunciones();
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
            $precio = $precio + (($precio * 12) /100);
            return  $precio;
        }
        public function DuracionFinal() {

            $horaFinal = parent::DuracionFinal();
            return $horaFinal;
        }
                
    
        public function __toString() {
            $resp = parent::__toString();
            $resp = $resp . "Director: ".$this->getDirector()."\n".
                    "Cantidad De Personas en Escena: ".$this->getCantPersonasEnEscena()."\n";
            return $resp;
        }
        
    }