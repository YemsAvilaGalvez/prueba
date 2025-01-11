<?php
    $id_usuario = htmlspecialchars($_POST['id_usuario'], ENT_QUOTES, 'UTF-8');
    $nombre_usuario = htmlspecialchars($_POST['nombre_usuario'], ENT_QUOTES, 'UTF-8');  
    $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8'); 
    $usu_rol = htmlspecialchars($_POST['usu_rol'], ENT_QUOTES, 'UTF-8'); 
    session_start(); 
$_SESSION['S_ID'] = $id_usuario;
$_SESSION['S_USUARIO'] = $nombre_usuario;
$_SESSION['S_USU'] = $usuario;
$_SESSION['S_ROL'] = $usu_rol;

?>
