<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'prueba_final_v2';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql_testimonio = "SELECT nombre, comentario, fechates FROM testimonio";
$stmt_testimonio = $conn->prepare($sql_testimonio);

if ($stmt_testimonio === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt_testimonio->execute();
$result_testimonio = $stmt_testimonio->get_result();

if ($result_testimonio->num_rows > 0) {
    while ($testimonio = $result_testimonio->fetch_assoc()) {
    }
}

$stmt_testimonio->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vivir en Memoria</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="profile/assets/img/logo/logo_circular.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- AOS Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<style>
    .card {
        transition: transform 0.3s ease-in-out;
        border-radius: 10px;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .card-header h4 {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-body ul {
        list-style: none;
        padding-left: 0;
    }

    .card-body ul li {
        margin-bottom: 10px;
    }

    .card-body p {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .p-large {
        font: 400 1rem/1.5rem "Raleway", sans-serif;
    }

    .p-small {
        font: 400 0.75rem/1.25rem "Raleway", sans-serif;
    }

    .p-heading {
        margin-bottom: 3.875rem;
    }

    .li-space-lg li {
        margin-bottom: 0.25rem;
    }

    .indent {
        padding-left: 1.25rem;
    }



    .btn-solid-reg {
        display: inline-block;
        padding: 1.1875rem 2.125rem 1.1875rem 2.125rem;
        border: 0.125rem solid #222222;
        border-radius: 2rem;
        background-color: #222222;
        color: #fff;
        font: 700 0.75rem/0 "Raleway", sans-serif;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-solid-reg:hover {
        background-color: transparent;
        color: #222222;
        text-decoration: none;
    }

    .btn-solid-lg {
        display: inline-block;
        padding: 1.375rem 2.625rem 1.375rem 2.625rem;
        border: 0.125rem solid #222222;
        border-radius: 2rem;
        background-color: #222222;
        color: #fff;
        font: 700 0.75rem/0 "Raleway", sans-serif;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-solid-lg:hover {
        background-color: transparent;
        color: #222222;
        text-decoration: none;
    }

    .btn-outline-reg {
        display: inline-block;
        padding: 1.1875rem 2.125rem 1.1875rem 2.125rem;
        border: 0.125rem solid #222222;
        border-radius: 2rem;
        background-color: transparent;
        color: #222222;
        font: 700 0.75rem/0 "Raleway", sans-serif;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-outline-reg:hover {
        background-color: #222222;
        color: #fff;
        text-decoration: none;
    }

    .btn-outline-lg {
        display: inline-block;
        padding: 1.375rem 2.625rem 1.375rem 2.625rem;
        border: 0.125rem solid #222222;
        border-radius: 2rem;
        background-color: transparent;
        color: #222222;
        font: 700 0.75rem/0 "Raleway", sans-serif;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-outline-lg:hover {
        background-color: #222222;
        color: #fff;
        text-decoration: none;
    }

    .btn-outline-sm {
        display: inline-block;
        padding: 1rem 1.625rem 0.875rem 1.625rem;
        border: 0.125rem solid #222222;
        border-radius: 2rem;
        background-color: transparent;
        color: #222222;
        font: 700 0.625rem/0 "Raleway", sans-serif;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-outline-sm:hover {
        background-color: #222222;
        color: #fff;
        text-decoration: none;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.25rem;
    }

    .form-group.has-error.has-danger {
        margin-bottom: 0.625rem;
    }

    .form-group.has-error.has-danger .help-block.with-errors ul {
        margin-top: 0.375rem;
    }

    .label-control {
        position: absolute;
        top: 0.87rem;
        left: 1.375rem;
        color: #626262;
        opacity: 1;
        font: 400 0.875rem/1.375rem "Raleway", sans-serif;
        cursor: text;
        transition: all 0.2s ease;
    }

    /* IE10+ hack to solve lower label text position compared to the rest of the browsers */
    @media screen and (-ms-high-contrast: active),
    screen and (-ms-high-contrast: none) {
        .label-control {
            top: 0.9375rem;
        }
    }

    .form-control-input:focus+.label-control,
    .form-control-input.notEmpty+.label-control,
    .form-control-textarea:focus+.label-control,
    .form-control-textarea.notEmpty+.label-control {
        top: 0.125rem;
        opacity: 1;
        font-size: 0.75rem;
        font-weight: 700;
    }



    /***********************/
    /*     10. Pricing     */
    /***********************/
    .cards-2 {
        padding-top: 3rem;
        padding-bottom: 2.75rem;
        text-align: center;
    }

    .cards-2 h2 {
        margin-bottom: 1rem;
    }

    .cards-2 .card {
        display: block;
        max-width: 19.5rem;
        margin-right: auto;
        margin-bottom: 6rem;
        margin-left: auto;
        border: 1px solid #c4d8dc;
        border-radius: 0.5rem;
    }

    .cards-2 .card .card-body {
        padding: 2.5rem 2.75rem 1.875rem 2.5rem;
    }

    .cards-2 .card .card-title {
        margin-bottom: 0.625rem;
        color: #393939;
        font-weight: 700;
        font-size: 1.75rem;
        line-height: 2.25rem;
        text-align: center;
    }

    .cards-2 .card .card-subtitle {
        margin-bottom: 1.75rem;
    }

    .cards-2 .card .cell-divide-hr {
        height: 1px;
        margin-top: 0;
        margin-bottom: 0;
        border: none;
        background-color: #c4d8dc;
    }

    .cards-2 .card .price {
        padding-top: 0.875rem;
        padding-bottom: 1.5rem;
    }

    .cards-2 .card .value {
        color: #222222;
        font-weight: 700;
        font-size: 3.5rem;
        line-height: 4rem;
        text-align: center;
    }

    .cards-2 .card .currency {
        margin-right: 0.375rem;
        color: #222222;
        font-size: 1.5rem;
        vertical-align: 56%;
    }

    .cards-2 .card .frequency {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        text-align: center;
    }

    .cards-2 .card .list-unstyled {
        margin-top: 1.875rem;
        margin-bottom: 1.625rem;
        text-align: left;
    }

    .cards-2 .card .list-unstyled.li-space-lg li {
        margin-bottom: 0.5rem;
    }

    .cards-2 .card .list-unstyled .fas {
        color: #222222;
        line-height: 1.375rem;
    }

    .cards-2 .card .list-unstyled .fas.fa-times {
        margin-left: 0.1875rem;
        margin-right: 0.125rem;
        color: #777b7e;
    }

    .cards-2 .card .list-unstyled .media-body {
        margin-left: 0.625rem;
    }

    .cards-2 .card .button-wrapper {
        position: absolute;
        right: 0;
        bottom: -1.25rem;
        left: 0;
        text-align: center;
    }

    .cards-2 .card .btn-solid-reg:hover {
        background-color: #fff;
    }

    /* Best Value Label */
    .cards-2 .card .label {
        position: absolute;
        top: 0;
        right: 0;
        width: 10.625rem;
        height: 10.625rem;
        overflow: hidden;
    }

    .cards-2 .card .label .best-value {
        position: relative;
        width: 13.75rem;
        padding: 0.3125rem 0 0.3125rem 4.125rem;
        background-color: #222222;
        color: #fff;
        -webkit-transform: rotate(45deg) translate3d(0, 0, 0);
        -ms-transform: rotate(45deg) translate3d(0, 0, 0);
        transform: rotate(45deg) translate3d(0, 0, 0);
    }

    /* end of best value label */






    /* Min-width width 992px */
    @media (min-width: 992px) {

        /* Navigation */
        .navbar-custom {
            padding: 2.125rem 1.5rem 2.125rem 2rem;
            box-shadow: none;
            background: transparent;
        }

        .navbar-custom .navbar-nav {
            margin-top: 0;
            margin-bottom: 0;
        }

        .navbar-custom .nav-item .nav-link {
            padding: 0.25rem 0.75rem 0.25rem 0.75rem;
            color: #fff;
            opacity: 0.8;
        }

        .navbar-custom .nav-item .nav-link:hover,
        .navbar-custom .nav-item .nav-link.active {
            color: #fff;
            opacity: 1;
        }

        .navbar-custom.top-nav-collapse {
            padding: 0.5rem 1.5rem 0.5rem 2rem;
            box-shadow: 0 0.0625rem 0.375rem 0 rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .navbar-custom.top-nav-collapse .nav-item .nav-link {
            color: #393939;
            opacity: 1;
        }

        .navbar-custom.top-nav-collapse .nav-item .nav-link:hover,
        .navbar-custom.top-nav-collapse .nav-item .nav-link.active {
            color: #222222;
        }

        .navbar-custom .dropdown-menu {
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-top: 0.75rem solid rgba(0, 0, 0, 0);
            border-radius: 0.25rem;
        }

        .navbar-custom.top-nav-collapse .dropdown-menu {
            border-top: 0.5rem solid rgba(0, 0, 0, 0);
            box-shadow: 0 0.375rem 0.375rem 0 rgba(0, 0, 0, 0.02);
        }

        .navbar-custom .dropdown-item {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .navbar-custom .dropdown-items-divide-hr {
            width: 84%;
        }

        .navbar-custom .social-icons {
            display: block;
            margin-left: 0.5rem;
        }

        .navbar-custom .fa-stack {
            margin-bottom: 0.1875rem;
            margin-left: 0.25rem;
            font-size: 0.75rem;
        }

        .navbar-custom .fa-stack-2x {
            color: #222222;
            transition: all 0.2s ease;
        }

        .navbar-custom .fa-stack-1x {
            color: #fff;
            transition: all 0.2s ease;
        }

        .navbar-custom .fa-stack:hover .fa-stack-2x {
            color: #fff;
        }

        .navbar-custom .fa-stack:hover .fa-stack-1x {
            color: #222222;
        }

        .navbar-custom.top-nav-collapse .fa-stack-2x {
            color: #222222;
        }

        .navbar-custom.top-nav-collapse .fa-stack-1x {
            color: #fff;
        }

        .navbar-custom.top-nav-collapse .fa-stack:hover .fa-stack-2x {
            color: #00a7bd;
        }

        .navbar-custom.top-nav-collapse .fa-stack:hover .fa-stack-1x {
            color: #fff;
        }

        /* end of navigation */


        /* General Styles */
        .p-heading {
            width: 65%;
        }

        /* end of general styles */



        /* Pricing */
        .cards-2 .card {
            display: inline-block;
            width: 17.125rem;
            max-width: 100%;
            margin-right: 1rem;
            margin-left: 1rem;
        }

        /* end of pricing */








        /* Min-width width 1200px */
        @media (min-width: 1200px) {

            /* Navigation */
            .navbar-custom {
                padding: 2.125rem 5rem 2.125rem 5rem;
            }

            .navbar-custom.top-nav-collapse {
                padding: 0.5rem 5rem 0.5rem 5rem;
            }

            /* end of navigation */


            /* General Styles */
            .p-heading {
                width: 55%;
            }

            /* end of general styles */


            /* Header */
            .header .header-content {
                padding-top: 12.5rem;
            }

            .header .text-container {
                margin-top: 5.375rem;
                margin-left: 1rem;
                margin-right: 2rem;
            }

            .header .image-container {
                margin-left: 2rem;
                margin-right: 1rem;
            }

            /* end of header */


            /* Customers */
            .slider-1 .slider-container {
                margin-right: 3rem;
                margin-left: 3rem;
                padding-right: 2.5rem;
                padding-left: 2.5rem;
            }

            /* end of customers */


            /* Services */
            .cards-1 .card {
                max-width: 21rem;
            }

            .cards-1 .col-lg-12 div.card:nth-child(3n+2) {
                margin-right: 2.875rem;
                margin-left: 2.875rem;
            }

            /* end of services */


            /* Details 1 */
            .basic-1 .text-container {
                margin-top: 6.125rem;
                margin-right: 4rem;
                margin-left: 1rem;
            }

            /* end of details 1 */


            /* Details 2 */
            .basic-2 .text-container {
                margin-top: 5.375rem;
                margin-right: 1rem;
                margin-left: 4rem;
            }

            /* end of details 2 */


            /* Pricing */
            .cards-2 .card {
                width: 19.5rem;
                margin-right: 1.625rem;
                margin-left: 1.625rem;
            }

            /* end of pricing */
        }
    }

    /*  */
    /* end of min-width width 1200px */
</style>

<body>
    <!-- Header-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 bg-secondary d-none d-lg-block">
                <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <img src="profile/assets/img/logo/logo_blanco.png" alt="Justice" class="img-fluid" style="max-width: 70%;">
                </a>
            </div>
            <div class="col-lg-9">
                <div class="row bg-white border-bottom d-none d-lg-flex">
                    <div class="col-lg-7 text-left">
                        <div class="h-100 d-inline-flex align-items-center py-2 px-3">
                            <i class="fa fa-envelope text-primary mr-2"></i>
                            <small>contacto@vivirenmemoria.com</small>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center py-2 px-2">
                            <i class="fa fa-phone-alt text-primary mr-2"></i>
                            <small>999 999 999</small>
                        </div>
                    </div>
                    <div class="col-lg-5 text-right">
                        <div class="d-inline-flex align-items-center p-2">
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
                    <a href="index.html" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary text-uppercase">Justice</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Inicio</a>
                            <a href="#nosotros" class="nav-item nav-link">Sobre Nosotros</a>
                            <a href="#servicios" class="nav-item nav-link">Servicios</a>
                            <a href="#memoriales" class="nav-item nav-link">Memoriales</a>
                            <a href="#planes" class="nav-item nav-link">Planes</a>
                        </div>
                        <a href="" class="btn btn-primary mr-3 d-none d-lg-block">Contactanos</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header-->


    <!-- Inicio -->
    <div class="container-fluid p-0 mb-1 pb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 text-center" style="max-width: 900px; background: rgba(0, 0, 0, 0.6); border-radius: 15px;">
                            <h4 class="text-white text-uppercase mb-3" style="letter-spacing: 3px; font-weight: bold;">VIVIR EN MEMORIA</h4>
                            <h2 class="display-3 text-white mb-4" style="font-weight: bold;">Preserva la memoria de tus seres queridos</h2>
                            <p class="text-white mb-4" style="font-size: 1.2rem;">
                                Crea un espacio único donde familiares y amigos puedan recordar, compartir momentos especiales y honrar la vida de tus seres queridos con un memorial digital.
                            </p>
                            <a href="#servicios" class="btn btn-primary py-3 px-5 text-uppercase" style="font-size: 1rem; font-weight: bold; border-radius: 30px;">Explorar Servicios</a>
                            <a href="#registrar" class="btn btn-outline-light py-3 px-5 ml-3 text-uppercase" style="font-size: 1rem; font-weight: bold; border-radius: 30px;">Crear Memorial</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inicio -->

    <!-- Sobre Nosotros -->
    <div class="container-fluid py-1" id="nosotros">
        <div class="container py-5">
            <div class="row align-items-center">
                <!-- Imagen -->
                <div class="col-lg-5" data-aos="fade-right">
                    <img class="img-fluid rounded" src="img/about.jpg" alt="Imagen conmemorativa">
                </div>

                <!-- Texto y detalles -->
                <div class="col-lg-7 mt-4 mt-lg-0" data-aos="fade-left">
                    <h2 class="position-relative text-center bg-white text-primary rounded p-3 mt-4 mb-4 d-none d-lg-block" style="width: 350px; margin-left: -205px;">VIVIR EN MEMORIA</h2>
                    <h6 class="text-uppercase" data-aos="fade-up" data-aos-delay="200">Bienvenidos</h6>
                    <h1 class="mb-4" data-aos="fade-up" data-aos-delay="400">Honra y preserva los recuerdos de tus seres queridos</h1>
                    <p data-aos="fade-up" data-aos-delay="600">
                        En <strong>"Vivir en Memoria"</strong>, nos especializamos en crear páginas conmemorativas únicas y personalizadas para rendir tributo a tus seres queridos. A través de un simple escaneo de un código QR, podrás revivir sus historias, compartir sus memorias y mantener su legado vivo para siempre.
                    </p>
                    <a href="#planes" class="btn btn-primary mt-2" data-aos="zoom-in" data-aos-delay="800">Descubre más</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Sobre Nosotros -->

    <!-- Características -->
    <div class="container-fluid py-1">
        <div class="container py-5">
            <div class="row">
                <!-- Columna de texto (ahora a la izquierda) -->
                <div class="col-lg-6 pt-5 pb-lg-5" data-aos="fade-right" data-aos-duration="1000">
                    <div class="feature-text bg-white rounded p-lg-5">
                        <h6 class="text-uppercase text-primary">Características</h6>
                        <h1 class="mb-4">Por qué elegirnos</h1>
                        <div class="d-flex mb-4">
                            <div class="btn-primary btn-lg-square px-3" style="border-radius: 50px;">
                                <h5 class="text-secondary m-0">01</h5>
                            </div>
                            <div class="ml-4">
                                <h5>Páginas únicas y personalizadas</h5>
                                <p class="m-0">Crea un espacio digital único para honrar y recordar a tus seres queridos, con fotos, videos, y momentos especiales.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="btn-primary btn-lg-square px-3" style="border-radius: 50px;">
                                <h5 class="text-secondary m-0">02</h5>
                            </div>
                            <div class="ml-4">
                                <h5>Escaneo con QR</h5>
                                <p class="m-0">Acceso rápido y sencillo a la página con un código QR grabado en la placa conmemorativa.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="btn-primary btn-lg-square px-3" style="border-radius: 50px;">
                                <h5 class="text-secondary m-0">03</h5>
                            </div>
                            <div class="ml-4">
                                <h5>Conexión a través de recuerdos</h5>
                                <p class="m-0">Comparte momentos y mensajes con familiares y amigos, manteniendo vivo el recuerdo de tus seres queridos.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna de imagen (ahora a la derecha) -->
                <div class="col-lg-6" style="min-height: 500px;" data-aos="fade-left" data-aos-duration="1000">
                    <div class="position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="img/feature.jpg" style="object-fit: cover;" alt="Memoria">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Características End -->


    <!-- Nuestros Servicios -->
    <div class="container-fluid py-5" style="background: #F4F4F4;" id="servicios">
        <div class="container py-5">
            <div class="row">
                <!-- Título y descripción -->
                <div class="col-lg-3" data-aos="fade-up" data-aos-duration="1200">
                    <h6 class="text-uppercase text-primary">Servicios</h6>
                    <h1 class="mb-4">Lo que ofrecemos</h1>
                    <p>Te ayudamos a preservar los recuerdos más valiosos de tus seres queridos en un espacio único, interactivo y accesible. Conoce nuestras funciones.</p>
                </div>

                <!-- Carrusel de servicios -->
                <div class="col-lg-9 pt-5 pt-lg-0">
                    <div class="owl-carousel service-carousel position-relative">
                        <!-- Servicio: Perfil del Ser Querido -->
                        <div class="d-flex flex-column align-items-center text-center bg-white rounded p-4 shadow-sm" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="icon-box bg-secondary text-primary d-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-2x fa-user"></i>
                            </div>
                            <h5 class="mb-3">Perfil del Ser Querido</h5>
                            <p>Incluye la fecha de nacimiento y fallecimiento, biografía, imágenes y más.</p>
                        </div>

                        <!-- Servicio: Video Conmemorativo -->
                        <div class="d-flex flex-column align-items-center text-center bg-white rounded p-4 shadow-sm" data-aos="fade-right" data-aos-duration="1100">
                            <div class="icon-box bg-secondary text-primary d-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <h5 class="mb-3">Video Conmemorativo</h5>
                            <p>Agrega un video conmemorativo desde YouTube para recordar momentos especiales.</p>
                        </div>

                        <!-- Servicio: Ubicación en Google Maps -->
                        <div class="d-flex flex-column align-items-center text-center bg-white rounded p-4 shadow-sm" data-aos="fade-left" data-aos-duration="1100">
                            <div class="icon-box bg-secondary text-primary d-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-2x fa-map-marker-alt"></i>
                            </div>
                            <h5 class="mb-3">Ubicación en Google Maps</h5>
                            <p>Incluye la ubicación del cementerio para facilitar visitas y homenajes.</p>
                        </div>

                        <!-- Servicio: Canción Favorita -->
                        <div class="d-flex flex-column align-items-center text-center bg-white rounded p-4 shadow-sm" data-aos="flip-up" data-aos-duration="1000">
                            <div class="icon-box bg-secondary text-primary d-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-2x fa-music"></i>
                            </div>
                            <h5 class="mb-3">Canción Favorita</h5>
                            <p>Reproduce la canción favorita del ser querido como fondo en su página.</p>
                        </div>

                        <!-- Servicio: Galería de Fotos -->
                        <div class="d-flex flex-column align-items-center text-center bg-white rounded p-4 shadow-sm" data-aos="flip-left" data-aos-duration="900">
                            <div class="icon-box bg-secondary text-primary d-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-2x fa-camera"></i>
                            </div>
                            <h5 class="mb-3">Galería de Fotos</h5>
                            <p>Sube fotos que inmortalicen momentos importantes y recuerdos especiales.</p>
                        </div>

                        <!-- Servicio: Momentos y Hobbies -->
                        <div class="d-flex flex-column align-items-center text-center bg-white rounded p-4 shadow-sm" data-aos="zoom-out" data-aos-duration="1200">
                            <div class="icon-box bg-secondary text-primary d-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-2x fa-heart"></i>
                            </div>
                            <h5 class="mb-3">Momentos y Hobbies</h5>
                            <p>Registra sus hobbies, logros y momentos destacados de su vida.</p>
                        </div>

                        <!-- Servicio: Condolencias -->
                        <div class="d-flex flex-column align-items-center text-center bg-white rounded p-4 shadow-sm" data-aos="fade-up" data-aos-duration="1300">
                            <div class="icon-box bg-secondary text-primary d-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-2x fa-comment"></i>
                            </div>
                            <h5 class="mb-3">Condolencias</h5>
                            <p>Un espacio donde amigos y familiares pueden dejar mensajes de cariño.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Nuestros Servicios -->



    <!-- Memoriales de Ejemplo -->
    <div class="container py-5" id="memoriales">
        <!-- Encabezado -->
        <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="1000">
            <h6 class="text-uppercase text-primary">Explorar</h6>
            <h1 class="mb-4">Nuestros Memoriales</h1>
            <p>Descubre y honra la vida de nuestros seres queridos a través de sus memoriales interactivos. Cada página cuenta una historia única.</p>
        </div>
        <!-- Tarjetas de Memoriales -->
        <div class="row">
            <!-- Plan Básico -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1000">
                <div class="card shadow-sm border-light">
                    <img src="profile/assets/img/logo/logo_circular.png" class="card-img-top rounded-circle mx-auto d-block mt-4" alt="Plan Básico" style="width: 120px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plan Básico</h5>
                        <p class="card-text">Un plan ideal para quienes buscan un memorial sencillo pero completo.</p>
                        <p><strong>Desde S/ 150.00</strong></p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Plan Standard -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="card shadow-sm border-light">
                    <img src="profile/assets/img/logo/logo_circular.png" class="card-img-top rounded-circle mx-auto d-block mt-4" alt="Plan Standard" style="width: 120px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plan Standard</h5>
                        <p class="card-text">Un plan intermedio con características adicionales para un memorial más completo.</p>
                        <p><strong>Desde S/ 199.00</strong></p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Plan Premium -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-left" data-aos-duration="1000">
                <div class="card shadow-sm border-light">
                    <img src="profile/assets/img/logo/logo_circular.png" class="card-img-top rounded-circle mx-auto d-block mt-4" alt="Plan Premium" style="width: 120px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plan Premium</h5>
                        <p class="card-text">El plan más completo para un memorial único, con todas las características adicionales.</p>
                        <p><strong>Desde S/ 299.00</strong></p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Memoriales de Ejemplo -->


    <!-- Como Funciona -->
    <div class="container py-5">
        <!-- Encabezado -->
        <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="1000">
            <h6 class="text-uppercase text-primary">¿Cómo Funciona?</h6>
            <h1 class="mb-4">El Proceso Paso a Paso</h1>
            <p>Te mostramos cómo crear y personalizar un memorial para honrar a tus seres queridos, todo en simples pasos.</p>
        </div>

        <!-- Pasos del Proceso -->
        <div class="row text-center mb-4">
            <!-- Paso 1 -->
            <div class="col-md-4" data-aos="fade-right" data-aos-duration="1000">
                <div class="icon mb-3">
                    <i class="fas fa-book-open fa-3x text-primary"></i>
                </div>
                <h4>Creación del Memorial</h4>
                <p>Comienza creando un memorial único con detalles personales, fotos, y más.</p>
            </div>

            <!-- Paso 2 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="icon mb-3">
                    <i class="fas fa-qrcode fa-3x text-primary"></i>
                </div>
                <h4>Generación del Código QR</h4>
                <p>Generamos un código QR que enlaza al memorial interactivo.</p>
            </div>

            <!-- Paso 3 -->
            <div class="col-md-4" data-aos="fade-left" data-aos-duration="1000">
                <div class="icon mb-3">
                    <i class="fas fa-cogs fa-3x text-primary"></i>
                </div>
                <h4>Envío de la Placa QR y Accesorios</h4>
                <p>El código QR es enviado al destinatario para la instalación en la lápida.</p>
            </div>
        </div>

        <!-- Ejemplo Visual -->
        <div class="text-center mt-5" data-aos="zoom-in" data-aos-duration="1000">
            <h4>Ejemplo Visual</h4>
            <p>Así es cómo se ve un memorial interactivo con el código QR y la página de recuerdos.</p>
            <img src="profile/assets/img/logo/logo_circular.png" width="250px" class="img-fluid shadow rounded-circle" alt="Ejemplo visual">
        </div>
    </div>
    <!-- Como Funciona -->


    <!-- Nuestro Planes -->
    <div id="planes" class="cards-2" style="background-color: #f4f4f4;">
        <div class="container-fluid py-5">
            <!-- Encabezado -->
            <div class="row text-center mb-5" data-aos="fade-down" data-aos-duration="1000">
                <div class="col-lg-12">
                    <h6 class="text-uppercase text-primary">Conoce Nuestros Planes</h6>
                    <h2 class="mb-4">Planes de Precios</h2>
                    <p class="mb-4">
                        Hemos creado planes accesibles que se adaptan a diferentes necesidades y presupuestos. Cada uno está diseñado para ofrecer una experiencia única y personalizada, rindiendo un homenaje especial a tus seres queridos.
                    </p>
                </div>
            </div>

            <!-- Cards de Precios -->
            <div class="row">
                <!-- Plan Básico -->
                <div class="col-lg-4 mb-4" data-aos="fade-right" data-aos-duration="1000">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <h4 class="card-title text-center text-primary">PLAN BÁSICO</h4>
                            <p class="card-subtitle text-center text-muted">Ideal para comenzar</p>
                            <hr />
                            <div class="text-center price">
                                <span class="currency">S/</span><span class="value">150.00</span>
                            </div>
                            <hr />
                            <ul class="list-unstyled li-space-lg">
                                <li><i class="fas fa-check text-success"></i> Placa QR</li>
                                <li><i class="fas fa-check text-success"></i> Biografía</li>
                                <li><i class="fas fa-check text-success"></i> 10 Fotos</li>
                                <li><i class="fas fa-check text-success"></i> 1 Video Personalizado (2 minutos)</li>
                                <li><i class="fas fa-check text-success"></i> Sección de Condolencia</li>
                                <li><i class="fas fa-check text-success"></i> Ubicación del Cementerio</li>
                            </ul>
                            <div class="text-center mt-4">
                                <a class="btn btn-primary btn-block" href="#registrar">Solicitar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Plan Standard -->
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <h4 class="card-title text-center text-primary">PLAN STANDARD</h4>
                            <p class="card-subtitle text-center text-muted">Excelente para necesidades intermedias</p>
                            <hr />
                            <div class="text-center price">
                                <span class="currency">S/</span><span class="value">199.00</span>
                            </div>
                            <hr />
                            <ul class="list-unstyled li-space-lg">
                                <li><i class="fas fa-check text-success"></i> Placa QR</li>
                                <li><i class="fas fa-check text-success"></i> Biografía</li>
                                <li><i class="fas fa-check text-success"></i> 15 Fotos</li>
                                <li><i class="fas fa-check text-success"></i> Canción Favorita</li>
                                <li><i class="fas fa-check text-success"></i> 1 Collar o Llavero QR</li>
                                <li><i class="fas fa-check text-success"></i> 1 Video Personalizado (5 minutos)</li>
                                <li><i class="fas fa-check text-success"></i> Sección de Condolencia</li>
                                <li><i class="fas fa-check text-success"></i> Ubicación del Cementerio</li>
                            </ul>
                            <div class="text-center mt-4">
                                <a class="btn btn-primary btn-block" href="#registrar">Solicitar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Plan Premium -->
                <div class="col-lg-4 mb-4" data-aos="fade-left" data-aos-duration="1000">
                    <div class="card shadow border-0">
                        <div class="label text-center">
                            <p class="best-value text-light bg-primary px-2 py-1 rounded">Mejor Valor</p>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-center text-primary">PLAN PREMIUM</h4>
                            <p class="card-subtitle text-center text-muted">Para quienes desean lo mejor</p>
                            <hr />
                            <div class="text-center price">
                                <span class="currency">S/</span><span class="value">299.00</span>
                            </div>
                            <hr />
                            <ul class="list-unstyled li-space-lg">
                                <li><i class="fas fa-check text-success"></i> Placa QR</li>
                                <li><i class="fas fa-check text-success"></i> Biografía</li>
                                <li><i class="fas fa-check text-success"></i> 20 Fotos</li>
                                <li><i class="fas fa-check text-success"></i> Imagen Familiar de Portada</li>
                                <li><i class="fas fa-check text-success"></i> Canción Favorita</li>
                                <li><i class="fas fa-check text-success"></i> 2 Collares o Llaveros QR</li>
                                <li><i class="fas fa-check text-success"></i> 1 Video Personalizado (10 minutos)</li>
                                <li><i class="fas fa-check text-success"></i> Sección de Condolencia</li>
                                <li><i class="fas fa-check text-success"></i> Ubicación del Cementerio</li>
                            </ul>
                            <div class="text-center mt-4">
                                <a class="btn btn-primary btn-block" href="#registrar">Solicitar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de Row -->
        </div>
    </div>
    <!-- Fin de Nuestro Planes -->


    <!-- Appointment Start -->
    <div class="container-fluid py-5" id="registrar">
        <div class="container py-5">
            <div class="bg-appointment rounded">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-lg-6 py-5">
                        <div class="rounded p-5 my-5" style="background: rgba(55, 55, 63, .7);">
                            <h1 class="text-center text-white mb-4">Llena el siguiente formulario para registrar tu información</h1>

                            <div class="form-group">
                                <input type="number" class="form-control border-0 p-4" placeholder="Numero de Documento de Identidad" id="txt_documento" required="required" onkeypress="return soloNumeros(event)" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control border-0 p-4" placeholder="Nombre Completo" id="txt_nombre" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control border-0 p-4" placeholder="Numero de Celular" id="txt_celular" required="required" />
                            </div>

                            <div class="form-group">
                                <select class="custom-select border-0 px-4" id="select_departamento" onchange="Cargar_Select_Provincia()" style="height: 47px;">

                                </select>
                            </div>

                            <div class="form-group">
                                <select class="custom-select border-0 px-4" id="select_provincia" onchange="Cargar_Select_Distrito()" style="height: 47px;">

                                </select>
                            </div>

                            <div class="form-group">
                                <select class="custom-select border-0 px-4" id="select_distrito" style="height: 47px;">

                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" onclick=" Registrar_Cliente();" type="submit">Registrar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

    <!-- Action Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="bg-action rounded" style="height: 500px; background: linear-gradient(to right, #3a6186, #89253e);">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-lg-7 text-center">
                        <h1 class="text-white mb-4">Preserva los recuerdos más preciados</h1>
                        <p class="text-white mb-4">Crea un homenaje único para tus seres queridos con páginas conmemorativas personalizadas.</p>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="#">Comienza ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action End -->

    <!-- Preguntas Frecuentes -->
    <div class="container-fluid py-5" id="preguntas">
        <div class="container py-5">
            <h2 class="text-center text-primary mb-4">Preguntas Frecuentes</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="accordion" id="faqAccordion">
                        <!-- Pregunta 1 (Abierta al inicio) -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        ¿Cómo se genera el código QR?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                <div class="card-body">
                                    El código QR se genera automáticamente al crear el memorial. Este código es único y vincula la información del memorial a una página personalizada que puede ser escaneada en cualquier momento.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 2 -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        ¿Puedo incluir fotos y recuerdos adicionales?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Sí, en todos nuestros planes puedes incluir una cantidad específica de fotos de acuerdo al plan seleccionado.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 3 -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        ¿Qué pasa si pierdo el QR?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Si pierdes el QR, puedes contactarnos para obtener una nueva copia del código. También podrás acceder al memorial mediante el nombre o la referencia única del memorial.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 4 -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        ¿Puedo actualizar los registros después?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Sí, puedes actualizar los registros y agregar nueva información en cualquier momento. Solo necesitas contactarnos para realizar las modificaciones.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="accordion" id="faqAccordion2">
                        <!-- Pregunta 5 -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingFive">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        ¿Cuánto tiempo permanecerá activo el memorial?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion2">
                                <div class="card-body">
                                    El memorial se mantendrá activo de manera anual. Durante este período, la información será accesible a través del código QR o el enlace correspondiente. Si se desea renovar el servicio para el siguiente año, será necesario realizar el pago anual según el plan seleccionado.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 6 -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingSix">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        ¿Es posible incluir un video personalizado en el memorial?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#faqAccordion2">
                                <div class="card-body">
                                    Sí, todos nuestros planes incluyen la opción de agregar un video personalizado, el cual se sube de manera privada a YouTube y se puede acceder a través del memorial. La duración del video varía según el plan seleccionado, con un límite de minutos establecido en cada opción.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 7 -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingSeven">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        ¿Puedo elegir la música que se reproduce en el memorial?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#faqAccordion2">
                                <div class="card-body">
                                    Sí, en todos nuestros planes, incluido el plan Básico, se incluye una música de fondo por defecto. Sin embargo, en los planes Standard y Premium, tienes la opción de añadir la canción favorita del difunto, la cual se reproducirá en el memorial como homenaje.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 8 -->
                        <div class="card mb-3">
                            <div class="card-header" id="headingEight">
                                <h5 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        ¿Cómo se realizará el envío de la placa QR y otros accesorios al cliente?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#faqAccordion2">
                                <div class="card-body">
                                    El envío de la placa QR y otros accesorios seleccionados se realizará al lugar designado por el cliente. Además, se le proporcionará un enlace (URL) para que pueda visualizar la página de forma inmediata.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Preguntas Frecuentes -->

    <!-- Comentario -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-12">
                    <h2 class="text-center mb-4">¡Queremos saber tu opinión!</h2>
                    <p class="text-center mb-4">Déjanos un comentario sobre qué te ha parecido nuestra página y servicio. ¡Tu opinión es muy importante para nosotros!</p>

                    <div class="form-group">
                        <label for="nombre">Tu Nombre</label>
                        <input type="text" class="form-control" id="name" name="nombre" required placeholder="Escribe tu nombre">
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Tu Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Escribe tu mensaje"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3" onclick="RegistrarTestimonio();">Enviar Mensaje</button>

                </div>
            </div>

            <!-- Sección de Testimonios -->
            <div class="text-center pb-5">
                <h6 class="text-uppercase">Testimonios</h6>
                <h1 class="mb-5">¿ Qué dicen nuestros Clientes ?</h1>
            </div>
            <div class="owl-carousel testimonial-carousel" data-wow-delay="0.1s">
                <?php
                // Consulta para obtener los testimonios
                $sql_testimonio = "SELECT nombre, comentario, fechates FROM testimonio";
                $stmt_testimonio = $conn->prepare($sql_testimonio);

                // Verificar si la preparación fue exitosa
                if ($stmt_testimonio === false) {
                    die('Error en la preparación de la consulta: ' . $conn->error);
                }

                $stmt_testimonio->execute();
                $result_testimonio = $stmt_testimonio->get_result();

                // Verificar si hay testimonios
                if ($result_testimonio->num_rows > 0) {
                    // Recorrer todos los testimonios
                    while ($testimonio = $result_testimonio->fetch_assoc()) {
                ?>
                        <div class="testimonial-item">
                            <div class="testimonial-text position-relative bg-secondary text-light rounded p-5 mb-4">
                                <?php echo htmlspecialchars($testimonio['comentario']); ?>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <img class="img-fluid rounded-circle" src="profile/assets/img/logo/logo_circular.png" style="width: 80px; height: 80px;" alt="client image">
                                <div class="pl-4">
                                    <h5><?php echo htmlspecialchars($testimonio['nombre']); ?></h5>
                                    <p class="m-0"><?php echo htmlspecialchars($testimonio['fechates']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="testimonial-item">
                        <div class="testimonial-text position-relative bg-secondary text-light rounded p-5 mb-4">
                            No se encontraron testimonios. ¡Sé el primero en compartir tu experiencia!
                        </div>
                        <div class="d-flex align-items-center pt-3">
                            <img class="img-fluid rounded-circle" src="profile/assets/img/logo/logo_circular.png" style="width: 80px; height: 80px;" alt="client image">
                            <div class="pl-4">
                                <h5>Sin testimonios</h5>
                                <p class="m-0"></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                // Cerrar la conexión
                $stmt_testimonio->close();
                ?>
            </div>
        </div>
    </div>







    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white pt-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-4">
                <div class="d-flex justify-content-center align-items-center p-4" style="background: rgba(255, 255, 255, 0.05);">
                    <i class="fa fa-2x fa-envelope-open text-primary"></i>
                    <div class="ml-3">
                        <h5 class="text-white text-center">Email</h5>
                        <p class="m-0 text-center">contacto@vivierenmemoria.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-center align-items-center p-4" style="background: rgba(255, 255, 255, 0.05);">
                    <i class="fa fa-2x fa-phone-alt text-primary"></i>
                    <div class="ml-3">
                        <h5 class="text-white text-center">Celular</h5>
                        <p class="m-0 text-center">999 999 999</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-lg-5 col-md-6 mb-5">
                <a href="index.html" class="navbar-brand">
                    <h1 class="m-0 mt-n2 display-4 text-primary text-uppercase">Vivir en Memoria</h1>
                </a>
                <p>Cada recuerdo es una historia, y queremos ayudarte a contar la tuya de la manera más significativa.</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-primary mb-4">Enlaces Rápidos</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                    <a class="text-white mb-2" href="#nosotros"><i class="fa fa-angle-right mr-2"></i>Sobre Nosotros</a>
                    <a class="text-white mb-2" href="#servicios"><i class="fa fa-angle-right mr-2"></i>Servicios</a>
                    <a class="text-white mb-2" href="#memoriales"><i class="fa fa-angle-right mr-2"></i>Memoriales</a>
                    <a class="text-white" href="#planes"><i class="fa fa-angle-right mr-2"></i>Planes</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-primary mb-4">Preguntas y Políticas</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="#preguntas"><i class="fa fa-angle-right mr-2"></i>FAQs</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Términos</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Privacidad</a>
                </div>
            </div>
        </div>
        <div class="row p-4 mt-5 mx-0" style="background: rgba(256, 256, 256, .05);">
            <div class="col-md-12 text-center text-md-center mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a class="font-weight-bold" href="index.php">Vivir en Memoria</a>. Todos los Derechos reservados.</p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary px-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Agregar SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JavaScript Libraries -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script src="adm/js/registrar.js?rev=<?php echo time(); ?>"></script>
    <script src="adm/js/comentarios.js?rev=<?php echo time(); ?>"></script>

    <script>
        AOS.init({
            duration: 1200, // Duración de la animación en milisegundos
            once: true, // Ejecutar la animación solo una vez al entrar
        });
    </script>

    <script>
        Cargar_Select_Departamento();
        Cargar_Select_Provincia();
        Cargar_Select_Distrito();

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
    </script>
</body>

</html>