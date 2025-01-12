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
      { data: "imagen_perfil" },
      { data: "video_link" },
      { data: "ubicacion_link" },
      { data: "cancion_link" },
      { data: "fecha_creacion" },
      {
        defaultContent:
          "<center>" +
          "<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class= 'fa fa-edit'></i></span><span class=' aumentar text-success px-1' style='cursor:pointer;' title='Aumentar Stock'><i class= 'fa fa-plus'></i></span><span class=' codigoqr text-secondary px-1' style='cursor:pointer;' title='Generar codigo Qr'><i class= 'fa fa-qrcode'></i></span>&nbsp;<span class='foto text-info px-1' style='cursor:pointer;' title='Cambiar foto'><i class='fa fa-image'></i></span>" +
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
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_documento_cliente").innerHTML =
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

  if (documentoCliente.length) {
    return Swal.fire("Mensaje de Advertencia", "Seleccione un cliente", "warning");
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
    return Swal.fire("Mensaje de Advertencia", "Complete los campos", "warning");
  }

  let extension = foto.split(".").pop();
  let nombreFoto = "";
  let f = new Date();
  if (foto.length) {
    nombreFoto =
      "DIF" +
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
  formData.append("fechaNacimiento", fechaNacimiento);
  formData.append("fechaFallecimiento", fechaFallecimiento);
  formData.append("biografia", biografia);
  formData.append("foto", nombreFoto);
  formData.append("foto", fotoObject);
  formData.append("videoLink", videoLink);
  formData.append("ubicacionLink", ubicacionLink);
  formData.append("cancionLink", cancionLink);

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
          Swal.fire("Mensaje de Confirmacion", "Difunto registrado correctamente", "success").then((value) => {
            $("#modal_registro_difunto").modal("hide");
            LimpiarModalDifunto();
            tbl_difunto.ajax.reload();
          });
        } else {
          Swal.fire("Mensaje de Advertencia", "El Difunto ya se encuentra registrado", "warning");
        }
      } else {
        Swal.fire("Mensaje de Advertencia", "Error al registrar Difunto", "error");
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
  $("select_documento_cliente").select2().val("").trigger("change.select2");
  document.getElementById("txt_nombre").value = "";
  document.getElementById("date_nacimiento").value = "";
  document.getElementById("date_fallecimiento").value = "";
  document.getElementById("txt_biografia").value = "";
  document.getElementById("file_foto").value = "";
  document.getElementById("txt_video").value = "";
  document.getElementById("txt_ubicacion").value = "";
  document.getElementById("txt_cancion").value = "";
}
