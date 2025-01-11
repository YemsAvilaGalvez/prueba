<?php
    require '../../model/model_difunto.php';
    $MU = new Modelo_Difunto();//Instaciamos
    $consulta = $MU->Listar_Difunto();
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
