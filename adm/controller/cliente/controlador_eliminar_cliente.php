<?php 
require '../../model/model_cliente.php';

$DEF = NEW Modelo_Cliente();
$ID = htmlspecialchars($_POST['idCliente'], ENT_QUOTES, 'UTF-8');
$consulta = $DEF->Eliminar_Cliente($ID);
echo $consulta;
