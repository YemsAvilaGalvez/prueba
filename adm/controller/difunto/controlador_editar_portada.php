<?php
require '../../model/model_difunto.php';

$portada = "";
$MP = new Modelo_Difunto();
$idDifuntoPortada = htmlspecialchars($_POST['idDifuntoPortada'], ENT_QUOTES, 'UTF-8');
$nombreFotoPortada = htmlspecialchars($_POST['nombreFotoPortada'], ENT_QUOTES, 'UTF-8');
$portadaActual = htmlspecialchars($_POST['portadaActual'], ENT_QUOTES, 'UTF-8');

$portada = "controller/difunto/portada/".$nombreFotoPortada;

$consulta = $MP->Editar_Portada($idDifuntoPortada, $portada);
echo $consulta;

if ($consulta == 1) {
    if (!empty($nombreFotoPortada)) {
        if(move_uploaded_file($_FILES['portada']['tmp_name'], "portada/".$nombreFotoPortada));

        if ($portadaActual != "controller/difunto/portada/default.jpg") {
            unlink('../../'.$portadaActual);
        }
    }
    
}