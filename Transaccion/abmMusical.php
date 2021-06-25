<?php


    class abmMusical {
        
        function modificarMusical($objTeatro, $objMusical, $director, $cantPersonas, $nombreFun, $horaInicio, $precio, $duracion) {
            
            if ($director !="" || null) {
                $objMusical->setDirector($director);
            }
            if ($cantPersonas !="" || null){
                $objMusical->setCantPersonasEnEscena($cantPersonas);
            }
            if ($nombreFun !="" || null){
                $objMusical->setNombre($nombreFun);
            }
            if ($horaInicio !="" || null){
                $objMusical->setHora_inicio($horaInicio);
            }
            if ($precio !="" || null){
                $objMusical->setPrecio($precio);
            }
            if ($duracion !="" || null){
                $objMusical->setDurac_Obra($duracion);
            }
            
            
            $resp = $objMusical->Modificar();
            
            return $resp;           
        }
        
        //
        
        function seleccionarMusical($id) {
            $objMusical = new Musical();
            $objMusical->Buscar($id);
            
            return $objMusical;
        }
        
        function insertarMusical($director, $cantPersonas) {
            $objMusical = new Musical();
            $objMusical->setDirector($director);
            $objMusical->setCantPersonasEnEscena($cantPersonas);
            
            $resp = $objMusical->insertar();
            return $resp;
        }
        
        function insertarMusicalNuevo($arrayDatos,$objTeatro){
            $objMusical = new Musical();
            $objMusical->Cargar($arrayDatos);
            // verifica el solapado antes de insertarlo
            $resp = $objTeatro->cargarFuncion($objMusical);
            if ($resp) {
                $insertado = $objMusical->insertar();
            }
            else {
                $insertado = false;
            }
            return $insertado;
            
        }
            
        
        
        function eliminarMusical($objMusical) {
            $resp = $objMusical->Eliminar();
            
            return $resp;
        }
        
        function listarMusical($objMusical, $id) {
            if ($objMusical->Listar($id)) {
                $retorno = $objMusical->__toString();
            }
            else{
                $retorno = false;
            }
            return $retorno;
            
        }
        
    }