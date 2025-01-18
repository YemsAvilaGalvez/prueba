<?php
    require '../../model/model_foto.php';
    $MU = new Modelo_Foto();//Instaciamos
    $consulta = $MU->Listar_Foto();
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
