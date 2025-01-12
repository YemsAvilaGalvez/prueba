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

    public function Registrar_Difunto($documentoCliente, $nombre, $fechaNacimiento, $fechaFallecimiento, $biografia, $ruta, $video, $ubicacion, $cancion)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_REGISTRAR_DIFUNTO(?,?,?,?,?,?,?,?,?,?)";
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
    
        $resultado = $query->execute();
        if ($row = $query->fetchColumn()){
            return $row;
        }
        conexionBD::cerrar_conexion();
    }
}
