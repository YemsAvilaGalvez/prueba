<?php
require '../../model/model_data.php';

$MP = new Modelo_Data();//Instaciamos
$idDifunto = htmlspecialchars($_POST['idDifunto'], ENT_QUOTES, 'UTF-8');
$fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
$hobbies = htmlspecialchars($_POST['hobbies'], ENT_QUOTES, 'UTF-8');

$consulta = $MP->Registrar_Data($idDifunto, $fecha, $hobbies);

echo $consulta;

