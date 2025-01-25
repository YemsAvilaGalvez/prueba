<?php 
require '../../model/model_comentario.php';

$DEF = NEW Modelo_Comentario();
$ID = htmlspecialchars($_POST['id_tes'], ENT_QUOTES, 'UTF-8');
$consulta = $DEF->Eliminar_Testimonio($ID);
echo $consulta;
