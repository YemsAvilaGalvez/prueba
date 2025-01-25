<?php 
require '../../model/model_comentario.php';

$DEF = NEW Modelo_Comentario();
$ID = htmlspecialchars($_POST['id_comentario'], ENT_QUOTES, 'UTF-8');
$consulta = $DEF->Eliminar_Condolencia($ID);
echo $consulta;
