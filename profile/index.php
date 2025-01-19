<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pruedif';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el id desde la URL y validarlo
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo "<h1>Error: ID inválido</h1>";
    exit;
}

// Consulta para obtener los datos del difunto
$sql_difunto = "SELECT * FROM difuntos WHERE id_difunto = ?";
$stmt_difunto = $conn->prepare($sql_difunto);
$stmt_difunto->bind_param("i", $id);
$stmt_difunto->execute();
$result_difunto = $stmt_difunto->get_result();

// Verificar si se encontró un registro del difunto
if ($result_difunto->num_rows > 0) {
    $difunto = $result_difunto->fetch_assoc();
    
    // Convertir las fechas a objetos DateTime
    $fechaNacimiento = DateTime::createFromFormat('Y-m-d', $difunto['fecha_nacimiento']);
    $fechaFallecimiento = DateTime::createFromFormat('Y-m-d', $difunto['fecha_fallecimiento']);

        // Convertir las fechas solo para que nos devuelva el año
    $fechaNacimientoAño = DateTime::createFromFormat('Y-m-d', $difunto['fecha_nacimiento'])->format('Y');
    $fechaFallecimientoAño = DateTime::createFromFormat('Y-m-d', $difunto['fecha_fallecimiento'])->format('Y');
    
    
    // Mostrar las fechas en el formato "día-mes-año"
    $fechaNacimientoFormateada = $fechaNacimiento->format('d-m-Y');
    $fechaFallecimientoFormateada = $fechaFallecimiento->format('d-m-Y');
    


    // Consulta para obtener los comentarios del difunto
    $sql_comentarios = "SELECT * FROM comentarios WHERE id_difunto = ?";
    $stmt_comentarios = $conn->prepare($sql_comentarios);
    $stmt_comentarios->bind_param("i", $id);
    $stmt_comentarios->execute();
    $result_comentarios = $stmt_comentarios->get_result();

    // Verificar si se encontraron comentarios
    if ($result_comentarios->num_rows > 0) {
        $comentarios = [];
        while ($comentario = $result_comentarios->fetch_assoc()) {
            $comentarios[] = $comentario;
        }
        // Aquí puedes trabajar con los comentarios
    } else {
        echo "<h1>No hay comentarios para este difunto</h1>";
    }

    $stmt_comentarios->close();

    // Consulta para obtener las fotos del difunto
    $sql_foto = "SELECT * FROM fotosdifunto WHERE id_difunto = ?";
    $stmt_foto = $conn->prepare($sql_foto);
    $stmt_foto->bind_param("i", $id);
    $stmt_foto->execute();
    $result_foto = $stmt_foto->get_result();

    // Verificar si se encontró una foto del difunto
    if ($result_foto->num_rows > 0) {
        $foto = $result_foto->fetch_assoc();
        // Aquí puedes trabajar con los datos de la foto
    } else {
        echo "<h1>No hay fotos para este difunto</h1>";
    }

    $stmt_foto->close();

} else {
    echo "<h1>No existe difunto con este ID</h1>";
}

$stmt_difunto->close();

// Cerrar la conexión
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Vivir en Memoria</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />


  </head>

  <body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
      <div
        class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between"
      >
        <a href="index.html" class="logo d-flex align-items-center">
  
          <h1 class="sitename">Vivir en Memoria</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li>
              <a href="#home" class="active">Inicio<br /></a>
            </li>
            <li><a href="#biografia">Biografia</a></li>
            <li><a href="#galeria">Galería</a></li>
            <li><a href="#video">Video</a></li>
            <li><a href="#Condolencias">Condolencias</a></li>
            <li><a href="#ubicacion">Ubicacion</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </header>

    <main class="main">
      <!-- Hero Section -->
      <section id="home" class="hero section dark-background">
        <img src="../adm/<?php echo ($difunto['imagen_perfil']); ?>" class="img-fluid" alt="" />

        <div class="container d-flex flex-column align-items-center justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
          <h2><?php echo ($difunto['nombre'])?></h2>
          <h6>ETERNAMENTE EN NUESTROS CORAZONES</h6>
          <p>
            <span class="typed" data-typed-items="Fecha de Nacimiento: <?php echo $fechaNacimientoFormateada ?>, Fecha de Fallecimiento: <?php echo $fechaFallecimientoFormateada ?>"></span>
          </p>
        </div>
      </section>
      <!-- /Hero Section -->

      <!-- About Section -->
<!-- About Section -->
<section id="biografia" class="about section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      <!-- Left Column -->
      <div class="col-md-6">
        <div class="row justify-content-between gy-4">
          <div class="col-lg-12">
            <img src="../adm/<?php echo ($difunto['imagen_perfil'])?>" class="img-fluid" alt="" />
          </div>
        </div>
        <div class="skills-content skills-animation" style="text-align: center">
          <h5><?php echo ($difunto['nombre'])?> (<?php echo $fechaNacimientoAño ?> - <?php echo $fechaFallecimientoAño ?>)</h5>
        </div>
      </div>
      <!-- End Left Column -->

      <!-- Right Column -->
      <div class="col-md-6">
        <div class="about-me">
          <h4>Biografía</h4>
          <p style="text-align: justify">
            <?php echo ($difunto['biografia']) ?>
          </p>
        </div>
      </div>
      <!-- End Right Column -->
    </div>
  </div>
