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
}
