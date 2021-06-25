<?php

    
    class abmObraTeatral {
        
        
        function seleccionarObra($id) {
            $objObra = new ObraTeatral();
            $objObra->Buscar($id);
            
            return $objObra;
        }
        
        function modificarObra($objObra,$objTeatro,$nombreFun, $horaInicio, $precio, $duracion) {
            if ($nombreFun !="" || null){
                $objObra->setNombre($nombreFun);
            }
            if ($horaInicio !="" || null){
                $objObra->setHora_inicio($horaInicio);
            }
            if ($precio !="" || null){
                $objObra->setPrecio($precio);
            }
            if ($duracion !="" || null){
                $objObra->setDurac_Obra($duracion);
            }
            $resp = $objObra->Modificar();
            
            return $resp;
        }
        
       /* function insertarObra($objTeatro) {
            $objObra =new ObraTeatral();
            $objObra->CargarNuevo($datosObra);
            $resp = $objObra->insertar();
            
            return $resp;
        }*/
        
        function insertarObraNuevo($arrayDatos,$objTeatro){
            $objObra = new ObraTeatral();
            $objObra->Cargar($arrayDatos);
            // verifica el solapado antes de insertarlo
            $resp = $objTeatro->cargarFuncion($objObra);
            if ($resp) {
                $insertado = $objObra->insertar();
            }
            else{
                $insertado=false;
            }
            return $insertado;           
        }
        
        function eliminarObra($objObra) {
            $resp = $objObra->Eliminar();
            
            return  $resp;
        }
    }