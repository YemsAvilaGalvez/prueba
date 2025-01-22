<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../adm/views/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../adm/views/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../adm/views/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../adm/views/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="adm/views/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Vivir en Memoria</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                </div>

            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <!-- Default box -->
                        <div class="col-lg-8 col-md-10 col-sm-12">
                            <div class="card">
                                <div class="card-body row">
                                    <div class="col-md-5 text-center d-flex align-items-center justify-content-center">
                                        <div class="">
                                            <h2><strong>REGISTRATE</strong></h2>
                                            <p class="lead mb-5">
                                                123 Testing Ave, Testtown, 9876 NA<br>
                                                Phone: +1 234 56789012
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="txt_documento">N° Documento</label>
                                            <input type="text" class="form-control" id="txt_documento" placeholder="N° Documento">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_nombre">Nombre Completo</label>
                                            <input type="text" class="form-control" id="txt_nombre" placeholder="Nombre Completo">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_celular">Celular</label>
                                            <input type="tel" class="form-control" id="txt_celular" placeholder="Celular">
                                        </div>
                                        <div class="form-group">
                                            <label>Departamento</label>
                                            <select class="form-control select2" id="select_departamento" onchange="Cargar_Select_Provincia()" style="width: 100%;">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Provincia</label>
                                            <select class="form-control select2" id="select_provincia" onchange="Cargar_Select_Distrito()" style="width: 100%;">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Distrito</label>
                                            <select class="form-control select2" id="select_distrito" style="width: 100%;">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" id="btnRegistraCliente" value="Registrar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container -->
            </div>
            <!-- /.content -->


        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    // <script src="../adm/views/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../adm/views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../adm/views/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="recursos/registrar.js?rev=<?php echo time(); ?>"></script>
    <!-- AdminLTE App -->
    <script src="../adm/views/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes 
    <script src="adm/views/assets/dist/js/demo.js"></script> -->

    <script>
        $(document).ready(function() {
            $('.select2').select2()
        })
        Cargar_Select_Departamento();
        Cargar_Select_Provincia();
        Cargar_Select_Distrito();

        $('#btnRegistraCliente').on('click', function() {
            Registrar_Cliente();
        });
    </script>
</body>

</html>