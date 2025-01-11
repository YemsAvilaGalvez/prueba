<?php
    require '../../model/model_usuario.php';
    $MU = new Modelo_Usuario();//Instaciamos
    $nombre_usuario = strtoupper(htmlspecialchars($_POST['nombre_usuario'],ENT_QUOTES,'UTF-8')); 
    $usuario = strtoupper(htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8')); 
    $contrasena_usuario  = password_hash(htmlspecialchars($_POST['contrasena_usuario'],ENT_QUOTES,'UTF-8'),PASSWORD_DEFAULT,['cost'=>12]);
    $usu_rol = strtoupper(htmlspecialchars($_POST['usu_rol'],ENT_QUOTES,'UTF-8')); 
    $consulta = $MU->Registrar_Usuario($nombre_usuario,$usuario,$contrasena_usuario,$usu_rol);
    echo $consulta;

?>