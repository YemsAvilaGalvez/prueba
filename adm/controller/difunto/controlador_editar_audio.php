<?php
require '../../model/model_difunto.php';

$audio = "";
$MP = new Modelo_Difunto();
$idDifuntoAudio = htmlspecialchars($_POST['idDifuntoAudio'], ENT_QUOTES, 'UTF-8');
$nombreAudio = htmlspecialchars($_POST['nombreAudio'], ENT_QUOTES, 'UTF-8');
$audioActual = htmlspecialchars($_POST['audioActual'], ENT_QUOTES, 'UTF-8');

$audio = "controller/difunto/audio/".$nombreAudio;

$consulta = $MP->Editar_Audio($idDifuntoAudio, $audio);
echo $consulta;

if ($consulta == 1) {
    if (!empty($nombreAudio)) {
        if(move_uploaded_file($_FILES['audio']['tmp_name'], "audio/".$nombreAudio));

        if ($audioActual != "controller/difunto/audio/default.mp3") {
            unlink('../../'.$audioActual);
        }
    }
    
}