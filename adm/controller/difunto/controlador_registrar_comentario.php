<?php
require '../../model/model_difunto.php';
$MU = new Modelo_Difunto(); // Instanciamos el modelo

// Datos del remitente
$id_difunto = strtoupper(htmlspecialchars($_POST['id_difunto'], ENT_QUOTES, 'UTF-8'));
$name = strtoupper(htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'));
$telefono = strtoupper(htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8'));
$message = strtoupper(htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'));

// Verificar que id_difunto no esté vacío
if (empty($id_difunto)) {
    echo json_encode(["error" => "El ID del difunto es obligatorio."]);
    exit;
}

// Registrar el comentario
$consulta = $MU->Registrar_Comentario($id_difunto, $name, $telefono, $message);

echo $consulta; // Devolver el resultado de la consulta
?>
