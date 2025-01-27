/** LISTAR TESTIMONIO*/
var tbl_testimonio;
function Listar_Testimonio() {
  tbl_testimonio = $("#tabla_testimonio").DataTable({
    responsive: true,
    ordering: true,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/comentarios/controlador_listar_testimonio.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      //{ defaultContent: "" },
      { data: "id_tes" },
      { data: "nombre" },
      { data: "comentario" },
      {
        defaultContent:
          "<center>" +
          "<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_testimonio.on("draw.td", function () {
    var PageInfo = $("#tabla_testimonio").DataTable().page.info();
    tbl_testimonio
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/** LISTAR */
var tbl_condolencia;
function Listar_Condolencia() {
  tbl_condolencia = $("#tabla_condolencia").DataTable({
    responsive: true,
    ordering: true,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/comentarios/controlador_listar_Condolencia.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      //{ defaultContent: "" },
      { data: "id_comentario" },
      { data: "nombre" },
      { data: "nombre_pariente" },
      { data: "numero_celular" },
      { data: "mensaje" },
      { data: "fecha_comentario" },
      {
        defaultContent:
          "<center>" +
          "<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_condolencia.on("draw.td", function () {
    var PageInfo = $("#tabla_condolencia").DataTable().page.info();
    tbl_condolencia
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/** MENSAJE DE ELIMINAR TESTIMONIO*/
$("#tabla_testimonio").on("click", ".eliminar", function () {
  var data = tbl_testimonio.row($(this).parents("tr")).data();
  if (tbl_testimonio.row(this).child.isShown()) {
    var data = tbl_testimonio.row(this).data();
  }

  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Eliminará el Testimonio seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      EliminarTestimonio(data.id_tes);
    }
  });
});

/** ELIMINAR TESTIMONIO */
function EliminarTestimonio(id_tes) {
  $.ajax({
    url: "../controller/comentarios/controlador_eliminar_testimonio.php",
    type: "POST",
    data: {
      id_tes: id_tes,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Testimonio eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_testimonio.ajax.reload();
      });
    } else {
      Swal.fire(
        "Mensaje de Advertencia",
        "Error al eliminar Testimonio",
        "error"
      );
    }
  });
}

/** MENSAJE DE ELIMINAR CONDOLENCIA*/
$("#tabla_condolencia").on("click", ".eliminar", function () {
  var data = tbl_condolencia.row($(this).parents("tr")).data();
  if (tbl_condolencia.row(this).child.isShown()) {
    var data = tbl_condolencia.row(this).data();
  }

  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Eliminará la Condolencia seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      EliminarCondolencia(data.id_comentario);
    }
  });
});

/** ELIMINAR CONDOLENCIA */
function EliminarCondolencia(id_comentario) {
  $.ajax({
    url: "../controller/comentarios/controlador_eliminar_condolencia.php",
    type: "POST",
    data: {
        id_comentario: id_comentario,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Condolencia eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_condolencia.ajax.reload();
      });
    } else {
      Swal.fire(
        "Mensaje de Advertencia",
        "Error al eliminar Condolencia",
        "error"
      );
    }
  });
}

function RegistrarTestimonio() {
  let name = document.getElementById("name").value.trim();
  let message = document.getElementById("message").value.trim();
  let fechaComentario = new Date().toLocaleDateString("es-PE");

  if (name.length === 0 || message.length === 0) {
    Swal.fire({
      title: "Advertencia",
      text: "Debe completar todos los campos",
      icon: "warning",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
    });
    return;
  }

  $.ajax({
    url: "adm/controller/comentarios/controlador_registrar_testimonio.php",
    type: "POST",
    data: { name: name, message: message },
  })
    .done(function (resp) {
      if (resp > 0) {
        Swal.fire({
          title: "Testimonio Registrado",
          text: "Gracias por dejar tu testimonio.",
          icon: "success",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 1000,
        }).then(() => {
          document.getElementById("name").value = "";
          document.getElementById("message").value = "";

          // Agregar nuevo testimonio al carrusel
          const newTestimonio = `
            <div class="testimonial-item">
              <div class="testimonial-text position-relative bg-secondary text-light rounded p-5 mb-4">
                "${message}"
              </div>
              <div class="d-flex align-items-center pt-3">
                <img class="img-fluid rounded-circle" src="profile/assets/img/logo/logo_circular.png" style="width: 80px; height: 80px;" alt="Testimonio de ${name}">
                <div class="pl-4">
                  <h5>${name}</h5>
                  <p class="m-0">${fechaComentario}</p>
                </div>
              </div>
            </div>
          `;

          // Obtener el número de testimonios actuales
          const totalTestimonios = $('.testimonial-carousel .testimonial-item').length;

          // Si hay menos de 4 testimonios, no habilitar el carrusel, solo mostrar estáticos
          if (totalTestimonios < 3) {
            // Agregar el testimonio al carrusel sin moverlo
            $('.testimonial-carousel').append(newTestimonio);
          } else {
            // Si hay 4 o más testimonios, hacer que el carrusel se mueva
            $('.testimonial-carousel').trigger('add.owl.carousel', [$(newTestimonio)]).trigger('refresh.owl.carousel');
          }
        });
      } else {
        Swal.fire({
          title: "Error",
          text: "No se completó el registro del testimonio.",
          icon: "error",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 1000,
        });
      }
    })
    .fail(function () {
      Swal.fire({
        title: "Error de Conexión",
        text: "Hubo un problema al intentar registrar el testimonio. Intente de nuevo.",
        icon: "error",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1000,
      });
    });
}



$(document).ready(function() {
    $(".owl-carousel").owlCarousel({
        loop: true, // Permite que el carrusel se repita
        margin: 10, // Espaciado entre los elementos
        nav: true, // Habilita los botones de siguiente y anterior
        dots: true, // Habilita los puntos de navegación
        autoplay: true, // Habilita el desplazamiento automático
        autoplayTimeout: 5000, // Tiempo entre los desplazamientos (5000ms = 5 segundos)
        autoplayHoverPause: true, // Pausa el autoplay al pasar el ratón por encima
        responsive: {
            0: {
                items: 1 // Una sola imagen por vez en pantallas pequeñas
            },
            600: {
                items: 2 // Dos imágenes por vez en pantallas medianas
            },
            1000: {
                items: 3 // Tres imágenes por vez en pantallas grandes
            }
        }
    });
});
