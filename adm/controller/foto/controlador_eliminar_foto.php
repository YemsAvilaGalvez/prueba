<?php 
require '../../model/model_foto.php';

$DEF = NEW Modelo_Foto();
$ID = htmlspecialchars($_POST['idFoto'], ENT_QUOTES, 'UTF-8');
$consulta = $DEF->Eliminar_Foto($ID);
echo $consulta;
