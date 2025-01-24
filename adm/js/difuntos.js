/** LISTAR */
var tbl_difunto;
function Listar_Difunto() {
  tbl_difunto = $("#tabla_difunto").DataTable({
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
      url: "../controller/difunto/controlador_listar_difunto.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      { defaultContent: "" },
      { data: "id_difunto" },
      { data: "documento_identidad" },
      { data: "nombre" },
      { data: "fecha_nacimiento" },
      { data: "fecha_fallecimiento" },
      {
        data: "imagen_perfil",
        render: function (data) {
          return (
            "<img src='../" +
            data +
            "' class='img-responsive' style='width: 50px; height: 50px; border-radius: 50%;'>"
          );
        },
      },
      { data: "fecha_creacion" },
      { data: "fecha_fin" },
      {
        data: "plan",
        render: function (data, type, row) {
          if (data === "ANUAL") {
            return "<span class='badge badge-success'>" + data + "</span>";
          } else {
            return "<span class='badge badge-warning'>" + data + "</span>";
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data === "HABILITADO") {
            return "<span class='badge badge-success'>" + data + "</span>";
          } else {
            return "<span class='badge badge-danger'>" + data + "</span>";
          }
        },
      },
      {
        defaultContent:
          "<center>" +
          "<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class= 'fa fa-edit'></i></span>&nbsp;<span class='foto text-info px-1' style='cursor:pointer;' title='Cambiar foto'><i class='fa fa-image'></i></span>&nbsp;<span class='portada text-info px-1' style='cursor:pointer;' title='Cambiar Portada'><i class='fa fa-camera'></i></span>&nbsp;<span class='audio text-info px-1' style='cursor:pointer;' title='Cambiar Audio'><i class='fa fa-volume-up'></i></span>&nbsp;<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_difunto.on("draw.td", function () {
    var PageInfo = $("#tabla_difunto").DataTable().page.info();
    tbl_difunto
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/*** ABRIR MODAL */
function AbrirRegistroDifunto() {
  $("#modal_registro_difunto").modal({ backdrop: "static", keyboard: false });
  $("#modal_registro_difunto").modal("show");
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
}

/** ABRIR MODAL EDITAR FOTO */
$("#tabla_difunto").on("click", ".foto", function () {
  var data = tbl_difunto.row($(this).parents("tr")).data();
  if (tbl_difunto.row(this).child.isShown()) {
    var data = tbl_difunto.row(this).data();
  }

  $("#modal_editar_foto").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_foto").modal("show");

  document.getElementById("idDifuntoFoto").value = data.id_difunto;
  document.getElementById("idDifuntoFotoActual").value = data.imagen_perfil;
  document.getElementById("img-preview").src = "../" + data.imagen_perfil;
});

/** ABRIR MODAL EDITAR PORTADA */
$("#tabla_difunto").on("click", ".portada", function () {
  var data = tbl_difunto.row($(this).parents("tr")).data();
  if (tbl_difunto.row(this).child.isShown()) {
    var data = tbl_difunto.row(this).data();
  }

  $("#modal_editar_portada").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_portada").modal("show");

  document.getElementById("idDifuntoPortada").value = data.id_difunto;
  document.getElementById("idDifuntoPortadaActual").value = data.imagen_portada;
  document.getElementById("img-preview-portada").src =
    "../" + data.imagen_portada;
});

/** ABRIR MODAL EDITAR */
$("#tabla_difunto").on("click", ".editar", function () {
  var data = tbl_difunto.row($(this).parents("tr")).data();
  if (tbl_difunto.row(this).child.isShown()) {
    var data = tbl_difunto.row(this).data();
  }

  $("#modal_editar_difunto").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_difunto").modal("show");

  document.getElementById("idDifunto").value = data.id_difunto;
  document.getElementById("txt_nombre_editar").value = data.nombre;
  document.getElementById("date_nacimiento_editar").value =
    data.fecha_nacimiento;
  document.getElementById("date_fallecimiento_editar").value =
    data.fecha_fallecimiento;
  document.getElementById("txt_biografia_editar").value = data.biografia;
  document.getElementById("txt_video_editar").value = data.video_link;
  document.getElementById("txt_ubicacion_editar").value = data.ubicacion_link;
  $("#select_documento_cliente_editar")
    .select2()
    .val(data.id_cliente)
    .trigger("change.select2");
  $("#select_plan_editar").select2().val(data.plan).trigger("change.select2");
  $("#select_estado_editar")
    .select2()
    .val(data.estado)
    .trigger("change.select2");
});

/** CARGAR CLIENTES */
function Cargar_Select_Cliente() {
  $.ajax({
    url: "../controller/difunto/controlador_cargar_cliente.php",
    type: "POST",
  }).done(function (resp) {
    let data = JSON.parse(resp);
    let llenardata = "<option value=''>Seleccione</option>";
    if (data.length > 0) {
      for (let i = 0; i < data.length; i++) {
        llenardata +=
          "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
      }
      document.getElementById("select_documento_cliente").innerHTML =
        llenardata;
      document.getElementById("select_documento_cliente_editar").innerHTML =
        llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_documento_cliente").innerHTML =
        llenardata;
      document.getElementById("select_documento_cliente_editar").innerHTML =
        llenardata;
    }
  });
}

/** REGISTRAR DIFUNTO */
function Registrar_Difunto() {
  let documentoCliente = document.getElementById(
    "select_documento_cliente"
  ).value;
  let nombre = document.getElementById("txt_nombre").value;
  let fechaNacimiento = document.getElementById("date_nacimiento").value;
  let fechaFallecimiento = document.getElementById("date_fallecimiento").value;
  let biografia = document.getElementById("txt_biografia").value;
  let foto = document.getElementById("file_foto").value;
  let portada = document.getElementById("file_foto_portada").value;
  let videoLink = document.getElementById("txt_video").value;
  let ubicacionLink = document.getElementById("txt_ubicacion").value;
  let audio = document.getElementById("txt_cancion").value;
  let plan = document.getElementById("select_plan").value;

  if (documentoCliente.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione un cliente",
      "warning"
    );
  }
  if (plan.length == 0) {
    return Swal.fire("Mensaje de Advertencia", "Seleccione un plan", "warning");
  }
  if (
    nombre.length == 0 ||
    fechaNacimiento.length == 0 ||
    fechaFallecimiento.length == 0 ||
    biografia.length == 0 ||
    videoLink.length == 0 ||
    ubicacionLink.length == 0
  ) {
    ValidarCamposDifunto(
      "txt_nombre",
      "date_nacimiento",
      "date_fallecimiento",
      "txt_biografia",
      "txt_video",
      "txt_ubicacion"
    );
    return Swal.fire(
      "Mensaje de Advertencia",
      "Complete los campos",
      "warning"
    );
  }

  let formattedFechaNacimiento = new Date(fechaNacimiento)
    .toISOString()
    .split("T")[0];
  let formattedFechaFallecimiento = new Date(fechaFallecimiento)
    .toISOString()
    .split("T")[0];

  // Calcular fecha_fin dependiendo del plan usando la fecha de registro (fecha actual)
  let fechaRegistro = new Date(); // Fecha actual
  let fechaFin = new Date(fechaRegistro); // Copiar fecha actual
  if (plan === "ANUAL") {
    fechaFin.setFullYear(fechaFin.getFullYear() + 1);
  } else if (plan === "SEMESTRAL") {
    fechaFin.setMonth(fechaFin.getMonth() + 6);
  }
  let formattedFechaFin = fechaFin.toISOString().split("T")[0];

  /**AUDIO */
  let extensionau = audio.split(".").pop();
  let nombreAudio = "";
  let a = new Date();
  if (audio.length) {
    nombreAudio =
      "AUD-" +
      a.getDate() +
      "" +
      (a.getMonth() + 1) +
      "" +
      a.getFullYear() +
      "" +
      a.getHours() +
      "" +
      a.getMilliseconds() +
      "." +
      extensionau;
  }

  /**FOTO */
  let extension = foto.split(".").pop();
  let nombreFoto = "";
  let f = new Date();
  if (foto.length) {
    nombreFoto =
      "DIF-" +
      f.getDate() +
      "" +
      (f.getMonth() + 1) +
      "" +
      f.getFullYear() +
      "" +
      f.getHours() +
      "" +
      f.getMilliseconds() +
      "." +
      extension;
  }

  /**FOTO PORTADA*/
  let extensionPortada = portada.split(".").pop();
  let nombreFotoPortada = "";
  let p = new Date();
  if (portada.length) {
    nombreFotoPortada =
      "PORT-" +
      p.getDate() +
      "" +
      (p.getMonth() + 1) +
      "" +
      p.getFullYear() +
      "" +
      p.getHours() +
      "" +
      p.getMilliseconds() +
      "." +
      extensionPortada;
  }

  let formData = new FormData();
  let fotoObject = $("#file_foto")[0].files[0];
  let audioObject = $("#txt_cancion")[0].files[0];
  let portadaObject = $("#file_foto_portada")[0].files[0];

  formData.append("documentoCliente", documentoCliente);
  formData.append("nombre", nombre);
  formData.append("fechaNacimiento", formattedFechaNacimiento);
  formData.append("fechaFallecimiento", formattedFechaFallecimiento);
  formData.append("biografia", biografia);
  formData.append("nombreFoto", nombreFoto);
  formData.append("foto", fotoObject);
  formData.append("nombreFotoPortada", nombreFotoPortada);
  formData.append("portada", portadaObject);
  formData.append("videoLink", videoLink);
  formData.append("ubicacionLink", ubicacionLink);
  formData.append("nombreAudio", nombreAudio);
  formData.append("audio", audioObject);
  formData.append("plan", plan);
  formData.append("fechaFin", formattedFechaFin);

  $.ajax({
    url: "../controller/difunto/controlador_registrar_difunto.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          LimpiarModalDifunto();
          Swal.fire(
            "Mensaje de Confirmacion",
            "Difunto registrado correctamente",
            "success"
          ).then((value) => {
            $("#modal_registro_difunto").modal("hide");
            LimpiarModalDifunto();
            tbl_difunto.ajax.reload();
          });
        } else {
          Swal.fire(
            "Mensaje de Advertencia",
            "El Difunto ya se encuentra registrado",
            "warning"
          );
        }
      } else {
        Swal.fire(
          "Mensaje de Advertencia",
          "Error al registrar Difunto",
          "error"
        );
      }
    },
  });
}

