<?php
    require '../../model/model_cliente.php';
    $MU = new Modelo_Cliente();//Instaciamos
    $consulta = $MU->Listar_Cliente();
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }
?>
