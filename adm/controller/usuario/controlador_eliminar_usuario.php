<?php 
require '../../model/model_usuario.php';

$MU = new Modelo_Usuario();
$id_usuario = htmlspecialchars($_POST['id_usuario'], ENT_QUOTES, 'UTF-8'); // Cambié el nombre a $id_area para que sea consistente
$consulta = $MU->Eliminar_Usuario($id_usuario); // Usar $id_area en lugar de $id
echo $consulta;
?>