/** EDITAR FOTO */
function EditarFoto() {
  let idDifunto = document.getElementById("idDifuntoFoto").value;
  let foto = document.getElementById("file_foto_editar").value;
  let fotoActual = document.getElementById("idDifuntoFotoActual").value;

  if (foto.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione una foto",
      "warning"
    );
  }

  let extension = foto.split(".").pop();
  let nombreFoto = "";
  let f = new Date();
  if (foto.length > 0) {
    nombreFoto =
      "DIF-" +
      f.getDate() +
      "" +
      (f.getMonth() + 1) +
      "" +
      f.getFullYear() +
      "" +
      f.getHours() +
      "" +
      f.getMilliseconds() +
      "." +
      extension;
  }

  let formData = new FormData();
  let fotoObject = $("#file_foto_editar")[0].files[0];

  formData.append("idDifunto", idDifunto);
  formData.append("fotoActual", fotoActual);
  formData.append("nombreFoto", nombreFoto);
  formData.append("foto", fotoObject);

  $.ajax({
    url: "../controller/difunto/controlador_editar_foto.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        Swal.fire(
          "Mensaje de Confirmacion",
          "Foto editada correctamente",
          "success"
        ).then((value) => {
          $("#modal_editar_foto").modal("hide");
          tbl_difunto.ajax.reload();
        });
      } else {
        Swal.fire("Mensaje de Error", "Error al editar foto", "error");
      }
    },
  });
}

