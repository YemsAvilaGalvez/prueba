<?php
require_once  'model_conexion.php';

class Modelo_Difunto extends conexionBD
{


    public function Listar_Difunto()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_DIFUNTO()";
        $arreglo = array();
        $query  = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resp) {
            $arreglo["data"][] = $resp;
        }
        return $arreglo;
        conexionBD::cerrar_conexion();
    }

    public function Listar_Difunto_Vencido()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_DIFUNTO_VENCIDO()";
        $arreglo = array();
        $query  = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resp) {
            $arreglo["data"][] = $resp;
        }
        return $arreglo;
        conexionBD::cerrar_conexion();
    }

    public function Cargar_Select_Cliente()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_CARGAR_SELECT_CLIENTE()";
        $arreglo = array();
        $query  = $c->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll();
        foreach ($resultado as $resp) {
            $arreglo[] = $resp;
        }
        return $arreglo;
        conexionBD::cerrar_conexion();
    }

    public function Registrar_Difunto($documentoCliente, $nombre, $fechaNacimiento, $fechaFallecimiento, $biografia, $ruta, $video, $ubicacion, $cancion, $plan, $fechaFin)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_REGISTRAR_DIFUNTO(?,?,?,?,?,?,?,?,?,?,?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $documentoCliente, PDO::PARAM_STR);
        $query->bindParam(2, $nombre, PDO::PARAM_STR);
        $query->bindParam(3, $fechaNacimiento, PDO::PARAM_STR);
        $query->bindParam(4, $fechaFallecimiento, PDO::PARAM_STR);
        $query->bindParam(5, $biografia, PDO::PARAM_STR);
        $query->bindParam(6, $ruta, PDO::PARAM_STR);
        $query->bindParam(7, $video, PDO::PARAM_STR);
        $query->bindParam(8, $ubicacion, PDO::PARAM_STR);
        $query->bindParam(9, $cancion, PDO::PARAM_STR);
        $query->bindParam(10, $plan, PDO::PARAM_STR);
        $query->bindParam(11, $fechaFin, PDO::PARAM_STR);
    
        $resultado = $query->execute();
        if ($row = $query->fetchColumn()){
            return $row;
        }
        conexionBD::cerrar_conexion();
    }

    public function Editar_Difunto($idDifunto, $documentoCliente, $nombre, $fechaNacimiento, $fechaFallecimiento, $biografia, $video, $ubicacion, $plan, $fechaFin, $estado)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_EDITAR_DIFUNTO(?,?,?,?,?,?,?,?,?,?,?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idDifunto, PDO::PARAM_INT);
        $query->bindParam(2, $documentoCliente, PDO::PARAM_STR);
        $query->bindParam(3, $nombre, PDO::PARAM_STR);
        $query->bindParam(4, $fechaNacimiento, PDO::PARAM_STR);
        $query->bindParam(5, $fechaFallecimiento, PDO::PARAM_STR);
        $query->bindParam(6, $biografia, PDO::PARAM_STR);
        $query->bindParam(7, $video, PDO::PARAM_STR);
        $query->bindParam(8, $ubicacion, PDO::PARAM_STR);
        $query->bindParam(9, $plan, PDO::PARAM_STR);
        $query->bindParam(10, $fechaFin, PDO::PARAM_STR);
        $query->bindParam(11, $estado, PDO::PARAM_STR);
    
        $resultado = $query->execute();
        if ($row = $query->fetchColumn()){
            return $row;
        }
        conexionBD::cerrar_conexion();
    }

    public function Editar_Foto($idDifunto, $ruta)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_EDITAR_FOTO(?,?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idDifunto, PDO::PARAM_INT);
        $query->bindParam(2, $ruta, PDO::PARAM_STR);
    
        $resultado = $query->execute();
        if ($resultado){
            return 1;
        }else{
            return 0;
        }
        conexionBD::cerrar_conexion();
    }

    public function Eliminar_Difunto($idDifunto)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_ELIMINAR_DIFUNTO(?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idDifunto, PDO::PARAM_INT);
        $resultado = $query->execute();
        if ($resultado){
            return 1;
        }else{
            return 0;
        }
        conexionBD::cerrar_conexion();
    }

    public function Registrar_Comentario($id_difunto, $name, $telefono, $message) {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_REGISTRAR_COMENTARIO(?, ?, ?, ?)";
        $query = $c->prepare($sql);
        $query->bindParam(1, $id_difunto);
        $query->bindParam(2, $name);
        $query->bindParam(3, $telefono);
        $query->bindParam(4, $message);
        $query->execute();
        
        // Captura el valor retornado por el procedimiento (ID del comentario insertado)
        $row = $query->fetchColumn();
        
        if ($row) {
            return $row; // Retorna el ID del comentario insertado
        } else {
            return 0; // Si no se insertó correctamente, retorna 0 o algún valor indicativo de error
        }
    
        conexionBD::cerrar_conexion();
    }
    
    
}
