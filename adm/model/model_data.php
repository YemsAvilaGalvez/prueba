<?php
require_once  'model_conexion.php';

class Modelo_Data extends conexionBD
{


    public function Listar_data()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_DATA()";
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

    public function Registrar_Data($idDifunto, $fecha, $hobbies)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_REGISTRAR_DATA(?,?,?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idDifunto, PDO::PARAM_STR);
        $query->bindParam(2, $fecha, PDO::PARAM_STR);
        $query->bindParam(3, $hobbies, PDO::PARAM_STR);
    
        $resultado = $query->execute();
        if ($row = $query->fetchColumn()){
            return $row;
        }
        conexionBD::cerrar_conexion();
    }

    public function Editar_Data($idData, $fecha, $hobbies)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_EDITAR_DATA(?,?,?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idData, PDO::PARAM_INT);
        $query->bindParam(2, $fecha, PDO::PARAM_STR);
        $query->bindParam(3, $hobbies, PDO::PARAM_STR);

        $resultado = $query->execute();
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexionBD::cerrar_conexion();
    }

    public function Eliminar_Data($id_data)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_ELIMINAR_DATA(?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $id_data, PDO::PARAM_INT);
        $resultado = $query->execute();
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexionBD::cerrar_conexion();
    }
}