/** EDITAR PORTADA */
function EditarPortada() {
  let idDifuntoPortada = document.getElementById("idDifuntoPortada").value;
  let portada = document.getElementById("file_Portada_editar").value;
  let portadaActual = document.getElementById("idDifuntoPortadaActual").value;

  if (portada.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione una foto",
      "warning"
    );
  }

  /**FOTO PORTADA*/
  let extensionPortada = portada.split(".").pop();
  let nombreFotoPortada = "";
  let p = new Date();
  if (portada.length) {
    nombreFotoPortada =
      "PORT-" +
      p.getDate() +
      "" +
      (p.getMonth() + 1) +
      "" +
      p.getFullYear() +
      "" +
      p.getHours() +
      "" +
      p.getMilliseconds() +
      "." +
      extensionPortada;
  }

  let formData = new FormData();
  let portadaObject = $("#file_Portada_editar")[0].files[0];
  formData.append("idDifuntoPortada", idDifuntoPortada);
  formData.append("portadaActual", portadaActual);
  formData.append("nombreFotoPortada", nombreFotoPortada);
  formData.append("portada", portadaObject);

  $.ajax({
    url: "../controller/difunto/controlador_editar_portada.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        Swal.fire(
          "Mensaje de Confirmacion",
          "Portada editada correctamente",
          "success"
        ).then((value) => {
          $("#modal_editar_portada").modal("hide");
          tbl_difunto.ajax.reload();
        });
      } else {
        Swal.fire("Mensaje de Error", "Error al editar Portada", "error");
      }
    },
  });
}

