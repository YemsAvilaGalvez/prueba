<?php
require '../../model/model_cliente.php';
$MP = new Modelo_Cliente();//Instaciamos
$departamento = htmlspecialchars($_POST['departamento'], ENT_QUOTES, 'UTF-8');
$consulta = $MP->Cargar_Select_Provincia($departamento);
echo json_encode($consulta);