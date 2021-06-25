<?php

class Teatro {
    
    private $idTeatro; // nuevo atributo
    
    private $nombreTeatro;
    
    private $direccion;
    
    private $arrayFunciones;
    
    private $msjError; // nuevo Atributo
    
    public function __construct() {
        $this->idTeatro = "";
        $this->nombreTeatro = "";
        $this->direccion = "";
        $this->arrayFunciones = array();
        $this->msjError = "";
    }
    
    
    // GETTER Y SETTERS  
    
    public function getIdTeatro() {
        return $this->idTeatro;
    }
    
    /**
     * @return mixed
     */
    public function getNombreTeatro()
    {
        return $this->nombreTeatro;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @return mixed
     */
    public function getarrayFunciones()
    {   
        $condicion = 'id_Teatro = '.$this->getIdTeatro();
        //buscar coleccion de funciones
            $colFunciones= array();            
            $colCine = Cine::Listar($condicion);
            $colMusical = Musical::Listar($condicion);
            $colObraTeatral = ObraTeatral::Listar($condicion);
            
            if ($colCine != null) {
                for ($i = 0; $i < count($colCine); $i++) {
                    array_push($colFunciones,$colCine[$i]);
                }
            }
            if ($colMusical != null) {
                for ($i = 0; $i < count($colMusical); $i++) {                
                    array_push($colFunciones,$colMusical[$i]);                
                }
            }
            if ($colObraTeatral != null) {
                for ($i = 0; $i < count($colObraTeatral); $i++) {
                    array_push($colFunciones,$colObraTeatral[$i]);
                }
            }
            
            
        
        
        //$colFunciones = array_merge($colCine, $colMusical, $colObraTeatral);
        $this->setarrayFunciones($colFunciones);
        
        return $this->arrayFunciones;
    }
    
    public function getMsjError() {
        return $this->msjError;
    }
    
    public function setIdTeatro($nuevoID) {
        $this->idTeatro = $nuevoID;
    }

    /**
     * @param mixed $nombreTeatro
     */
    public function setNombreTeatro($nombreTeatro)
    {
        $this->nombreTeatro = $nombreTeatro;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @param mixed $Funciones
     */
    public function setarrayFunciones($Funciones)
    {
        $this->arrayFunciones = $Funciones;
    }
    
    public function setMsjError($msjError) {
        $this->msjError = $msjError;
    }
    
    
    
    
    // METODOS BASE DE DATOS
    
    
    public function cargarDatosTeatro($nombre, $direc, $Funciones) {
        $this->setNombreTeatro($nombre);
        $this->setDireccion($direc);
        $this->setarrayFunciones($Funciones);
    }
    
    //cargar con un array asociativo
    
    
    public function cargar($datosTeatro){
        $this->setIdTeatro($datosTeatro['id_Teatro']);
        $this->setNombreTeatro($datosTeatro['nombre_Teatro']);
        $this->setDireccion($datosTeatro['direccion_Teatro']);
        $this->setarrayFunciones($this->getarrayFunciones());
    }
        
    
    //busca teatro con el id
    
    public function Buscar($id) {
        $baseDatos= new BaseDatos();
        $consultaBD = "SELECT * FROM Teatro WHERE id_Teatro=".$id;
        $resp = false;
        //echo $consultaBD."\n";
        if ($baseDatos->Iniciar()) {
            
            if ($baseDatos->Ejecutar($consultaBD)) {
                if ($fila = $baseDatos->Registro()) {
                    $this->setIdTeatro($id);
                    $this->setNombreTeatro($fila['nombre_Teatro']);
                    $this->setDireccion($fila['direccion_Teatro']);
                    //$this->setarrayFunciones($this->getarrayFunciones());
                    
    /* el error: cuando llamo al getfunciones el getfunciones llama al listar de las clases. 
     * y el listar llama al buscar de esa clase, y al buscar tambien busca el teatro que vuelve
     *  a llamar al getfunciones*/
                    
                   /*
                    //mandar a getarrayfunciones
                    $condicion = 'id_Teatro = '.$id;
                    //buscar coleccion de funciones
                    $colCine = Cine::Listar($condicion);
                    $colMusical = Musical::Listar($condicion);
                    $colObraTeatral = ObraTeatral::Listar($condicion);
                    $colFunciones= array();
                    if ($colCine != null) {
                        $colFunciones = array_push($colFunciones,$colCine);
                    }
                    if ($colMusical != null) {
                        $colFunciones = array_push($colFunciones,$colMusical);
                    }
                    if ($colObraTeatral != null) {
                        $colFunciones = array_push($colFunciones,$colObraTeatral);
                    }
                    //$colFunciones = array_merge($colCine, $colMusical, $colObraTeatral);
                    $this->setarrayFunciones($colFunciones);
                    */
                    
                    $resp = true;
                }               
            }
            else{
                $this->setMsjError($baseDatos->getError());
                //echo "El Error es: ".$baseDatos->getError()."\n";
            }
        }
        else {
            $this->setMsjError($baseDatos->getError());
            //echo "El Error es: ".$baseDatos->getError()."\n";
        }
        return $resp;
    }
    
    
    
    
    public static function Listar($condicion = "") {
        $baseDatos = new BaseDatos();
        $arrTeatros = null;
        
        $consultaBD = "SELECT * FROM Teatro ";
        if ($condicion !="") {
            $consultaBD = $consultaBD.' WHERE '.$condicion; 
        }
        $consultaBD.= " ORDER BY id_Teatro ";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaBD)) {
                $arrTeatros=array();
                while ($fila = $baseDatos->Registro()) {
                    //$id= $fila['id_Teatro'];
                    //$nombre = $fila['nombre_Teatro'];
                    //$direc = $fila['direccion_Teatro'];
                    
                    $teatro = new Teatro();
                    //$teatro ->Buscar($id);
                    $teatro->cargar($fila);
                    //$teatro->cargarDatosTeatro($id, $nombre, $direc);
                    array_push($arrTeatros, $teatro);
                }
            }
            else {
               // $this->setMsjError($baseDatos->getError());
            }
        }
        else {
            //$this->setMsjError($baseDatos->getError());
        }
        
        
        return $arrTeatros;
    }
    
    public function insertar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        
        $consultaBD = "INSERT INTO Teatro(nombre_Teatro, direccion) VALUES ('".$this->getNombreTeatro()."','".$this->getDireccion()."')";
        if ($baseDatos->Iniciar()) {
            if ($id = $baseDatos->devuelveIDInsercion($consultaBD)) {
                $this->setIdTeatro($id);
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
        $consultaBD = "UPDATE Teatro SET nombre_Teatro='".$this->getNombreTeatro()."' AND direccion ='".$this->getDireccion()."' WHERE id=".$this->getIdTeatro();
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaBD)) {
                $resp = true;
            }
            else{
                $this->setMsjError($baseDatos->getError());
            }
        }
        else{
            $this->setMsjError($baseDatos->getError());
        }
        return $resp;
        
    }
    //
    //
    //AGREGAR EL ELIMINAR LAS FUNCIONES 
    //
    //
    
    
    public function Eliminar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        if ($baseDatos->Iniciar()) {
            
            $colFunciones = $this->getarrayFunciones();
            for ($i = 0; $i < count($colFunciones); $i++) {
                $colFunciones[$i]->Eliminar();
            }
            
            $consultaBD = "DELETE FROM Teatro WHERE id_Teatro=".$this->getIdTeatro();
            if ($baseDatos->Ejecutar($consultaBD)) {
                
                
                $resp = true;
            }
            else{
                $this->setMsjError($baseDatos->getError());
            }
        }
        else{
            $this->setMsjError($baseDatos->getError());
        }
        
        return $resp;
    }
    
    
    
    
    //
    //METODOS DE LA CLASE
    //
    
    
    
    public function cambiarNombreTeatro($nombreNuevo) {
        $this-> setNombreTeatro($nombreNuevo);
        
    }
    
    public function cambiarDireccTeatro($nuevaDirec) {
        $this->setDireccion($nuevaDirec);
    }
    
    /*
    public function cambiarNombreFun($nuevoNombreFun, $nombreACambiar) {
        $funcion = $this->getarrayFunciones();
        $resp = null;
        for ($i = 0; $i < count($funcion); $i++) {
            if ($funcion[$i]["nombre"] == $nombreACambiar) {
                $funcion[$i]["nombre"] = $nuevoNombreFun;
                $this->setFunciones($funcion);
                $resp = true;
            }
            else{
                $resp = false; //no existe el nombre en el array funciones
            }
        }
        
        return $resp;
    }
    
    */
    
    //METODOS DE LA COLECCION 
    
    public function CambiarNombreFuncion($nombreNuevo, $nombreFunc) {
        $arrayFunciones= $this->getarrayFunciones();
        $encontrado = false;
        $i=0;
        
        while ($i < count($arrayFunciones) && !$encontrado) {
            if ($arrayFunciones[$i]->getNombre() == $nombreFunc) {
                $encontrado= true;
                $arrayFunciones[$i]->setNombre($nombreNuevo);
            }
            else{
                $i++;
            }
            
            return $encontrado;
        }
    }
    
    public function CambiarPrecioFuncion($nuevoPrecio, $nombreFuncion) {
        $arrayFunciones= $this->getarrayFunciones();
        
        $i=0;
        $encontrado = false;
        
        while ($i < count($arrayFunciones) && !$encontrado) {
            if ($arrayFunciones[$i]->getNombre() == $nombreFuncion) {
                $encontrado = true;
                $arrayFunciones[$i]->setPrecio($nuevoPrecio);
            }
            else{
                $i++;
            }
        }
        
        return $encontrado;
        
    }
    
    
    public function cambiarHoraFun($nuevaHora, $nombreFun) {
        $encontrado = false;
        $i=0;
        $coleccionFunciones = $this->getarrayFunciones();
        
        while ($i < count($coleccionFunciones) && !$encontrado) {
            if ($coleccionFunciones[$i]->getNombre() == $nombreFun) {
                $coleccionFunciones[$i]->setHora_inicio($nuevaHora);
                $encontrado = true;
            }
            else {
                $i++;
            }
        }
        return $encontrado;
    }
    
    public function cambiarDuracFun($nombreFun, $nuevaDurac){
        $coleccionFunciones = $this->getarrayFunciones();
        $encontrado = false;
        $i= 0;
        
        while ($i < count($coleccionFunciones) && !$encontrado){
            if ($coleccionFunciones[$i]->getNombre() == $nombreFun) {
                $coleccionFunciones[$i]->setDurac_Obra($nuevaDurac);
                $encontrado = true;
            }
            else {
                $i++;
            }
        }
        
        return $encontrado;
    }
    
    // retorna true si no hay solapado
    
    public function solapado($ObjFuncion) {
        $horaInicio = $ObjFuncion->getHora_inicio();
        $horaI = strtotime($horaInicio);
        $hora = date("H",$horaI);
        $minutos = date("i", $horaI);
        $date = "".$hora.":".$minutos."";
        $horaInicioFinal = DateTime::createFromFormat("H:i",$date);
        $horaInicioFinal = $horaInicioFinal->format("H:i");
        $insertar = true;
        $i=0;
        $coleccionFunciones = $this->getarrayFunciones();
        
        while ($i < count($coleccionFunciones) && $insertar) {
            $horaColec = $coleccionFunciones[$i]->getHora_inicio();
            $horaIColeccion = strtotime($horaColec);
            $horaCol = date("H",$horaIColeccion);
            $minutosCol = date("i",$horaIColeccion);
            $horaInicioFinalArray = DateTime::createFromFormat("H:i", "".$horaCol.":".$minutosCol."" );
            $horaInicioFinalArray = $horaInicioFinalArray->format("H:i");
            $duracionFinalArray = $coleccionFunciones[$i]->DuracionFinal();
            
            if (($horaInicioFinal > $horaInicioFinalArray) && ($horaInicioFinal >= $duracionFinalArray)) {
                $resp = true;
            }
            else {
                $resp = false;
            }
            
            if ($resp) {
                $i++;
            }
            else{
                $insertar = false;
            }
        }

        return $insertar;
        
    }
    
    //verifica el solapado
    //modificado
    public function cargarFuncion($objFuncion) {  
        $verifica = $this->solapado($objFuncion);
        if ($verifica) {
            $array =$this->getarrayFunciones();
            array_push($array, $objFuncion);
            $this->setarrayFunciones($array);
            $resp = true;
        }
        else{
            $resp = false;
        }
        return $resp;
    }
    
    
    public function darCosto() {
        $costo = 0;
        $coleccion = $this->getarrayFunciones();
        for ($i = 0; $i < count($coleccion); $i++) {
            $costo = $costo + $coleccion[$i]->obtenerCosto();
        }
        return $costo;
    }
    
    
    
    public function __toString() {
        $resp = "ID Teatro :".$this->getIdTeatro().")"."\n".
                "nombreTeatro: ".$this->getNombreTeatro()."\n".
                "Direccion: ". $this->getDireccion()."\n".
                "Funciones : "."\n";
                $colFunciones = $this->getarrayFunciones();
                //echo "indices de la coleccion ".count($colFunciones)."\n";
            for ($i = 0; $i < count($colFunciones); $i++) {
                $resp= $resp .$i .") ".$colFunciones[$i]->__toString()."\n";
                /*for ($j = 0; $j < count($colFunciones[$i]); $j++) {
                    //echo "coleccion ".count($colFunciones[$i])."\n";
                    $resp= $resp .$j .") ".$colFunciones[$i][$j]->__toString()."\n";
                }*/
                
            }
            return $resp;
    }
    
}