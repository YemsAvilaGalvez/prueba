<?php
session_start();
if (isset($_SESSION['S_ID'])){
    header('Location: views/index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control de Requerimientos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="views/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="views/assets/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="views/logo/logo_circulo.png" type="image/x-icon">
  

  <style>
    body {
      background-color: #e0f2f1;
    }
    .login-page {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #e0f2f1;
    }
    .login-box {
      width: 400px;
    }
    .card {
      border-top: 3px solid #222222;
    }
    .card-header img {
      width: 280px; /* Ajusta el tamaño de la imagen */
      margin-bottom: 10px;
    }
    
    .footer-text {
      text-align: center;
      font-size: 0.85em;
      color: #666;
      margin-top: 10px;
    }
  </style>
</head>
<body class="login-page">
<div class="login-box">
  <div class="card card-outline">
    <div class="card-header text-center">
      <img src="../profile/assets/img/logo/logo_circular.png" alt="Logo"> <!-- Cambia la ruta de la imagen -->
      <h1><b>VIVIR EN MEMORIA</b></h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar Sesión</p>
      <form onsubmit="Iniciar_Sesion(); return false;">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Ingrese su Usuario" id="txt_usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Ingrese su Contraseña" id="txt_contra">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-block shadow-sm mb-3" 
    style="background-color: #222222; border-color: #222222; color: #fff;" 
    onmouseover="this.style.backgroundColor='#444444'" 
    onmouseout="this.style.backgroundColor='#222222'">
    <b>INICIAR SESIÓN</b>
</button>
      </form>

    </div>
  </div>
</div>

<!-- jQuery -->
<script src="views/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="views/assets/dist/js/adminlte.min.js"></script>
<script src="js/console_usuario.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
