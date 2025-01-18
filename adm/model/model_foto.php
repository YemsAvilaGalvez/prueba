<?php
require_once  'model_conexion.php';

class Modelo_Foto extends conexionBD
{


    public function Listar_Foto()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_FOTOS()";
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

    public function Cargar_Select_Difunto()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_CARGAR_SELECT_DIFUNTO()";
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

    public function Registrar_Foto($idDifunto, $rutas)
{
    $c = conexionBD::conexionPDO();
    $sql = "CALL SP_REGISTRAR_FOTO(?, ?)"; // Procedimiento almacenado

    // Verifica si $rutas es un arreglo
    if (is_array($rutas)) {
        $success = true;
        foreach ($rutas as $ruta) {
            // Vinculamos los parámetros
            $query = $c->prepare($sql);
            $query->bindParam(1, $idDifunto, PDO::PARAM_STR);
            $query->bindParam(2, $ruta, PDO::PARAM_STR);

            // Ejecutamos la consulta para cada ruta
            $resultado = $query->execute();

            if (!$resultado) {
                $success = false;
                break; // Salimos si hay un error
            }
        }
    } else {
        $success = false; // Si $rutas no es un arreglo
    }

    conexionBD::cerrar_conexion();

    return $success ? 1 : 0; // Devuelve 1 si todo fue exitoso
}

    
    

    public function Editar_Difunto($idDifunto, $documentoCliente, $nombre, $fechaNacimiento, $fechaFallecimiento, $biografia, $video, $ubicacion, $cancion)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_EDITAR_DIFUNTO(?,?,?,?,?,?,?,?,?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idDifunto, PDO::PARAM_INT);
        $query->bindParam(2, $documentoCliente, PDO::PARAM_STR);
        $query->bindParam(3, $nombre, PDO::PARAM_STR);
        $query->bindParam(4, $fechaNacimiento, PDO::PARAM_STR);
        $query->bindParam(5, $fechaFallecimiento, PDO::PARAM_STR);
        $query->bindParam(6, $biografia, PDO::PARAM_STR);
        $query->bindParam(7, $video, PDO::PARAM_STR);
        $query->bindParam(8, $ubicacion, PDO::PARAM_STR);
        $query->bindParam(9, $cancion, PDO::PARAM_STR);
    
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
}
