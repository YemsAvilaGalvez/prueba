<?php
require '../../model/model_foto.php';
$MP = new Modelo_Foto(); // Instanciamos
$idDifunto = htmlspecialchars($_POST['idDifunto'], ENT_QUOTES, 'UTF-8');
$rutas = []; // Arreglo para almacenar las rutas de las imágenes

// Verificar que al menos un archivo se haya subido
if (isset($_FILES['foto']) && !empty($_FILES['foto']['name'][0])) {
    $fotos = $_FILES['foto']; // Obtenemos todos los archivos
    $nombresFotos = $_POST['nombreFoto']; // Nombres de los archivos

    // Iteramos a través de todos los archivos
    foreach ($fotos['name'] as $index => $nombreFoto) {
        // Depuración: Verificar las rutas que se están procesando
        echo "Nombre de archivo: " . $nombreFoto . "<br>"; // Verifica el nombre de cada archivo
        echo "Ruta a guardar: " . 'controller/foto/img/' . $nombresFotos[$index] . "<br>"; // Verifica la ruta completa

        $ruta = 'controller/foto/img/' . $nombresFotos[$index]; // Ruta de la imagen
        $rutas[] = $ruta; // Agregamos la ruta al arreglo
    }

    // Registrar todas las fotos en la base de datos
    $consulta = $MP->Registrar_Foto($idDifunto, $rutas);
    echo "Resultado consulta: " . $consulta . "<br>"; // Verifica la respuesta de la consulta

    // Si la consulta fue exitosa, mover los archivos
    if ($consulta == 1) {
        foreach ($fotos['name'] as $index => $nombreFoto) {
            if (move_uploaded_file($fotos['tmp_name'][$index], 'img/' . $nombresFotos[$index])) {
                echo "Archivo " . $nombresFotos[$index] . " subido con éxito.<br>";
            } else {
                echo "Error al mover el archivo " . $nombresFotos[$index] . "<br>";
            }
        }
    } else {
        echo "Error al registrar las fotos en la base de datos.<br>";
    }
} else {
    echo "No se seleccionaron imágenes.<br>";
}
?>