/** VALIDAR CAMPOS */
function ValidarCamposDifunto(
  nombre,
  nacimiento,
  fallecimiento,
  biografia,
  video,
  ubicacion
) {
  Boolean(document.getElementById(nombre).value.length > 0)
    ? $("#" + nombre)
        .removeClass("is-invalid")
        .addClass("is-valid")
    : $("#" + nombre)
        .removeClass("is-valid")
        .addClass("is-invalid");
  Boolean(document.getElementById(nacimiento).value.length > 0)
    ? $("#" + nacimiento)
        .removeClass("is-invalid")
        .addClass("is-valid")
    : $("#" + nacimiento)
        .removeClass("is-valid")
        .addClass("is-invalid");
  Boolean(document.getElementById(fallecimiento).value.length > 0)
    ? $("#" + fallecimiento)
        .removeClass("is-invalid")
        .addClass("is-valid")
    : $("#" + fallecimiento)
        .removeClass("is-valid")
        .addClass("is-invalid");
  Boolean(document.getElementById(biografia).value.length > 0)
    ? $("#" + biografia)
        .removeClass("is-invalid")
        .addClass("is-valid")
    : $("#" + biografia)
        .removeClass("is-valid")
        .addClass("is-invalid");
  Boolean(document.getElementById(video).value.length > 0)
    ? $("#" + video)
        .removeClass("is-invalid")
        .addClass("is-valid")
    : $("#" + video)
        .removeClass("is-valid")
        .addClass("is-invalid");
  Boolean(document.getElementById(ubicacion).value.length > 0)
    ? $("#" + ubicacion)
        .removeClass("is-invalid")
        .addClass("is-valid")
    : $("#" + ubicacion)
        .removeClass("is-valid")
        .addClass("is-invalid");
}

/** LIMPIAR MODAL */
function LimpiarModalDifunto() {
  $("#select_documento_cliente").select2().val("").trigger("change.select2");
  $("#select_plan").select2().val("").trigger("change.select2");
  document.getElementById("txt_nombre").value = "";
  document.getElementById("date_nacimiento").value = "";
  document.getElementById("date_fallecimiento").value = "";
  document.getElementById("txt_biografia").value = "";
  document.getElementById("file_foto").value = "";
  document.getElementById("txt_video").value = "";
  document.getElementById("txt_ubicacion").value = "";
  document.getElementById("txt_cancion").value = "";
}

