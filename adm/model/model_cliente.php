<?php
    require_once  'model_conexion.php';

    class Modelo_Cliente extends conexionBD{
    

        public function Listar_Cliente(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_CLIENTES()";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }

        public function Traer_Widget(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL DASHBOARD()";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        
        
        public function Registrar_Agencia($nombre_agencia){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_AGENCIA(?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$nombre_agencia);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }


         public function Modificar_Agencia($id_agencia, $nombre_agencia){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_AGENCIA(?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$id_agencia);
            $query -> bindParam(2,$nombre_agencia);

            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

     
        
        public function Eliminar_Agencia($id_agencia)//viene del controlador
        {
           $c = conexionBD:: conexionPDO();

           $sql = "CALL SP_ELIMINAR_AGENCIA(?)";
           $query = $c->prepare($sql);//mandamos el precedure
           $query ->bindParam(1,$id_agencia);//enviamos los parametros seguun la posicion del procedure
           $resultado = $query ->execute();
           //solo de usa cuando no se retorna un valor en el procedure(actualizar)
           if($resultado){
               return 1;
           }else{
               return 0;
           }
           conexionBD::cerrar_conexion();
        }

        public function Cargar_Select_Agencia(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_CARGAR_SELECT_AGENCIA()";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }  
        

    }

?>