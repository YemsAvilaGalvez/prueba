<?php
    require_once  'model_conexion.php';

    class Modelo_Usuario extends conexionBD{
        
        public function Listar_Usuario(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_USUARIOS()";
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

        public function Registrar_Usuario($nombre_usuario,$usuario,$contrasena_usuario,$usu_rol){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_USUARIOS(?,?,?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$nombre_usuario);
            $query -> bindParam(2,$usuario);
            $query -> bindParam(3,$contrasena_usuario);
            $query -> bindParam(4,$usu_rol);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

       

        public function Cargar_Select_Rol(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_ROL()";
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



        public function Verificar_Usuario($usu,$con){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_VERIFICAR_USUARIO(?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->bindParam(1,$usu);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                if(password_verify($con,$resp['contrasena_usuario'])){
                    $arreglo[]=$resp;                 
                }
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }

        public function Eliminar_Usuario($id_usuario) {
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_ELIMINAR_USUARIO(:id_usuario)"; // Cambié a parámetro nombrado
            $query = $c->prepare($sql);
            $query->bindParam(':id_usuario', $id_usuario); // Cambié a un parámetro nombrado
            $query->execute();
            
            if ($query->rowCount() > 0) { // Verificar si se eliminaron filas
                return 1; // Retornar 1 para indicar éxito
            }
            return 0; // Retornar 0 para indicar error
            conexionBD::cerrar_conexion();
        }
    }

    

?>
