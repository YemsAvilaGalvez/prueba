<?php
require '../../model/model_cliente.php';

$MP = new Modelo_Cliente();//Instaciamos
$documento = htmlspecialchars($_POST['documento'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$celular = htmlspecialchars($_POST['celular'], ENT_QUOTES, 'UTF-8');
$departamento = htmlspecialchars($_POST['departamento'], ENT_QUOTES, 'UTF-8');
$distrito = htmlspecialchars($_POST['distrito'], ENT_QUOTES, 'UTF-8');
$provincia = htmlspecialchars($_POST['provincia'], ENT_QUOTES, 'UTF-8');


$consulta = $MP->Registrar_Cliente($nombre, $documento, $celular, $departamento, $distrito, $provincia);

echo $consulta;

