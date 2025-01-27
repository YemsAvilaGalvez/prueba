<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'prueba_final';

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
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- SEO Meta Tags -->
  <meta
    name="description"
    content="Create a stylish landing page for your business startup and get leads for the offered services with this HTML landing page template." />
  <meta name="author" content="Inovatik" />

  <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
  <meta property="og:site_name" content="" />
  <!-- website name -->
  <meta property="og:site" content="" />
  <!-- website link -->
  <meta property="og:title" content="" />
  <!-- title shown in the actual shared post -->
  <meta property="og:description" content="" />
  <!-- description shown in the actual shared post -->
  <meta property="og:image" content="" />
  <!-- image link, make sure it's jpg -->
  <meta property="og:url" content="" />
  <!-- where do you want your post to link to -->
  <meta property="og:type" content="article" />

  <!-- Website Title -->
  <title>Evolo - StartUp HTML Landing Page Template</title>

  <!-- Styles -->
  <link
    href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext"
    rel="stylesheet" />
  <link href="css/bootstrap.css" rel="stylesheet" />
  <link href="css/fontawesome-all.css" rel="stylesheet" />
  <link href="css/swiper.css" rel="stylesheet" />
  <link href="css/magnific-popup.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

  <!-- Favicon  -->
  <link rel="icon" href="images/favicon.png" />
</head>

<style>
  .no-testimonial-message {
    font-size: 1.2em;
    color: #555;
    text-align: center;
    margin-top: 15px;
  }

  .card-image {
    width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
  }

  /* Estilos para la imagen en caso de no testimonios */
  .card-image {
    max-width: 200px;
    /* Ajusta el tamaño según sea necesario */
    margin: 0 auto;
  }
</style>

<body data-spy="scroll" data-target=".fixed-top">
  <!-- Preloader -->
  <div class="spinner-wrapper">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div>
  <!-- end of preloader -->

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <!-- Text Logo - Use this if you don't have a graphic logo -->
    <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Evolo</a> -->

    <!-- Image Logo -->
    <a href="index.php" class="link-styled"><img src="images/download.svg" width="50px" alt=""> VIVIR EN MEMORIA</a>

<style>
  .link-styled {
    font-family: 'Arial', sans-serif; /* Puedes cambiar la fuente */
    font-weight: bold; /* Hace la fuente en negrita */
    font-size: 28px; /* Tamaño de la fuente */
    color: #222222; /* Color de la letra */
    text-decoration: none; /* Quita el subrayado */
    transition: color 0.3s ease; /* Animación suave para cambio de color */
  }

  .link-styled:hover {
    color: #222222; /* Color cuando se pasa el mouse por encima */
  }
