<?php

    
    //funcionalidades del teatro 
    

    class abmTeatro {
        
        
        // modifica nombre y/o direccion
        
        function modificarTeatro($objTeatro, $nombre, $direccion){
            if ($nombre !="" || null) {
                $objTeatro->cambiarNombreTeatro($nombre);
            }
            if ($direccion !="" || null){
                $objTeatro ->cambiarDireccTeatro($direccion);
            }
            
            $resp = $objTeatro->Modificar();
            
            return $resp;
        }
        
        function seleccionarTeatro($id) {
            $objTeatro = new Teatro();
            $objTeatro ->Buscar($id);
            return $objTeatro;
        }
        
        function insertarTeatro($nombre, $direccion,$funciones) {
            
            $objTeatro = new Teatro();
            $objTeatro->cargarDatosTeatro($nombre, $direccion, $funciones);
            
            $resp = $objTeatro->insertar();
            
            return $resp;          
        }
        
        //elimina el teatro y sus funciones
        
        function eliminarTeatro($objTeatro) {
            $colfunciones = $objTeatro->getarrayFunciones();
            $resp = false;
            $i=0;
            while ($i < count($colfunciones) && !$resp) {
                   $resp = $colfunciones[$i]->Eliminar();
                   if ($resp) {
                       $i++;
                   }
                   else {
                       $resp = false;
                   }
            }
            
            if ($objTeatro->Eliminar()) {
                $return = true;
            }
            else{
                $return = false;
            }
            
            
            
            return $return;
        }
        
        //listar Teatros y sus funciones
        
        function listarTeatros($objTeatro){
            $condicion = "";
            $colTeatros = $objTeatro->Listar($condicion);
            $strTeatros = "";
            for ($i = 0; $i < count($colTeatros); $i++) {
                //$colFunciones = $colTeatros[$i]->getarrayFunciones();
                $strTeatros =$strTeatros."\n".$i.") ". $colTeatros[$i]->__toString();    
               }     
               $listado = $strTeatros."\n";
   
            return $listado;
        }
            
        
        
    }