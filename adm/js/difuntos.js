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
      //{ defaultContent: "" },
      { data: "id_difunto" },
      { data: "documento_identidad" },
      { data: "nombre" },
      { data: "fecha_nacimiento" },
      { data: "fecha_fallecimiento" },
      { data: "biografia" },
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
      { data: "video_link" },
      { data: "ubicacion_link" },
      { data: "cancion_link" },
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
        defaultContent:
          "<center>" +
          "<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class= 'fa fa-edit'></i></span>&nbsp;<span class='foto text-info px-1' style='cursor:pointer;' title='Cambiar foto'><i class='fa fa-image'></i></span>&nbsp;<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
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
  document.getElementById("txt_cancion_editar").value = data.cancion_link;
  $("#select_documento_cliente_editar")
    .select2()
    .val(data.id_cliente)
    .trigger("change.select2");
  $("#select_plan_editar").select2().val(data.plan).trigger("change.select2");
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
  let videoLink = document.getElementById("txt_video").value;
  let ubicacionLink = document.getElementById("txt_ubicacion").value;
  let cancionLink = document.getElementById("txt_cancion").value;
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
    ubicacionLink.length == 0 ||
    cancionLink.length == 0
  ) {
    ValidarCamposDifunto(
      "txt_nombre",
      "date_nacimiento",
      "date_fallecimiento",
      "txt_biografia",
      "txt_video",
      "txt_ubicacion",
      "txt_cancion"
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

  let formData = new FormData();
  let fotoObject = $("#file_foto")[0].files[0];

  formData.append("documentoCliente", documentoCliente);
  formData.append("nombre", nombre);
  formData.append("fechaNacimiento", formattedFechaNacimiento);
  formData.append("fechaFallecimiento", formattedFechaFallecimiento);
  formData.append("biografia", biografia);
  formData.append("nombreFoto", nombreFoto);
  formData.append("foto", fotoObject);
  formData.append("videoLink", videoLink);
  formData.append("ubicacionLink", ubicacionLink);
  formData.append("cancionLink", cancionLink);
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

/** VALIDAR CAMPOS */
function ValidarCamposDifunto(
  nombre,
  nacimiento,
  fallecimiento,
  biografia,
  video,
  ubicacion,
  cancion
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
  Boolean(document.getElementById(cancion).value.length > 0)
    ? $("#" + cancion)
        .removeClass("is-invalid")
        .addClass("is-valid")
    : $("#" + cancion)
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
  let cancionLink = document.getElementById("txt_cancion_editar").value;
  let plan = document.getElementById("select_plan_editar").value;

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
    ubicacionLink.length == 0 ||
    cancionLink.length == 0
  ) {
    ValidarCamposDifunto(
      "txt_nombre_editar",
      "date_nacimiento_editar",
      "date_fallecimiento_editar",
      "txt_biografia_editar",
      "txt_video_editar",
      "txt_ubicacion_editar",
      "txt_cancion_editar"
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
      cancionLink: cancionLink,
      plan: plan,
      fechaFin: formattedFechaFin
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
