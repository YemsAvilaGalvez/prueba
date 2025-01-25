<?php
require_once  'model_conexion.php';

class Modelo_Comentario extends conexionBD
{


    public function Listar_Testimonio()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_TESTIMONIO()";
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

    public function Listar_Condolencia()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_CONDOLENCIA()";
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


    public function Eliminar_Testimonio($idTes)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_ELIMINAR_TESTIMONIO(?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idTes, PDO::PARAM_INT);
        $resultado = $query->execute();
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexionBD::cerrar_conexion();
    }

    public function Eliminar_Condolencia($idCon)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_ELIMINAR_CONDOLENCIA(?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idCon, PDO::PARAM_INT);
        $resultado = $query->execute();
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexionBD::cerrar_conexion();
    }

    public function Registrar_Testimonio($name, $message)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_REGISTRAR_TESTIMONIO(?,?)";
        $query  = $c->prepare($sql);
        $query->bindParam(1, $name);
        $query->bindParam(2, $message);

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