/** EDITAR DIFUNTO */
function EditarDifunto() {
  let idDifunto = document.getElementById("idDifunto").value;
  let documentoCliente = document.getElementById(
    "select_documento_cliente_editar"
  ).value;
  let nombre = document.getElementById("txt_nombre_editar").value;
  let fechaNacimiento = document.getElementById("date_nacimiento_editar").value;
  let fechaFallecimiento = document.getElementById(
    "date_fallecimiento_editar"
  ).value;
  let biografia = document.getElementById("txt_biografia_editar").value;
  let videoLink = document.getElementById("txt_video_editar").value;
  let ubicacionLink = document.getElementById("txt_ubicacion_editar").value;
  let plan = document.getElementById("select_plan_editar").value;
  let estado = document.getElementById("select_estado_editar").value;

  if (documentoCliente.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione un cliente",
      "warning"
    );
  }

  if (plan.length == 0) {
    return Swal.fire("Mensaje de Advertencia", "Seleccione un plan", "warning");
  }

  if (estado.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione un estado",
      "warning"
    );
  }

  if (
    nombre.length == 0 ||
    fechaNacimiento.length == 0 ||
    fechaFallecimiento.length == 0 ||
    biografia.length == 0 ||
    videoLink.length == 0 ||
    ubicacionLink.length == 0
  ) {
    ValidarCamposDifunto(
      "txt_nombre_editar",
      "date_nacimiento_editar",
      "date_fallecimiento_editar",
      "txt_biografia_editar",
      "txt_video_editar",
      "txt_ubicacion_editar"
    );
    return Swal.fire(
      "Mensaje de Advertencia",
      "Complete los campos",
      "warning"
    );
  }

  // Calcular fecha_fin dependiendo del plan usando la fecha de registro (fecha actual)
  let fechaRegistro = new Date(); // Fecha actual
  let fechaFin = new Date(fechaRegistro); // Copiar fecha actual
  if (plan === "ANUAL") {
    fechaFin.setFullYear(fechaFin.getFullYear() + 1);
  } else if (plan === "SEMESTRAL") {
    fechaFin.setMonth(fechaFin.getMonth() + 6);
  }
  let formattedFechaFin = fechaFin.toISOString().split("T")[0];

  $.ajax({
    url: "../controller/difunto/controlador_editar_difunto.php",
    type: "POST",
    data: {
      idDifunto: idDifunto,
      documentoCliente: documentoCliente,
      nombre: nombre,
      fechaNacimiento: fechaNacimiento,
      fechaFallecimiento: fechaFallecimiento,
      biografia: biografia,
      videoLink: videoLink,
      ubicacionLink: ubicacionLink,
      plan: plan,
      fechaFin: formattedFechaFin,
      estado: estado,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        Swal.fire(
          "Mensaje de Confirmacion",
          "Difunto editado correctamente",
          "success"
        ).then((value) => {
          $("#modal_editar_difunto").modal("hide");
          tbl_difunto.ajax.reload();
        });
      } else {
        Swal.fire(
          "Mensaje de Advertencia",
          "El Difunto ya se encuentra registrado",
          "warning"
        );
      }
    } else {
      Swal.fire("Mensaje de Advertencia", "Error al editar Difunto", "error");
    }
  });
}

/** MENSAJE DE ELIMINAR */
$("#tabla_difunto").on("click", ".eliminar", function () {
  var data = tbl_difunto.row($(this).parents("tr")).data();
  if (tbl_difunto.row(this).child.isShown()) {
    var data = tbl_difunto.row(this).data();
  }

  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Eliminará el difunto seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      EliminarDifunto(data.id_difunto);
    }
  });
});

/** ELIMINAR DIFUNTO */
function EliminarDifunto(idDifunto) {
  $.ajax({
    url: "../controller/difunto/controlador_eliminar_difunto.php",
    type: "POST",
    data: {
      idDifunto: idDifunto,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Difunto eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_difunto.ajax.reload();
      });
    } else {
      Swal.fire("Mensaje de Advertencia", "Error al eliminar Difunto", "error");
    }
  });
}

function Registrar_Comentario() {
  let name = document.getElementById("name").value;
  let telefono = document.getElementById("telefono").value;
  let message = document.getElementById("message").value;
  let id_difunto = document.getElementById("id_difunto").value;
  let fechaComentario = new Date().toLocaleDateString("es-PE"); // Obtener fecha en formato español

  // Verificación básica antes de la solicitud AJAX
  if (name.length == 0 || telefono.length == 0 || message.length == 0) {
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
    url: "../adm/controller/difunto/controlador_registrar_comentario.php",
    type: "POST",
    data: {
      id_difunto: id_difunto,
      name: name,
      telefono: telefono,
      message: message,
      fecha_comentario: fechaComentario,
    },
  })
    .done(function (resp) {
      if (resp > 0) {
        // Si el valor retornado es mayor a 0, se insertó correctamente
        Swal.fire({
          title: "Comentario Registrado",
          text: "El comentario fue registrado exitosamente.",
          icon: "success",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
        }).then(() => {
          // Limpiar campos después de éxito
          document.getElementById("name").value = "";
          document.getElementById("telefono").value = "";
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
          text: "No se completó el registro del comentario.",
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
        text: "Hubo un problema al intentar registrar el comentario. Intente de nuevo.",
        icon: "error",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });
    });
}
