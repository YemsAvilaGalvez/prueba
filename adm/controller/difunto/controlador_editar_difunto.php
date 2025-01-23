<?php
require '../../model/model_difunto.php';

$MP = new Modelo_Difunto();
$idDifunto = htmlspecialchars($_POST['idDifunto'], ENT_QUOTES, 'UTF-8');
$documentoCliente = htmlspecialchars($_POST['documentoCliente'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$fechaNacimiento = htmlspecialchars($_POST['fechaNacimiento'], ENT_QUOTES, 'UTF-8');
$fechaFallecimiento = htmlspecialchars($_POST['fechaFallecimiento'], ENT_QUOTES, 'UTF-8');
$biografia = htmlspecialchars($_POST['biografia'], ENT_QUOTES, 'UTF-8');
$videoLink = ($_POST['videoLink']);
$ubicacionLink = htmlspecialchars($_POST['ubicacionLink'], ENT_QUOTES, 'UTF-8');
$plan = htmlspecialchars($_POST['plan'], ENT_QUOTES, 'UTF-8');
$fechaFin = htmlspecialchars($_POST['fechaFin'], ENT_QUOTES, 'UTF-8');
$estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

$cancion = "controller/difunto/audio/".$nombreAudio;

$consulta = $MP->Editar_Difunto($idDifunto, $documentoCliente, $nombre, $fechaNacimiento, $fechaFallecimiento, $biografia, $videoLink, $ubicacionLink, $plan, $fechaFin, $estado);

echo $consulta;