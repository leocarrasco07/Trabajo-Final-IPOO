<?php


    class abmCine {
        
        function seleccionarCine($id) {
            
            $objCine = new Cine();
            $objCine->Buscar($id);
            
            return $objCine;
        }
        
        
        function modificarCine($objCine,$objTeatro, $genero, $origen,$nombreFun, $horaInicio, $precio, $duracion) {
            
            if ($genero !="" || null) {
                $objCine->setGenero($genero);
            }
            if ($origen !="" || null){
                $objCine->setOrigen($origen);
            }
            if ($nombreFun !="" || null){
                $objCine->setNombre($nombreFun);
            }
            if ($horaInicio !="" || null){
                $objCine->setHora_inicio($horaInicio);
            }
            if ($precio !="" || null){
                $objCine->setPrecio($precio);
            }
            if ($duracion !="" || null){
                $objCine->setDurac_Obra($duracion);
            }
            
            $resp = $objCine->Modificar();

            return $resp; 
        }
        
        function insertarCine($arrayDatos) {
            $objCine = new Cine();
            $objCine->CargarNuevo($arrayDatos);
            
            $resp = $objCine->insertar();
            if ($resp) {
                return $objCine;
            }
            else {
                return $resp;
            }
            
        }
        
        function insertarCineNuevo($arrayDatos,$objTeatro){
            $objCine = new Cine();
            $objCine->Cargar($arrayDatos);
            // verifica el solapado antes de insertarlo
            $resp = $objTeatro->cargarFuncion($objCine);
            if ($resp) {
                $insertado = $objCine->insertar();
            }
            else{
                $insertado = false;
            }
            return $insertado;         
        }
        
        function eliminarCine($objCine) {
            $resp = $objCine->Eliminar();
            
            return  $resp;
        }
        
        function listarCine($objCine, $id) {
            if ($objCine->Listar($id)) {
                $retorno = $objCine->__toString();
            }
            else{
                $retorno = false;
            }
            return $retorno;
        }
    }