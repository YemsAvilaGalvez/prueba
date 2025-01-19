<?php
require '../../model/model_foto.php';

$ruta = "";
$MP = new Modelo_Foto();
$idImangen = htmlspecialchars($_POST['idImangen'], ENT_QUOTES, 'UTF-8');
$nombreFoto = htmlspecialchars($_POST['nombreFoto'], ENT_QUOTES, 'UTF-8');
$fotoActual = htmlspecialchars($_POST['fotoActual'], ENT_QUOTES, 'UTF-8');

$ruta = "controller/foto/img/".$nombreFoto;

$consulta = $MP->Editar_Foto($idImangen, $ruta);
echo $consulta;

if ($consulta == 1) {
    if (!empty($nombreFoto)) {
        if(move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$nombreFoto));

        if ($fotoActual != "controller/foto/img/default.jpg") {
            unlink('../../'.$fotoActual);
        }
    }
    
}