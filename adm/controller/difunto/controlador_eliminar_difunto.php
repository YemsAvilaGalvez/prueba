<?php 
require '../../model/model_difunto.php';

$DEF = NEW Modelo_Difunto();
$ID = htmlspecialchars($_POST['idDifunto'], ENT_QUOTES, 'UTF-8');
$consulta = $DEF->Eliminar_Difunto($ID);
echo $consulta;
