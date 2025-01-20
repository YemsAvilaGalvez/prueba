<?php
require_once  'model_conexion.php';

class Modelo_Cliente extends conexionBD
{


    public function Listar_Cliente()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_CLIENTES()";
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

    public function Traer_Widget()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL DASHBOARD()";
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


    public function Registrar_Cliente($nombre, $documento, $celular, $departamento, $distrito, $provincia)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_REGISTRAR_CLIENTE(?,?,?,?,?,?)";
        $arreglo = array();
        $query  = $c->prepare($sql);
        $query->bindParam(1, $nombre, PDO::PARAM_STR);
        $query->bindParam(2, $documento, PDO::PARAM_STR);
        $query->bindParam(3, $celular, PDO::PARAM_STR);
        $query->bindParam(4, $departamento, PDO::PARAM_STR);
        $query->bindParam(5, $distrito, PDO::PARAM_STR);
        $query->bindParam(6, $provincia, PDO::PARAM_STR);
        
        $resultado = $query->execute();
        if ($row = $query->fetchColumn()){
            return $row;
        }
        conexionBD::cerrar_conexion();
    }


    public function Editar_Cliente($idCliente, $nombre, $documento, $celular, $departamento, $distrito, $provincia)
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_MODIFICAR_CLIENTE(?,?,?,?,?,?,?)";
        $arreglo = array();
        $query  = $c->prepare($sql);
        $query->bindParam(1, $idCliente);
        $query->bindParam(2, $nombre);
        $query->bindParam(3, $documento);
        $query->bindParam(4, $celular);
        $query->bindParam(5, $departamento);
        $query->bindParam(6, $distrito);
        $query->bindParam(7, $provincia);

        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexionBD::cerrar_conexion();
    }

    public function Eliminar_Cliente($id) //viene del controlador
    {
        $c = conexionBD::conexionPDO();

        $sql = "CALL SP_ELIMINAR_CLIENTE(?)";
        $query = $c->prepare($sql); //mandamos el precedure
        $query->bindParam(1, $id); //enviamos los parametros seguun la posicion del procedure
        $resultado = $query->execute();
        //solo de usa cuando no se retorna un valor en el procedure(actualizar)
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexionBD::cerrar_conexion();
    }

}
