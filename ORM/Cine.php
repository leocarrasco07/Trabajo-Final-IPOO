<?php

    class Cine extends Funciones {
        
        private $genero;
        
        private $origen;
        
        public function __construct() {
            parent::__construct();
            $this->genero = "";
            $this->origen = "";
        }
        
        /**
         * @return mixed
         */
        public function getGenero()
        {
            return $this->genero;
        }
    
        /**
         * @return mixed
         */
        public function getOrigen()
        {
            return $this->origen;
        }
    
        /**
         * @param mixed $genero
         */
        public function setGenero($genero)
        {
            $this->genero = $genero;
        }
    
        /**
         * @param mixed $origen
         */
        public function setOrigen($origen)
        {
            $this->origen = $origen;
        }
        
      
        
        //
        //
        // METODOS BASE DE DATOS 
        //
        //
        
        /*
        public function Cargar($idFunc, $objTeatro, $nombre, $horaInicio, $durac, $precio, $genero, $origen) {
            parent::Cargar($idFunc, $objTeatro, $nombre, $horaInicio, $durac, $precio);
            $this->setGenero($genero);
            $this->setOrigen($origen);
        }
        */
        //nuevo metodo cargar como parametro un array asociativo
        
        public function Cargar($datosCine){
            parent::Cargar($datosCine);
            $this->setGenero($datosCine['genero']);
            $this->setOrigen($datosCine['paisOrigen']);
        }
        
        
        
        public function Buscar($id) {
            $baseDatos = new BaseDatos();
            $consultaBD = "SELECT * FROM Cine WHERE id_Funciones=".$id;
            $resp = false;
            
            if ($baseDatos->Iniciar()) {
                if ($baseDatos->Ejecutar($consultaBD)) {
                    if ($fila = $baseDatos->Registro()) {
                        parent::Buscar($id);  
                        $this->setGenero($fila['genero']);
                        $this->setOrigen($fila['paisOrigen']);
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
        
        // arreglar 
        
        public static function Listar($condicion = "") {
            $colCine = null;
            $baseDatos = new BaseDatos();
            $consultaBD = "SELECT * FROM Cine NATURAL JOIN Funciones";
            if ($condicion !=""){
                $consultaBD = $consultaBD . ' WHERE '.$condicion;
            }
            //echo $consultaBD;
            if ($baseDatos->Iniciar()) {
                if ($baseDatos->Ejecutar($consultaBD)) {
                   $colCine = array();
                   while ($fila = $baseDatos->Registro()) {
                       $objCine = new Cine();
                       $objCine->Buscar($fila['id_Funciones']);
                       //$objCine->Cargar($fila);
                       array_push($colCine, $objCine);
                       
                   }
                }else {
                    //$this->setMsjError($baseDatos->getError());
                }
            }else {
                //$this->setMsjError($baseDatos->getError());
            }
            return $colCine;
        }
        
        
        public function insertar() {
            $baseDatos = new BaseDatos();
            $resp = false;
            if (parent::insertar()) {
                $consultaBD  = "INSERT INTO Cine (id_Funciones, paisOrigen, genero)
                        VALUES (".parent::getIdFunciones().",'".$this->getOrigen()."','".$this->getGenero()."')";
                //echo $consultaBD."\n";
            }          
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
        
        public function Modificar() {           
            $baseDatos = new BaseDatos();
            $resp = false;
            
            if (parent::Modificar()) {
                $consultaBD = "UPDATE Cine SET paisOrigen='".$this->getOrigen()."',genero='".$this->getGenero()."' WHERE id_Funciones=".parent::getIdFunciones();
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
            }
            return $resp;
        }
        
        public function Eliminar() {
            $baseDatos = new BaseDatos();
            $resp = false;
            
            if ($baseDatos->Iniciar()) {
                $consultaBD = "DELETE FROM Cine WHERE id_Funciones=".parent::getIdFunciones();
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
        
        // METODOS DE CLASE
        
        public function obetenerCosto() {
            $precio = parent::obtenerCosto();
            $precio = $precio + (($precio * 65) /100);
            return  $precio;
        }
    
        public function __toString() {
            $resp = parent::__toString();
            $resp = $resp . "Genero: ".$this->getGenero()."\n".
                    "Origen: ".$this->getOrigen()."\n";
            return $resp;
        } 
    }