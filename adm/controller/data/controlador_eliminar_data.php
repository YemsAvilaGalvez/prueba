<?php
require '../../model/model_data.php';

$MP = new Modelo_Data();//Instaciamos
$id_data = htmlspecialchars($_POST['id_data'], ENT_QUOTES, 'UTF-8');

$consulta = $MP->Eliminar_Data($id_data);

echo $consulta;

