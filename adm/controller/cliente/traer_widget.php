<?php
    require '../../model/model_cliente.php';
    $MU = new Modelo_Cliente();//Instaciamos
    $consulta = $MU->Traer_Widget();
    echo json_encode($consulta);

?>