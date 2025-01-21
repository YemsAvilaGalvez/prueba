<?php
require '../../model/model_cliente.php';
$MP = new Modelo_Cliente();//Instaciamos
$consulta = $MP->Cargar_Select_Departamento();
echo json_encode($consulta);