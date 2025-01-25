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
  let name = document.getElementById("name").value;
  let message = document.getElementById("message").value;
  //let fechaComentario = new Date().toLocaleDateString("es-PE"); // Obtener fecha en formato español

  // Verificación básica antes de la solicitud AJAX
  if (name.length == 0 || message.length == 0) {
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
    data: {
      name: name,
      message: message
    },
  })
    .done(function (resp) {
      if (resp > 0) {
        // Si el valor retornado es mayor a 0, se insertó correctamente
        Swal.fire({
          title: "Testimonio Registrado",
          text: "Gracias por dejar tu testimonio.",
          icon: "success",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 5000,
        }).then(() => {
          // Limpiar campos después de éxito
          document.getElementById("name").value = "";
          document.getElementById("message").value = "";

          // Agregar el nuevo comentario al slider
          const newComment = `
                  <div class="swiper-slide">
                      <div class="testimonial-item">
                          <h3>${name}</h3>
                          <h4>${telefono}</h4>  <!-- Mostrar teléfono -->
                          <p>
                              <i class="bi bi-quote quote-icon-left"></i>
                              <span>${message}</span>
                              <i class="bi bi-quote quote-icon-right"></i>
                          </p>
                          <p style="text-align: center; font-size: 0.9rem; margin-top: 10px;">
                              <strong>Fecha del comentario:</strong> ${fechaComentario}
                          </p>
                      </div>
                  </div>
              `;

          // Insertar el nuevo comentario al principio de la lista
          $(".swiper-wrapper").prepend(newComment);

          // Recargar la instancia de Swiper después de agregar el comentario
          var swiper = new Swiper(".swiper.init-swiper", {
            loop: true,
            speed: 600,
            autoplay: { delay: 5000 },
            slidesPerView: "auto",
            pagination: {
              el: ".swiper-pagination",
              type: "bullets",
              clickable: true,
            },
          });

          swiper.update();
        });
      } else {
        Swal.fire({
          title: "Error",
          text: "No se completó el registro del testimonio.",
          icon: "error",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
        });
      }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      Swal.fire({
        title: "Error de Conexión",
        text: "Hubo un problema al intentar registrar el testimonio. Intente de nuevo.",
        icon: "error",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });
    });
}