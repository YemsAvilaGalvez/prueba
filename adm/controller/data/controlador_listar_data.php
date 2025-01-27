<?php
    require '../../model/model_data.php';
    $MU = new Modelo_Data();//Instaciamos
    $consulta = $MU->Listar_Data();
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
