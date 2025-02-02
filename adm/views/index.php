<?php
session_start();

if (!isset($_SESSION['S_ID'])) {
    header('Location: ../index.php');
} else {
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vivir en Memoria | Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="../../profile/assets/img/logo/logo_circular.png" type="image/x-icon">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>

                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="../controller/usuario/controlador_cerrar_sesion.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../../profile/assets/img/logo/logo_circular.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-bold">VIVIR EN MEMORIA</span>
            </a>
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../profile/assets/img/logo/logo_circular.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><strong><?php echo $_SESSION['S_USUARIO'] ?></strong></a>
                        <a href="#" class="d-block"><strong><?php echo $_SESSION['S_ROL'] ?></strong></a>

                    </div>
                </div>
                <!-- Sidebar -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="window.location.href='index.php'">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p class="font-weight-bold">DASHBOARD</p>
                            </a>
                        </li>

                        <!-- Agencias -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','clientes/view_clientes.php')">
                                <i class="nav-icon fas fa-users"></i> <!-- Cambié el icono a 'fa-users' -->
                                <p class="font-weight-bold">CLIENTES</p>
                            </a>
                        </li>

                        <!-- Cargos -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','difuntos/view_difuntos.php')">
                                <i class="nav-icon fas fa-bed"></i> <!-- Cambié el icono a 'fa-bed' para diferenciar 'Difuntos' -->
                                <p class="font-weight-bold">DIFUNTOS</p>
                            </a>
                        </li>

                        <!-- Trabajadores -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','fotos/view_fotos.php')">
                                <i class="nav-icon fas fa-image"></i> <!-- Cambié el icono a 'fa-image' -->
                                <p class="font-weight-bold">IMAGENES</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','comentarios/view_comentarios.php')">
                                <i class="nav-icon fas fa-users"></i> <!-- Cambié el icono a 'fa-users' para representar mejor 'Usuarios' -->
                                <p class="font-weight-bold">COMENTARIOS</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','difuntos/view_dataPersonal.php')">
                                <i class="nav-icon fas fa-users"></i> <!-- Cambié el icono a 'fa-users' para representar mejor 'Usuarios' -->
                                <p class="font-weight-bold">DATOS PERSONALES</p>
                            </a>
                        </li>

                        <!-- Asistencias del día -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','usuario/view_usuario.php')">
                                <i class="nav-icon fas fa-users"></i> <!-- Cambié el icono a 'fa-users' para representar mejor 'Usuarios' -->
                                <p class="font-weight-bold">USUARIOS</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i> <!-- Cambié el icono a 'fa-chart-bar' para 'REPORTES' -->
                                <p class="font-weight-bold">
                                    REPORTES
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="#" onclick="cargar_contenido('contenido_principal','reportes/view_difuntos_vencer.php')" class="nav-link">
                                        <span class="nav-icon" style="display: inline-block; width: 8px; height: 8px; background-color: white; border-radius: 50%; margin-right: 10px;"></span>
                                        <p class="font-weight-bold" style="font-size: 0.9rem;">DIFUNTOS VENCIMIENTO</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>

                <!-- /.sidebar -->
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="contenido_principal">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- Total de Clientes -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background-color: #28a745; color: white; font-weight: bold;"> <!-- Verde oscuro -->
                                <div class="inner">
                                    <h3 id="lbl_clientes">0</h3> <!-- Total de clientes -->
                                    <p>Total de Clientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i> <!-- Icono de clientes -->
                                </div>
                                <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','clientes/view_clientes.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Total de Difuntos -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background-color: #ffc107; color: white; font-weight: bold;"> <!-- Amarillo -->
                                <div class="inner">
                                    <h3 id="lbl_difuntos">0</h3> <!-- Total de difuntos -->
                                    <p>Total de Difuntos</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-bed"></i> <!-- Icono de difuntos -->
                                </div>
                                <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','difuntos/view_difuntos.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Total de Usuarios -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background-color: #007bff; color: white; font-weight: bold;"> <!-- Azul -->
                                <div class="inner">
                                    <h3 id="lbl_usuarios">0</h3> <!-- Total de usuarios -->
                                    <p>Total de Usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users-cog"></i> <!-- Icono de usuarios -->
                                </div>
                                <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','usuario/view_usuario.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Clientes a Vencer -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background-color: #dc3545; color: white; font-weight: bold;"> <!-- Rojo oscuro -->
                                <div class="inner">
                                    <h3 id="lbl_difuntos_vencer">0</h3> <!-- Clientes a vencer -->
                                    <p>Difuntos con plan próximo a vencer</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exclamation-triangle"></i> <!-- Icono de alerta -->
                                </div>
                                <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','reportes/view_difuntos_vencer.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Ganancias -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background-color: #17a2b8; color: white; font-weight: bold;"> <!-- Azul claro -->
                                <div class="inner">
                                    <h3 id="lbl_ganancias">0</h3> <!-- Total de ganancias -->
                                    <p>Ganancias</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i> <!-- Icono de ganancias -->
                                </div>
                                <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','ganancias/view_ganancias.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2025-2025.</strong> Bruno And Shagy -> All Rights Reserved
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- datatable -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/jszip/jszip.min.js"></script>
    <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Select2 -->
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>


    <script>
        Traer_Widget();

        function Traer_Widget() {
            $.ajax({
                "url": "../controller/cliente/traer_widget.php",
                type: 'POST'
            }).done(function(resp) {
                let data = JSON.parse(resp);
                if (data.length > 0) {
                    document.getElementById('lbl_clientes').innerHTML = data[0][0];
                    document.getElementById('lbl_difuntos').innerHTML = data[0][1];
                    document.getElementById('lbl_usuarios').innerHTML = data[0][2];
                    document.getElementById('lbl_difuntos_vencer').innerHTML = data[0][3];
                    document.getElementById('lbl_ganancias').innerHTML = data[0][4];

                }
            })
        }
    </script>

    <script>
        function cargar_contenido(id, vista) {
            $("#" + id).load(vista);
        }

        var idioma_espanol = {
            select: {
                rows: "%d fila seleccionada"
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b>No se encontraron datos</b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

        function soloNumeros(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8) {
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function soloImagenes(fileInput) {
            // Lista de extensiones permitidas
            var extensionesPermitidas = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            // Obtener el valor del input (nombre del archivo)
            var archivo = fileInput.value;

            // Verificar si el archivo cumple con el patrón de extensiones permitidas
            if (!extensionesPermitidas.test(archivo)) {
                //alert("Solo se permiten archivos con extensiones .jpg, .jpeg, .png, .gif");
                Swal.fire(
                    "Mensaje de Advertencia",
                    "Solo se permiten archivos con extensiones .jpg, .jpeg, .png, .gif",
                    "warning"
                );
                fileInput.value = ''; // Limpiar el input si la extensión no es válida
                return false;
            }

            return true;
        }

        function soloAudios(fileInput) {
            // Lista de extensiones permitidas para archivos de audio
            var extensionesPermitidas = /(\.mp3|\.wav|\.ogg|\.flac)$/i;

            // Obtener el valor del input (nombre del archivo)
            var archivo = fileInput.value;

            // Verificar si el archivo cumple con el patrón de extensiones permitidas
            if (!extensionesPermitidas.test(archivo)) {
                //alert("Solo se permiten archivos de audio con extensiones .mp3, .wav, .ogg, .flac");
                Swal.fire(
                    "Mensaje de Advertencia",
                    "Solo se permiten archivos de audio con extensiones .mp3, .wav, .ogg, .flac",
                    "warning"
                );
                fileInput.value = ''; // Limpiar el input si la extensión no es válida
                return false;
            }

            return true;
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }

        function filterFloat(evt, input) {
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value + chark;
            if (key >= 48 && key <= 57) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (key == 8 || key == 13 || key == 0) {
                    return true;
                } else if (key == 46) {
                    if (filter(tempValue) === false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }

        function filter(__val__) {
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if (preg.test(__val__) === true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>

</html>