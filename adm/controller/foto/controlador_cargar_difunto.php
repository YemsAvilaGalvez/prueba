<?php
require '../../model/model_foto.php';
$MP = new Modelo_Foto();//Instaciamos
$consulta = $MP->Cargar_Select_Difunto();
echo json_encode($consulta);