</section>
<!-- End About Section -->
<style>
        .portfolio-item img {
            width: 100%; /* Asegura que las imágenes ocupen todo el espacio disponible */
            height: 300px; /* Ajusta la altura de todas las imágenes al mismo tamaño */
            object-fit: cover; /* Mantiene la proporción de la imagen y la recorta si es necesario */
        }
    </style>
<!-- Portfolio Section -->
<section id="galeria" class="portfolio section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Galería</h2>
  </div>
  <!-- End Section Title -->

  <div class="container">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      <!-- Portfolio Filters -->
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        <?php
        // Verificar si se encontraron fotos del difunto
        if ($result_foto->num_rows > 0) {
            while ($foto = $result_foto->fetch_assoc()) {
                // Mostrar cada foto en un ítem de la galería
                ?>
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                  <img src="../adm/<?php echo ($foto['ruta_foto']); ?>" class="img-fluid" alt="" />
                  <div class="portfolio-info">
                    <a href="../adm/<?php echo ($foto['ruta_foto']); ?>" title="" data-gallery="portfolio-gallery-app" class="glightbox preview-link">
                      <i class="bi bi-zoom-in"></i>
                    </a>
                  </div>
                </div>
                <?php
            }
        } else {
            echo "<h1>No hay fotos para este difunto</h1>";
        }
        ?>
      </div>
    </div>
  </div>
</section>

<!-- End Portfolio Section -->

      <!-- /Portfolio Section -->

      <!-- Video Section -->
      <section id="video" class="col-12">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Video Conmemorativo</h2>
        </div>
        <div class="video-container">
          <iframe
            src="https://www.youtube.com/embed/VRxF8H-x_J0"
            frameborder="0"
            allowfullscreen
          >
          </iframe>
        </div>
      </section>

      <style>
        .video-container {
          display: flex;
          justify-content: center;
          align-items: center;
          margin-top: 20px;
        }

        .video-container iframe {
          width: 740px; /* Ancho del video */
          height: 460px; /* Alto del video */
          max-width: 100%;
          border: none; /* Sin bordes adicionales */
        }

        .section-title h2 {
          text-align: center;
          margin-bottom: 20px;
        }
      </style>
      <!-- /Video Section -->

      <!-- Contact Section -->
      <section id="Condolencias" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Te invitamos a enviar tu condolencia</h2>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <form
            action="forms/contact.php"
            method="post"
            class="php-email-form"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <div class="row gy-4">
              <div class="col-md-6">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  placeholder="Nombre Completo"
                  required=""
                />
              </div>

              <div class="col-md-6">
                <input
                  type="tel"
                  class="form-control"
                  name="telefono"
                  placeholder="Telefono"
                  required=""
                />
              </div>

              <div class="col-md-12">
                <textarea
                  class="form-control"
                  name="message"
                  rows="6"
                  placeholder="Escribe tu Condolencia"
                  required=""
                ></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">
                  Tu mensaje ha sido enviado. ¡Gracias!
                </div>

                <button type="submit">Enviar Condolencia</button>
              </div>
            </div>
          </form>
          <!-- End Contact Form -->
        </div>
      </section>
      <!-- /Contact Section -->

      <!-- Testimonials Section -->
   <!-- Testimonials Section -->
<section id="testimonials" class="testimonials section accent-background">
  <img src="assets/img/rosas.jpg" class="testimonials-bg" alt="" />

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          }
        }
      </script>
      <div class="swiper-wrapper">
        <?php if (!empty($comentarios)) : ?>
          <?php foreach ($comentarios as $comentario) : ?>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <h3><?php echo htmlspecialchars($difunto['nombre']); ?></h3>
                <h4>Descanza en Paz</h4>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span><?php echo htmlspecialchars($comentario['mensaje']); ?></span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="swiper-slide">
            <div class="testimonial-item">
              <h3>No hay comentarios</h3>
              <h4>Descanza en</h4>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>No hay comentarios para este difunto.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>


      <!-- /Testimonials Section -->

      <!-- Maps -->
      <section id="ubicacion" class="col-md-12" style="margin: 0; padding: 0">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.596540984521!2d-74.25737182515924!3d-12.933632787378226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x910d824f73e9d7a3%3A0xa541f1f8b6dbbf3f!2sCementerio%20Huanta!5e0!3m2!1ses!2spe!4v1736469555298!5m2!1ses!2spe"
          width="100%"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </section>
    </main>

    <footer id="footer" class="footer accent-background">
      <div class="container">
        <div class="copyright text-center">
          <p>
            © <span>Copyright</span>
            <strong class="px-1 sitename">Vivir en Memoria</strong>
            <span>Todos los Derechos Reservados</span>
          </p>
        </div>
        <div class="social-links d-flex justify-content-center">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-whatsapp"></i></a>
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you've purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
          Diseñado por <a href="https://bootstrapmade.com/">Vivir en Memoria</a>
        </div>
      </div>
    </footer>

    <!-- Scroll Top -->
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/typed.js/typed.umd.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
