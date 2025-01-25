<?php
require '../../model/model_comentario.php';
$MU = new Modelo_Comentario(); // Instanciamos el modelo

// Datos del remitente
$name = strtoupper(htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'));
$message = strtoupper(htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'));

// Registrar el comentario
$consulta = $MU->Registrar_Testimonio($name, $message);

echo $consulta; // Devolver el resultado de la consulta
?>
