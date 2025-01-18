<?php
require '../../model/model_foto.php';
$MP = new Modelo_Foto(); // Instanciamos el modelo

$idDifunto = htmlspecialchars($_POST['idDifunto'], ENT_QUOTES, 'UTF-8');
$fotoNames = $_POST['nombresFotos']; // Recibimos los nombres de las fotos

// Verificar si se recibieron archivos
if (!empty($_FILES['foto']['name'][0])) {
    // Iterar sobre todos los archivos subidos
    foreach ($_FILES['foto']['name'] as $index => $fileName) {
        // Obtener la extensión del archivo
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $nombreFoto = $fotoNames[$index]; // Nombre de archivo proporcionado
        $ruta = 'controller/foto/foto/' . $nombreFoto; // Ruta donde se guardará la foto

        // Registrar foto en la base de datos
        $consulta = $MP->Registrar_Foto($idDifunto, $ruta);

        // Verificar si la consulta fue exitosa
        if ($consulta == 1) {
            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($_FILES['foto']['tmp_name'][$index], 'foto/' . $nombreFoto)) {
                echo "Foto subida correctamente: " . $nombreFoto;
            } else {
                echo "Error al mover el archivo: " . $nombreFoto;
            }
        } else {
            echo "Error al registrar la foto en la base de datos.";
        }
    }
} else {
    echo "No se han recibido archivos.";
}
?>
