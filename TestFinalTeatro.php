<?php

include_once 'ORM\BaseDatos.php';
include_once 'ORM\Teatro.php';
include_once 'ORM\Funciones.php';
include_once 'ORM\Musical.php';
include_once 'ORM\Cine.php';
include_once 'ORM\ObraTeatral.php';
include_once 'Transaccion\abmTeatro.php';
include_once 'Transaccion\abmMusical.php';
include_once 'Transaccion\abmCine.php';
include_once 'Transaccion\abmObraTeatral.php';





function Menu(){
    echo 
          "1) Opciones Funciones"."\n".
          "2) Opciones Teatro"."\n".
          "3) LISTAR TODO"."\n".
          "4) SALIR"."\n";
    echo "Elegir Opcion: "."\n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}

function crearCine($objTeatro,$abmCine) {
    echo "Ingrese Nombre Funcion:"."\n";
    $nombreFun = trim(fgets(STDIN));
    echo "Ingresar Hora Inicio: "."\n";
    $horaInicio = trim(fgets(STDIN));
    echo "Ingrese Duracion: "."\n";
    $durac = trim(fgets(STDIN));
    echo "Ingrese Precio: "."\n";
    $precio = trim(fgets(STDIN));
    echo "Ingrese Genero: "."\n";
    $genero = trim(fgets(STDIN));
    echo "Ingresar Origen: "."\n";
    $origen =trim(fgets(STDIN));
    //$objCine = new Cine();
    $arrayDatos = array("id_Funciones" => "",
        "id_Teatro" => $objTeatro->getIdTeatro(), "nombre_Funcion" => $nombreFun,
        "horaInicio" => $horaInicio, "duracion" => $durac, "precioPublico" => $precio,
        "genero" => $genero, "paisOrigen" => $origen);                        
    
    //devuelve el obj que se inserto para luego setearlo en la coleccion de funciones
    $resp = $abmCine->insertarCineNuevo($arrayDatos,$objTeatro);
    if ($resp) {
        echo "se inserto correctamente"."\n";
    }
    else {
        echo "No se pudo insertar"."\n";
        echo "Hora soloapada"."\n";       
    }
}

function crearMusical($objTeatro, $abmMusical) {
    
    echo "Ingrese Nombre Funcion:"."\n";
    $nombreFun = trim(fgets(STDIN));
    echo "Ingresar Hora Inicio: "."\n";
    $horaInicio = trim(fgets(STDIN));
    echo "Ingrese Duracion: "."\n";
    $durac = trim(fgets(STDIN));
    echo "Ingrese Precio: "."\n";
    $precio = trim(fgets(STDIN));
    echo "ingresar Director: "."\n";
    $director = trim(fgets(STDIN));
    echo "Ingresar Cantidad de personas en Escena: "."\n";
    $cantPersonas = trim(fgets(STDIN));
   // $objMusical = new Musical();
    $arrayDatos = array("id_Funciones" => "",
        "id_Teatro" => $objTeatro->getIdTeatro(), "nombre_Funcion" => $nombreFun,
        "horaInicio" => $horaInicio, "duracion" => $durac, "precioPublico" => $precio,
        "director" => $director, "cantPersonas" => $cantPersonas);
    
    $resp = $abmMusical->insertarMusicalNuevo($arrayDatos,$objTeatro);
    
    if ($resp) {
        echo "se inserto correctamente"."\n";
    }
    else {
        echo "No se pudo insertar"."\n";
        echo "Hora soloapada"."\n";
    }
}

function crearObraTeatral($objTeatro,$abmObraTeatral) {
    echo "Ingrese Nombre Funcion:"."\n";
    $nombreFun = trim(fgets(STDIN));
    echo "Ingresar Hora Inicio: "."\n";
    $horaInicio = trim(fgets(STDIN));
    echo "Ingrese Duracion: "."\n";
    $durac = trim(fgets(STDIN));
    echo "Ingrese Precio: "."\n";
    $precio = trim(fgets(STDIN));
    //$objObraTeatral = new ObraTeatral();
    $arrayDatos = array("id_Funciones" => "",
        "id_Teatro" => $objTeatro->getIdTeatro(), "nombre_Funcion" => $nombreFun,
        "horaInicio" => $horaInicio, "duracion" => $durac, "precioPublico" => $precio);
    
    $resp = $abmObraTeatral->insertarObraNuevo($arrayDatos,$objTeatro);
    if ($resp) {
        echo "se inserto correctamente"."\n";
    }
    else {
        echo "No se pudo insertar"."\n";
        echo "Hora soloapada"."\n";
    }

}

function CrearTeatro(){
    echo "Ingresar Nombre: "."\n";
    $nombreTeatro = trim(fgets(STDIN));
    echo "Ingresar Direccion: "."\n";
    $direccion = trim(fgets(STDIN));
    $Funciones = array();
    $objTeatro = new Teatro();
    $objTeatro->cargarDatosTeatro($nombreTeatro, $direccion, $Funciones);
    
    $resp = $objTeatro->insertar();
    
    if ($resp) {
        echo "Se pudo Ingresar"."\n";
    }
    else{
        echo "No Se Pudo Agregar"."\n";
        //echo $objTeatro->getMsjError()."\n";
    }
}

function opcionCrear() {
    echo 
          "1) Crear Musical"."\n".
          "2) Crear Cine"."\n".
          "3) Crear ObraTeatral"."\n".
          "4) SALIR. "."\n";
    echo "Elegir Opcion "."\n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}


//opciones de los metodos de la base de datos

function opcionesFunciones() {
    echo 
         "1) Modificar"."\n".
          "2) Eliminar"."\n".
          "3) Listar"."\n".
          "4) Crear (Insertar) Nueva Funcion "."\n";
    echo "Elige Opcion: "."\n";
    $opcion =trim(fgets(STDIN));
    return $opcion;
}

// opciones de modificacion de funciones

function opcionesModificarCine() {
    echo "1) Nombre "."\n".
          "2) Hora Inicio"."\n".
          "3) Duracion"."\n".
          "4) Precio"."\n".
          "5) Genero"."\n".
          "6) Origen"."\n";
    $opcion =trim(fgets(STDIN));
    return $opcion;
}

function opcionesModificarMusical() {
    echo "1) Nombre"."\n".
          "2) Hora Inicio"."\n".
          "3) Duracion"."\n".
          "4) Precio"."\n".
          "5) Director"."\n".
          "6) Cantidad de Personas en escena"."\n";
    echo "Elige Opcion: "."\n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}

function opcionesModificarObraTeatral() {
    echo "1) Nombre"."\n".
          "2) Hora Inicio"."\n".
          "3) Duracion"."\n".
          "4) Precio "."\n";

    $opcion = trim(fgets(STDIN));
    return $opcion;
}

function opcionesTeatro() {
    echo "1) Listar Teatro"."\n".
          "2) Modificar Teatro"."\n".
          "3) Eliminar Teatro"."\n".
          "4) Crear (Insertar) Teatro","\n";
          
    $opcion =trim(fgets(STDIN));
    return $opcion;
}

function elegirFuncion() {
    echo "1) Listar TODAS las funciones"."\n".
         "2) Cine"."\n".
          "3) Musical"."\n". 
          "4) Obra Teatral"."\n".
          "5) SALIR"."\n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}


function listarTeatros() {
    echo "Listar Teatros? si/no"."\n";
    $opcion = trim(fgets(STDIN));
    if ($opcion == "si") {
        $objTeatro = new Teatro();
        $abmTeatro = new abmTeatro();
        $listado = $abmTeatro->listarTeatros($objTeatro);
        echo $listado."\n";
    }
}


     do {
         echo "ELIGE OPCION: "."\n";
         $opcionMenu= Menu();
         if ($opcionMenu == 1) {
             
             // OPCION FUNCIONES MODIFICAR
             
             $opcionFuncioes = opcionesFunciones();
             if ($opcionFuncioes == 1) {
                 listarTeatros();
                 echo "Ingrese el ID del Teatro: "."\n";
                 $id = trim(fgets(STDIN));
                 $objTeatro = new Teatro();
                 $objTeatro->Buscar($id);
                 echo "Ingrese el nombre de la funcion a Modificar:"."\n";
                 $nombreFun = trim(fgets(STDIN));
                 $colFunciones = $objTeatro->getarrayFunciones();
                 $encontrado = false;
                 $i = 0;
                 while ($i < count($colFunciones) && !$encontrado) {
                     if ($colFunciones[$i]->getNombre() == $nombreFun) {
                         $colEncontrada = $colFunciones[$i];
                         $encontrado = true;
                     }
                     else{
                         $i++;
                     }
                 }
                 $nombreClase = get_class($colEncontrada);
                 if ($nombreClase == "Musical") {
                     $abmMusical = new abmMusical();
                     $opcionMod = opcionesModificarMusical();
                     
                     //opciones MODIFICAR MUSICAL
                     
                     if ($opcionMod == 1) {
                         echo "Ingrese Nuevo Nombre: "."\n";
                         $nombre = trim(fgets(STDIN));
                         
                         $resp = $abmMusical->modificarMusical($objTeatro, $colEncontrada, "", "", $nombre, "", "", "");
                         if ($resp) {
                             echo "Nombre Modificado"."\n";
                         }
                         else{
                             echo "NO se pudo Modificar"."\n";
                         }
                         
                     }
                     elseif ($opcionMod == 2) {
                         echo "Ingrese Nueva Hora : "."\n";   
                         $horaInicio = trim(fgets(STDIN));                       
                         $resp = $abmMusical->modificarMusical($objTeatro, $colEncontrada, "", "", "", $horaInicio, "", "");
                         if ($resp) {
                             echo "Hora Cambiada "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 3) {
                         echo "Ingrese Nueva Duracion : "."\n";
                         $duracion = trim(fgets(STDIN));                        
                         $resp = $abmMusical->modificarMusical($objTeatro, $colEncontrada, "", "","", "", "", $duracion);
                         if ($resp) {
                             echo "Duracion Cambiada "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 4) {
                         echo "Ingrese nuevo Precio: "."\n";
                         $precio = trim(fgets(STDIN));
                         
                         $resp = $abmMusical->modificarMusical($objTeatro, $colEncontrada, "", "", "", "", $precio, "");
                         if ($resp) {
                             echo "Precio Cambiado "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 5) {
                         echo "Ingrese Nuevo Direcotor: "."\n";
                         $director = trim(fgets(STDIN));
                         $resp = $abmMusical->modificarMusical($objTeatro, $colEncontrada, $director,"","","", "", "");
                         if ($resp) {
                             echo "Director Cambiado"."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 6) {
                         echo "Ingrese Nueva Cantidad de Personas en Escena: "."\n";
                         $cantPersonas = trim(fgets(STDIN));
                         $resp = $abmMusical->modificarMusical($objTeatro, $colEncontrada, "", $cantPersonas,"","", "", "");
                         if ($resp) {
                             echo "Cantidad de Personas en Escena Cambiada"."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     
                     
                     // FIN opciones MODIFICAR MUSICAL
                     
                     
                     
                     //opciones MODIFICAR CINE
                     
                     
                 }
                 elseif ($nombreClase == "Cine") {
                     $abmCine = new abmCine();
                     $opcionMod = opcionesModificarCine();
                     
                     if ($opcionMod == 1) {
                         echo "Ingrese Nuevo Nombre: "."\n";
                         $nombre = trim(fgets(STDIN));
                         
                         $resp = $abmCine->modificarCine($colEncontrada,$objTeatro,"", "",$nombre, "", "", "");
                         if ($resp) {
                             echo "Nombre Modificado"."\n";
                         }
                         else{
                             echo "NO se pudo Modificar"."\n";
                         }
                         
                     }
                     elseif ($opcionMod == 2) {
                         echo "Ingrese Nueva Hora : "."\n";
                         $horaInicio = trim(fgets(STDIN));
                         
                         $resp = $abmCine->modificarCine($colEncontrada,$objTeatro, "", "","", $horaInicio, "", "");
                         if ($resp) {
                             echo "Hora Cambiada "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 3) {
                         echo "Ingrese Nueva Duracion : "."\n";
                         $duracion = trim(fgets(STDIN));
                         
                         $resp = $abmCine->modificarCine($colEncontrada,$objTeatro, "", "","","", "", $duracion);
                         if ($resp) {
                             echo "Duracion Cambiada "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 4) {
                         echo "Ingrese nuevo Precio: "."\n";
                         $precio = trim(fgets(STDIN));
                         
                         $resp = $abmCine->modificarCine($colEncontrada,$objTeatro, "", "","", "", "", "");
                         if ($resp) {
                             echo "Precio Cambiado "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 5) {
                         echo "Ingresar Genero: "."\n";
                         $genero = trim(fgets(STDIN));
                         $resp = $abmCine->modificarCine($colEncontrada, $objTeatro, $genero,"","","", "","");
                         if ($resp) {
                             echo "Genero Cambiado "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 6) {
                         echo "Ingrese Origen: "."\n";
                         $origen =trim(fgets(STDIN));
                         $resp = $abmCine->modificarCine($colEncontrada, $objTeatro,"", $origen, "","","","");
                         if ($resp) {
                             echo "Origen Cambiado "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                 }
                 
                 // OBRA TEATRAL MODIFICACIONES
                 
                 elseif ($nombreClase == "ObraTeatral") {
                     $abmObra = new abmObraTeatral();
                     $opcionMod = opcionesModificarObraTeatral();
                     
                     if ($opcionMod == 1) {
                         echo "Ingrese Nuevo Nombre: "."\n";
                         $nombre = trim(fgets(STDIN));
                         
                         $resp = $abmObra->modificarObra($colEncontrada, $objTeatro, $nombre, "", "", "");
                         if ($resp) {
                             echo "Nombre Modificado"."\n";
                         }
                         else{
                             echo "NO se pudo Modificar"."\n";
                         }
                         
                     }
                     elseif ($opcionMod == 2) {
                         echo "Ingrese Nueva Hora : "."\n";                      
                         $horaInicio = trim(fgets(STDIN));
                         $resp = $abmObra->modificarObra($colEncontrada, $objTeatro,$horaInicio);
                         if ($resp) {
                             echo "Hora Cambiada "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 3) {
                         echo "Ingrese Nueva Hora (0 a 23): "."\n";
                         $duracion = trim(fgets(STDIN));                     
                         $resp = $abmObra->modificarObra($colEncontrada, $objTeatro, "", "", "", $duracion);
                         if ($resp) {
                             echo "Duracion Cambiada "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     elseif ($opcionMod == 4) {
                         echo "Ingrese nuevo Precio: "."\n";
                         $precio = trim(fgets(STDIN));
                         
                         $resp = $abmObra->modificarObra($colEncontrada, $objTeatro, "", "", $precio, "");
                         if ($resp) {
                             echo "Precio Cambiado "."\n";
                         }
                         else {
                             echo "No se pudo Cambiar"."\n";
                         }
                     }
                     
                     // FIN OBRA TEATRAL MODIFICACIONES
                 }
                 
             }
             
             // OPCIIONES FUNCIONES  ELIMINAR 
             
             elseif ($opcionFuncioes == 2) {
                 // eliminar todas de un Teatro especifico 
                 echo "1) Eliminar Todas "."\n".
                      "2) Eliminar una en concreto "."\n";
                 $opcionEliminar = trim(fgets(STDIN));
                 if ($opcionEliminar == 1) {
                     listarTeatros();
                     // pedir id del teatro 
                     echo "ID del Teatro : "."\n";
                     $id = trim(fgets(STDIN));
                     $objTeatro = new Teatro();
                     $objTeatro->Buscar($id);
                     $colFunciones = $objTeatro->getarrayFunciones();
                     $i = 0;
                     $borrado = true;
                     while ($i < count($colFunciones) && $borrado) {
                         if ($colFunciones[$i]->Eliminar()) {
                             $borrado = true;
                             $i++;
                         }
                         else{
                             $borrado = false;
                         }
                     }
                     if ($borrado) {
                         echo "Eliminadas correctamente"."\n";
                     }
                     else {
                         echo "No se pudieron eliminar"."\n";
                     }
                     
                 }
                 elseif ($opcionEliminar == 2) {
                     listarTeatros();
                     // pedir id del teatro
                     echo "ID del Teatro : "."\n";
                     $id = trim(fgets(STDIN));
                     $objTeatro = new Teatro();
                     $objTeatro->Buscar($id);
                     $colFunciones = $objTeatro->getarrayFunciones();
                     echo "Nombre de la funcion a Borrar: "."\n";
                     $nombre= trim(fgets(STDIN));
                     $i= 0;
                     $encontrado = false;
                     while ($i < count($colFunciones) && !$encontrado) {
                         if ($colFunciones[$i]->getNombre() == $nombre) {
                             if ($colFunciones[$i]->Eliminar()) {
                                 echo "Funcion Eliminada"."\n";
                                 $encontrado = true;
                             }
                             else{
                                 echo "No se pudo Eliminar"."\n";
                                 $encontrado = true;
                             }
                         }
                         else{
                             $i++;
                         }
                     }//fin while
                     
                 }//$opcionEliminar == 2
                 
             }// FIN OPCIIONES FUNCIONES  ELIMINAR
             
             
             //Opciones Funciones LISTAR
             
             
             elseif ($opcionFuncioes == 3) {
                 echo "1) Listar una Funcion de un Teatro"."\n".
                     "2) Listar TODAS las Funciones de un Teatro"."\n";
                 $opcionListar = trim(fgets(STDIN));
                        if ($opcionListar == 1) {
                            listarTeatros();
                            // pedir id del teatro
                            echo "ID del Teatro : "."\n";
                            $id = trim(fgets(STDIN));
                            $objTeatro = new Teatro();
                            $objTeatro->Buscar($id);
                            $colFunciones = $objTeatro->getarrayFunciones();
                            echo "Nombre de la funcion a buscar: "."\n";
                            $nombre= trim(fgets(STDIN));
                            $i = 0;
                            $encontrado= false;
                            while ($i < count($colFunciones) && !$encontrado) {
                                if ($colFunciones[$i]->getNombre() == $nombre) {
                                    $str= $colFunciones[$i]->__toString()."\n";
                                    $encontrado = true;
                                }
                                else {
                                    $i++;
                                }
                            }
                                // si encontrado = false no pudo encontrar o no se encuentra la funcion
                                if ($encontrado) {
                                    echo "Encontrada "."\n";
                                    echo $str."\n";
                                }
                                else{
                                    echo "No se encontro la Funcion"."\n";
                                }
                            
                        }
                        elseif ($opcionListar == 2) {
                            listarTeatros();
                            // pedir id del teatro
                            echo "ID del Teatro : "."\n";
                            $id = trim(fgets(STDIN));
                            $objTeatro = new Teatro();
                            $objTeatro->Buscar($id);
                            $colFunciones = $objTeatro->getarrayFunciones();
                            for ($i = 0; $i < count($colFunciones); $i++) {
                                echo $colFunciones[$i]->__toString()."\n";                               
                            }
                            
                        }// Fin Opcion Listar
             }
             
             // CREAR/ INSERTAR NUEVA FUNCION
             
             elseif ($opcionFuncioes == 4) {
                 $opcionCrear =opcionCrear();
                 if ($opcionCrear == 1) {
                     listarTeatros();
                     echo "ID Teatro al cual querramos insertar una nueva funcion: "."\n";
                     $id= trim(fgets(STDIN));
                     $objTeatro = new Teatro();
                     $objTeatro->Buscar($id);
                     
                     $abmMusical = new abmMusical();
                     crearMusical($objTeatro, $abmMusical);
                 }
                 elseif ($opcionCrear == 2) {
                     listarTeatros();
                     echo "ID Teatro al cual querramos insertar una nueva funcion: "."\n";
                     $id= trim(fgets(STDIN));
                     $objTeatro = new Teatro();
                     $objTeatro->Buscar($id);
                     $abmCine = new abmCine();
                     crearCine($objTeatro, $abmCine);
                 }
                 elseif ($opcionCrear == 3) {
                     listarTeatros();
                     echo "ID Teatro al cual querramos insertar una nueva funcion: "."\n";
                     $id= trim(fgets(STDIN));
                     $objTeatro = new Teatro();
                     $objTeatro->Buscar($id);
                     $abmObra = new abmObraTeatral();
                     crearObraTeatral($objTeatro, $abmObra);
                 }
                 elseif ($opcionCrear== 4) {
                     
                 }
             }// FIN CREAR/ INSERTAR NUEVA FUNCION
         
         }
         
         // OPCIONES TEATRO
         
         elseif ($opcionMenu == 2) {
             $opcionTeatro = opcionesTeatro();
                if ($opcionTeatro == 1 ) {
                    echo "Ingrese ID del Teatro: "."\n";
                    $id = trim(fgets(STDIN));
                    $objTeatro = new Teatro();
                    $resp = $objTeatro->Buscar($id);
                    if ($resp) {
                        echo $objTeatro;
                        echo "Encontrado"."\n";
                    }
                    else{
                        echo "Teatro no se encontro"."\n";
                    }
                    
                }
         }       
         elseif ($opcionMenu == 3) {
             $abmTeatro = new abmTeatro();
             $objTeatro = new Teatro();
             $listado = $abmTeatro->listarTeatros($objTeatro);
             if ($listado != "") {
                 echo $listado;
             }
             else{
                 echo "No se encuentra informacion en la Base De Datos"."\n";
             }
             
         }
         
      
        }
        while ($opcionMenu != 4);    
