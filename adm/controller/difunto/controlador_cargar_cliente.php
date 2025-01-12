<?php
require '../../model/model_difunto.php';
$MP = new Modelo_Difunto();//Instaciamos
$consulta = $MP->Cargar_Select_Cliente();
echo json_encode($consulta);