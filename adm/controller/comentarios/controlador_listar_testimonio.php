<?php
    require '../../model/model_comentario.php';
    $MU = new Modelo_Comentario();//Instaciamos
    $consulta = $MU->Listar_Testimonio();
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
