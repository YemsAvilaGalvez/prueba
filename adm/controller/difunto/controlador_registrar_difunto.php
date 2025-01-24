<?php
require '../../model/model_difunto.php';
$ruta = "";
$cancion = "";
$portada = "";
$MP = new Modelo_Difunto();//Instaciamos
$documentoCliente = htmlspecialchars($_POST['documentoCliente'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$fechaNacimiento = htmlspecialchars($_POST['fechaNacimiento'], ENT_QUOTES, 'UTF-8');
$fechaFallecimiento = htmlspecialchars($_POST['fechaFallecimiento'], ENT_QUOTES, 'UTF-8');
$biografia = htmlspecialchars($_POST['biografia'], ENT_QUOTES, 'UTF-8');
$video = htmlspecialchars($_POST['videoLink'], ENT_QUOTES, 'UTF-8');
$ubicacion = ($_POST['ubicacionLink']);
$nombreAudio = htmlspecialchars($_POST['nombreAudio'], ENT_QUOTES, 'UTF-8');
$nombreFoto = htmlspecialchars($_POST['nombreFoto'], ENT_QUOTES, 'UTF-8');
$nombreFotoPortada = htmlspecialchars($_POST['nombreFotoPortada'], ENT_QUOTES, 'UTF-8');
$plan = htmlspecialchars($_POST['plan'], ENT_QUOTES, 'UTF-8');
$fechaFin = htmlspecialchars($_POST['fechaFin'], ENT_QUOTES, 'UTF-8');

if (empty($nombreFoto)){
    $ruta = 'controller/difunto/foto/default.jpg';
}else{
    $ruta = 'controller/difunto/foto/'.$nombreFoto;
}

if (empty($nombreFotoPortada)){
    $portada = 'controller/difunto/portada/default.png';
}else{
    $portada = 'controller/difunto/portada/'.$nombreFotoPortada;
}

if (empty($nombreAudio)){
    $cancion = 'controller/difunto/audio/default.mp3';
}else{
    $cancion = 'controller/difunto/audio/'.$nombreAudio;
}

$consulta = $MP->Registrar_Difunto($documentoCliente, $nombre, $fechaNacimiento, $fechaFallecimiento, $biografia, $ruta, $portada, $video, $ubicacion, $cancion, $plan, $fechaFin);

echo $consulta;

if ($consulta == 1) {
    if (!empty($nombreFoto)){
        if (move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/'.$nombreFoto));
    }

    if (!empty($nombreFotoPortada)){
        if (move_uploaded_file($_FILES['portada']['tmp_name'], 'portada/'.$nombreFotoPortada));
    }

    if (!empty($nombreAudio)){
        if (move_uploaded_file($_FILES['audio']['tmp_name'], 'audio/'.$nombreAudio));
    }
}