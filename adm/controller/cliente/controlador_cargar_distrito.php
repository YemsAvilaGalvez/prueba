<?php
require '../../model/model_cliente.php';
$MP = new Modelo_Cliente();//Instaciamos
$provincia = htmlspecialchars($_POST['provincia'], ENT_QUOTES, 'UTF-8');
$consulta = $MP->Cargar_Select_Distrito($provincia);
echo json_encode($consulta);