</style>

    <!-- Mobile Menu Toggle Button -->
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-awesome fas fa-bars"></span>
      <span class="navbar-toggler-awesome fas fa-times"></span>
    </button>
    <!-- end of mobile menu toggle button -->

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#header">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#pricing">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#request">Request</a>
        </li>

        <!-- Dropdown Menu -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle page-scroll"
            href="#about"
            id="navbarDropdown"
            role="button"
            aria-haspopup="true"
            aria-expanded="false">About</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">Terms Conditions</span></a>
            <div class="dropdown-items-divide-hr"></div>
            <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">Privacy Policy</span></a>
          </div>
        </li>
        <!-- end of dropdown menu -->

        <li class="nav-item">
          <a class="nav-link page-scroll" href="#contact">Contact</a>
        </li>
      </ul>
      <span class="nav-item social-icons">
        <span class="fa-stack">
          <a href="#your-link">
            <i class="fas fa-circle fa-stack-2x facebook"></i>
            <i class="fab fa-facebook-f fa-stack-1x"></i>
          </a>
        </span>
        <span class="fa-stack">
          <a href="#your-link">
            <i class="fas fa-circle fa-stack-2x twitter"></i>
            <i class="fab fa-twitter fa-stack-1x"></i>
          </a>
        </span>
      </span>
    </div>
  </nav>
  <!-- end of navbar -->
  <!-- end of navigation -->

  <!-- Header -->
  <header id="header" class="header">
    <div class="header-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="text-container">
              <h1>
                <span class="turquoise">BIENVENIDOS</span> VIVIR EN MEMORIA
              </h1>
              <p class="p-large">
                Un espacio para recordar, honrar y compartir el legado de
                quienes siempre vivirán en nuestros corazones.
              </p>
              <a class="btn-solid-lg page-scroll" href="#services">VER NUESTROS SERVICIOS</a>
            </div>
            <!-- end of text-container -->
          </div>
          <!-- end of col -->
          <div class="col-lg-6">
            <div class="image-container">
              <img
                class="img-fluid"
                src="images/header-teamwork.svg"
                alt="alternative" />
            </div>
            <!-- end of image-container -->
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of header-content -->
  </header>
  <!-- end of header -->
  <!-- end of header -->



  <!-- Services -->
  <div id="services" class="cards-1">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Visión y Misión</h2>
          <p class="p-heading p-large">
            En <strong>Vivir en Memoria</strong>, transformamos los recuerdos en homenajes eternos. Creamos páginas web personalizadas en honor a quienes han partido, permitiendo que sus seres queridos celebren y compartan su legado con facilidad y significado.
          </p>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->

      <div class="row">
        <div class="col-lg-12">
          <!-- Card: Misión -->
          <div class="card">
            <img
              class="card-image"
              src="images/mission-icon.svg"
              alt="Misión" />
            <div class="card-body">
              <h4 class="card-title">Misión</h4>
              <p>
                Brindar una experiencia única para honrar y preservar el recuerdo de quienes han partido, conectando emociones y recuerdos a través de tecnología innovadora que permita mantener el amor y la memoria vivos para siempre.
              </p>
            </div>
          </div>
          <!-- end of card -->

          <!-- Card: Visión -->
          <div class="card">
            <img
              class="card-image"
              src="images/vision-icon.svg"
              alt="Visión" />
            <div class="card-body">
              <h4 class="card-title">Visión</h4>
              <p>
                Ser la plataforma líder en la preservación de memorias digitales, proporcionando herramientas accesibles y significativas para que el legado de cada vida perdure en el tiempo y en el corazón de quienes los recuerdan.
              </p>
            </div>
          </div>
          <!-- end of card -->
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>

    <!-- end of container -->
  </div>
  <!-- end of cards-1 -->
  <!-- end of services -->



  <!-- Details 2 -->
  <div class="basic-2">
    <div class="container">
      <div class="row">
        <!-- Imagen actual (no se elimina) -->
        <div class="col-lg-6">
          <div class="image-container">
            <img
              class="img-fluid"
              src="images/details-2-office-team-work.svg"
              alt="alternative" />
          </div>
          <!-- end of image-container -->
        </div>
        <!-- end of col -->

        <!-- Contenido actualizado -->
        <div class="col-lg-6">
          <div class="text-container">
            <h2>Un homenaje eterno a quienes amamos</h2>
            <ul class="list-unstyled li-space-lg">
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  Registra los momentos más importantes de tu ser querido: música favorita, biografía, fotos, videos, y más.
                </div>
              </li>
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  Genera una página conmemorativa única que celebra su vida y legado.
                </div>
              </li>
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  Accede fácilmente al homenaje a través de un código QR colocado en su lápida.
                </div>
              </li>
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  Permite a familiares y amigos compartir mensajes y recuerdos desde cualquier lugar.
                </div>
              </li>
            </ul>
            <a
              class="btn-solid-reg popup-with-move-anim"
              href="#details-lightbox-2">Conoce más</a>
          </div>
          <!-- end of text-container -->
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>

  <!-- end of basic-2 -->
  <!-- end of details 2 -->

  <!-- Details Lightboxes -->
  <!-- Details Lightbox 1 -->
  <div
    id="details-lightbox-1"
    class="lightbox-basic zoom-anim-dialog mfp-hide">
    <div class="container">
      <div class="row">
        <button title="Close (Esc)" type="button" class="mfp-close x-button">
          ×
        </button>
        <div class="col-lg-8">
          <div class="image-container">
            <img
              class="img-fluid"
              src="images/details-lightbox-1.svg"
              alt="alternative" />
          </div>
          <!-- end of image-container -->
        </div>
        <!-- end of col -->
        <div class="col-lg-4">
          <h3>Planes y Precios</h3>
          <hr />
          <h5>Características principales</h5>
          <p>
            Ofrecemos diferentes planes que se adaptan a tus necesidades, desde un homenaje sencillo hasta una página conmemorativa completa con fotos, videos, música y mensajes.
          </p>
          <p>
            ¿Quieres crear un espacio único para recordar y compartir momentos especiales? Con "Vivir en Memoria" lo puedes hacer de manera fácil y accesible.
          </p>

          <ul class="list-unstyled li-space-lg">
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">List building framework</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Easy database browsing</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">User administration</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Automate user signup</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Quick formatting tools</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Fast email checking</div>
            </li>
          </ul>
          <a class="btn-solid-reg mfp-close page-scroll" href="#request">REQUEST</a>
          <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>
  <!-- end of lightbox-basic -->
  <!-- end of details lightbox 1 -->

  <!-- Details Lightbox 2 -->
  <div
    id="details-lightbox-2"
    class="lightbox-basic zoom-anim-dialog mfp-hide">
    <div class="container">
      <div class="row">
        <button title="Close (Esc)" type="button" class="mfp-close x-button">
          ×
        </button>
        <div class="col-lg-8">
          <div class="image-container">
            <img
              class="img-fluid"
              src="images/details-lightbox-2.svg"
              alt="alternative" />
          </div>
          <!-- end of image-container -->
        </div>
        <!-- end of col -->
        <div class="col-lg-4">
          <h3>Search To Optimize</h3>
          <hr />
          <h5>Core feature</h5>
          <p>
            The emailing module basically will speed up your email marketing
            operations while offering more subscriber control.
          </p>
          <p>
            Do you need to build lists for your email campaigns? It just got
            easier with Evolo.
          </p>
          <ul class="list-unstyled li-space-lg">
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">List building framework</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Easy database browsing</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">User administration</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Automate user signup</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Quick formatting tools</div>
            </li>
            <li class="media">
              <i class="fas fa-check"></i>
              <div class="media-body">Fast email checking</div>
            </li>
          </ul>
          <a class="btn-solid-reg mfp-close page-scroll" href="#request">REQUEST</a>
          <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>
  <!-- end of lightbox-basic -->
  <!-- end of details lightbox 2 -->
  <!-- end of details lightboxes -->

  <!-- Pricing -->
  <div id="pricing" class="cards-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Planes de Precios</h2>
          <p class="p-heading p-large">
            Hemos creado planes de precios accesibles que se adaptan a diferentes necesidades y presupuestos. Cada uno de nuestros planes está diseñado para ofrecer una experiencia única y personalizada, permitiéndote rendir un homenaje especial y significativo a tus seres queridos.
          </p>
        </div>


        <!-- end of col -->
      </div>
      <!-- end of row -->
      <div class="row">
        <!-- Card - PLAN BASICO -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">PLAN BASICO</div>
              <div class="card-subtitle">Ideal para comenzar</div>
              <hr class="cell-divide-hr" />
              <div class="price">
                <span class="currency">S/</span><span class="value">150.00</span>
              </div>
              <hr class="cell-divide-hr" />
              <ul class="list-unstyled li-space-lg">
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Placa QR</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Biografía</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">10 Fotos</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">1 Video Personalizado en YouTube (2 minutos)</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Sección de Condolencia</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Ubicación de Cementerio</div>
                </li>
              </ul>
              <div class="button-wrapper">
                <a class="btn-solid-reg page-scroll" href="#request">SOLICITAR</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Card - PLAN STANDARD -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">PLAN STANDARD</div>
              <div class="card-subtitle">Excelente para necesidades intermedias</div>
              <hr class="cell-divide-hr" />
              <div class="price">
                <span class="currency">S/</span><span class="value">199.00</span>
              </div>
              <hr class="cell-divide-hr" />
              <ul class="list-unstyled li-space-lg">
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Placa QR</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Biografía</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">15 Fotos</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Canción Favorita del Difunto</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">1 Collar o Llavero QR</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">1 Video Personalizado en YouTube (5 minutos)</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Sección de Condolencia</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Ubicación de Cementerio</div>
                </li>
              </ul>
              <div class="button-wrapper">
                <a class="btn-solid-reg page-scroll" href="#request">SOLICITAR</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Card - PLAN PREMIUM -->
        <div class="col-lg-4">
          <div class="card">
            <div class="label">
              <p class="best-value">Mejor Valor</p>
            </div>
            <div class="card-body">
              <div class="card-title">PLAN PREMIUM</div>
              <div class="card-subtitle">El paquete completo para quienes desean lo mejor</div>
              <hr class="cell-divide-hr" />
              <div class="price">
                <span class="currency">S/</span><span class="value">299.00</span>
              </div>
              <hr class="cell-divide-hr" />
              <ul class="list-unstyled li-space-lg">
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Placa QR</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Biografía</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">20 Fotos</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Imagen Familiar de Portada</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Canción Favorita del Difunto</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">2 Collares o Llaveros QR</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">1 Video Personalizado en YouTube (10 minutos)</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Sección de Condolencia</div>
                </li>
                <li class="media">
                  <i class="fas fa-check"></i>
                  <div class="media-body">Ubicación de Cementerio</div>
                </li>
              </ul>
              <div class="button-wrapper">
                <a class="btn-solid-reg page-scroll" href="#request">SOLICITAR</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>
  <!-- end of cards-2 -->
  <!-- end of pricing -->

  <!-- Request -->
  <div id="request" class="form-1">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="text-container">
            <h2>Llena el siguiente formulario para registrar tu información</h2>
            <p>
              Después de completar tu registro, nosotros nos encargamos de todo lo demás. Ofrecemos planes personalizados para el recuerdo y tributo a tus seres queridos.
            </p>
            <ul class="list-unstyled li-space-lg">
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  <strong class="blue">Te ayudamos a crear</strong> un tributo único con fotografías y videos personalizados
                </div>
              </li>
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  <strong class="blue">Incluimos placas QR</strong> para que los recuerdos sean accesibles de manera sencilla
                </div>
              </li>
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  <strong class="blue">Ofrecemos productos personalizados</strong> como collares o llaveros con QR
                </div>
              </li>
              <li class="media">
                <i class="fas fa-check"></i>
                <div class="media-body">
                  <strong class="blue">Nos encargamos de todo</strong> después de tu registro, incluyendo la creación de videos y canciones
                </div>
              </li>
            </ul>
          </div>
          <!-- end of text-container -->
        </div>
        <!-- end of col -->
        <div class="col-lg-6">
          <!-- Request Form -->
          <div class="form-container">
            <div class="form-group">
              <input
                type="text"
                class="form-control-input"
                id="txt_documento"
                name="N° Documento de Identidad"
                required
                onkeypress="return soloNumeros(event)" />
              <label class="label-control" for="txt_documento">N° de Documento</label>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <input
                type="text"
                class="form-control-input"
                id="txt_nombre"
                name="Nombre Completo"
                required
                onkeypress="return soloLetras(event)" />
              <label class="label-control" for="txt_nombre">Nombre Completo</label>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <input
                type="text"
                class="form-control-input"
                id="txt_celular"
                name="Celular"
                required
                onkeypress="return soloNumeros(event)" />
              <label class="label-control" for="txt_celular">Celular</label>
              <div class="help-block with-errors"></div>
            </div>


            <div class="form-group">
              <select
                class="form-control-select"
                id="select_departamento"
                required
                onchange="Cargar_Select_Provincia()"></select>
              <div class="help-block with-errors"></div>
            </div>


            <div class="form-group">
              <select
                class="form-control-select"
                id="select_provincia"
                required
                onchange="Cargar_Select_Distrito()"></select>
              <div class="help-block with-errors"></div>
            </div>

            
            <div class="form-group">
              <select
                class="form-control-select"
                id="select_distrito"
                required></select>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group checkbox">
              <input
                type="checkbox"
                id="rterms"
                value="Agreed-to-Terms"
                name="rterms"
                required />Acepto la
              <a href="privacy-policy.html">Política de Privacidad</a> y los
              <a href="terms-conditions.html">Términos y Condiciones</a>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <button type="submit" class="form-control-submit-button" onclick=" Registrar_Cliente();">
                REGISTRAR
              </button>
            </div>
            <div class="form-message">
              <div id="rmsgSubmit" class="h3 text-center hidden"></div>
            </div>
          </div>
          <!-- end of form-container -->
          <!-- end of request form -->
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>

  <!-- end of form-1 -->
  <!-- end of request -->

  <!-- Video -->
  <div class="basic-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Check Out The Video</h2>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
      <div class="row">
        <div class="col-lg-12">
          <!-- Video Preview -->
          <div class="image-container">
            <div class="video-wrapper">
              <a
                class="popup-youtube"
                href="https://www.youtube.com/watch?v=fLCjQJCekTs"
                data-effect="fadeIn">
                <img
                  class="img-fluid"
                  src="images/video-frame.svg"
                  alt="alternative" />
                <span class="video-play-button">
                  <span></span>
                </span>
              </a>
            </div>
            <!-- end of video-wrapper -->
          </div>
          <!-- end of image-container -->
          <!-- end of video preview -->

          <p>
            This video will show you a case study for one of our
            <strong>Major Customers</strong> and will help you understand why
            your startup needs Evolo in this highly competitive market
          </p>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>
  <!-- end of basic-3 -->
  <!-- end of video -->

  <!-- Testimonials -->
  <div class="slider-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <input type="text" class="form-control-input" id="name" required />
            <label class="label-control" for="name">Nombre Completo</label>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <textarea class="form-control-textarea" id="message" required></textarea>
            <label class="label-control" for="message">Tu Testimonio</label>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <button type="submit" class="form-control-submit-button" onclick="RegistrarTestimonio();">
              Enviar Testimonio
            </button>
          </div>
        </div>

        <!-- end of col -->
        <div class="col-lg-6">
          <h2>Testimonials</h2>

          <!-- Card Slider -->
          <div class="slider-container">
            <div class="swiper-container card-slider">
              <div class="swiper-wrapper">
                <?php
                // Ejecutar la consulta
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
                    // Aquí se imprime cada testimonio dentro de un swiper-slide
                ?>
                    <div class="swiper-slide">
                      <div class="card">
                        <img class="card-image" src="profile/assets/img/logo/logo_circular.png" alt="alternative" />
                        <div class="card-body">
                          <!-- Comentario entre comillas -->
                          <p class="testimonial-text">"<?php echo htmlspecialchars($testimonio['comentario']); ?>"</p>

                          <!-- Nombre del autor -->
                          <p class="testimonial-author"><?php echo htmlspecialchars($testimonio['nombre']); ?></p>

                          <!-- Fecha del testimonio -->
                          <p class="testimonial-date"><?php echo htmlspecialchars($testimonio['fechates']); ?></p>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                } else {
                  // Si no se encontraron testimonios, mostrar la imagen y mensaje
                  ?>
                  <div class="swiper-slide">
                    <div class="card">
                      <img class="card-image" src="profile/assets/img/logo/logo_circular.png" />
                      <div class="card-body">
                        <p class="no-testimonial-message">No se encontraron testimonios. ¡Sé el primero en compartir tu experiencia!</p>
                      </div>
                    </div>
                  </div>
                <?php
                }

                // Cerrar la conexión
                $stmt_testimonio->close();
                ?>
              </div>
              <!-- end of swiper-wrapper -->

              <!-- Add Arrows -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
              <!-- end of add arrows -->
            </div>
            <!-- end of swiper-container -->
          </div>



          <!-- end of slider-container -->
          <!-- end of card slider -->
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>
  <!-- end of slider-2 -->
  <!-- end of testimonials -->





  <!-- Footer -->
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="footer-col">
            <h4>About Evolo</h4>
            <p>
              We're passionate about offering some of the best business growth
              services for startups
            </p>
          </div>
        </div>
        <!-- end of col -->
        <div class="col-md-4">
          <div class="footer-col middle">
            <h4>Important Links</h4>
            <ul class="list-unstyled li-space-lg">
              <li class="media">
                <i class="fas fa-square"></i>
                <div class="media-body">
                  Our business partners
                  <a class="turquoise" href="#your-link">startupguide.com</a>
                </div>
              </li>
              <li class="media">
                <i class="fas fa-square"></i>
                <div class="media-body">
                  Read our
                  <a class="turquoise" href="terms-conditions.html">Terms & Conditions</a>,
                  <a class="turquoise" href="privacy-policy.html">Privacy Policy</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- end of col -->
        <div class="col-md-4">
          <div class="footer-col last">
            <h4>Social Media</h4>
            <span class="fa-stack">
              <a href="#your-link">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-facebook-f fa-stack-1x"></i>
              </a>
            </span>
            <span class="fa-stack">
              <a href="#your-link">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-twitter fa-stack-1x"></i>
              </a>
            </span>
            <span class="fa-stack">
              <a href="#your-link">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-google-plus-g fa-stack-1x"></i>
              </a>
            </span>
            <span class="fa-stack">
              <a href="#your-link">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-instagram fa-stack-1x"></i>
              </a>
            </span>
            <span class="fa-stack">
              <a href="#your-link">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-linkedin-in fa-stack-1x"></i>
              </a>
            </span>
          </div>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
    </div>
    <!-- end of container -->
  </div>
  <!-- end of footer -->
  <!-- end of footer -->

  <!-- Copyright -->
  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p class="p-small">
            Copyright © 2020 <a href="https://inovatik.com">Inovatik</a> - All
            rights reserved
          </p>
        </div>
        <!-- end of col -->
      </div>
      <!-- enf of row -->
    </div>
    <!-- end of container -->
  </div>
  <!-- end of copyright -->
  <!-- end of copyright -->

  <!-- Agregar jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Agregar SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <!-- jQuery for Bootstrap's JavaScript plugins -->
  <script src="js/popper.min.js"></script>
  <!-- Popper tooltip library for Bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Bootstrap framework -->
  <script src="js/jquery.easing.min.js"></script>
  <!-- jQuery Easing for smooth scrolling between anchors -->
  <script src="js/swiper.min.js"></script>
  <!-- Swiper for image and text sliders -->
  <script src="js/jquery.magnific-popup.js"></script>
  <!-- Magnific Popup for lightboxes -->
  <script src="js/validator.min.js"></script>
  <!-- Validator.js - Bootstrap plugin that validates forms -->
  <script src="js/scripts.js"></script>
  <!-- Custom scripts -->
  <script src="adm/js/registrar.js?rev=<?php echo time(); ?>"></script>
  <script src="adm/js/comentarios.js?rev=<?php echo time(); ?>"></script>

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