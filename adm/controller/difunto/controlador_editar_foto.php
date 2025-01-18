<?php
require '../../model/model_difunto.php';

$ruta = "";
$MP = new Modelo_Difunto();
$idDifunto = htmlspecialchars($_POST['idDifunto'], ENT_QUOTES, 'UTF-8');
$nombreFoto = htmlspecialchars($_POST['nombreFoto'], ENT_QUOTES, 'UTF-8');
$fotoActual = htmlspecialchars($_POST['fotoActual'], ENT_QUOTES, 'UTF-8');

$ruta = "controller/difunto/foto/".$nombreFoto;

$consulta = $MP->Editar_Foto($idDifunto, $ruta);
echo $consulta;

if ($consulta == 1) {
    if (!empty($nombreFoto)) {
        if(move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$nombreFoto));

        if ($fotoActual != "controller/difunto/foto/default.jpg") {
            unlink('../../'.$fotoActual);
        }
    }
    
}