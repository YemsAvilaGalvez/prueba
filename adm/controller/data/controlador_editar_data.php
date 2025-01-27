<?php
require '../../model/model_data.php';

$MP = new Modelo_Data();//Instaciamos
$idData = htmlspecialchars($_POST['idData'], ENT_QUOTES, 'UTF-8');
$fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
$hobbies = htmlspecialchars($_POST['hobbies'], ENT_QUOTES, 'UTF-8');

$consulta = $MP->Editar_Data($idData, $fecha, $hobbies);

echo $consulta;

