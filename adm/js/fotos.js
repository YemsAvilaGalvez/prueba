/** LISTAR */
var tbl_imagen;
function Listar_Foto() {
  tbl_imagen = $("#tabla_imagen").DataTable({
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
      url: "../controller/foto/controlador_listar_foto.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      //{ defaultContent: "" },
      { data: "id_foto" },
      { data: "id_difunto" },
      {
        data: "ruta_foto",
        render: function (data) {
          return (
            "<img src='../" +
            data +
            "' class='img-responsive' style='width: 50px; height: 50px; border-radius: 50%;'>"
          );
        },
      },
      { data: "fecha_subida" },
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
  tbl_imagen.on("draw.td", function () {
    var PageInfo = $("#tabla_imagen").DataTable().page.info();
    tbl_imagen
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/*** ABRIR MODAL */
function AbrirRegistroImagen() {
  $("#modal_registro_imagen").modal({ backdrop: "static", keyboard: false });
  $("#modal_registro_imagen").modal("show");
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
}

/** CARGAR DIFUNTOS */
function Cargar_Select_Difunto() {
  $.ajax({
    url: "../controller/foto/controlador_cargar_difunto.php",
    type: "POST",
  }).done(function (resp) {
    let data = JSON.parse(resp);
    let llenardata = "<option value=''>Seleccione</option>";
    if (data.length > 0) {
      for (let i = 0; i < data.length; i++) {
        llenardata +=
          "<option value='" + data[i][0] + "'>" + data[i][0] + "</option>";
      }
      document.getElementById("select_id_difunto").innerHTML = llenardata;
      //document.getElementById("select_id_difunto_editar").innerHTML = llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_id_difunto").innerHTML = llenardata;
      //document.getElementById("select_id_difunto_editar").innerHTML = llenardata;
    }
  });
}

/*
function Registrar_Foto() {
  let idDifunto = document.getElementById("select_id_difunto").value;
  let fotos = $("#file_foto")[0].files;

  if (idDifunto.length === 0) {
    return Swal.fire("Mensaje de Advertencia", "Seleccione un difunto", "warning");
  }

  if (fotos.length === 0) {
    return Swal.fire("Mensaje de Advertencia", "Seleccione al menos una foto", "warning");
  }

  let validExtensions = ["jpg", "jpeg", "png", "gif"];
  let fotoObjects = [];
  let maxFileSize = 500 * 1024 * 1024; // 5 MB

  for (let i = 0; i < fotos.length; i++) {
    let foto = fotos[i];
    let extension = foto.name.split(".").pop().toLowerCase();

    // Validar extensión
    if (!validExtensions.includes(extension)) {
      return Swal.fire("Mensaje de Advertencia", "Solo se permiten archivos de imagen (JPG, PNG, GIF)", "warning");
    }

    // Validar tamaño
    if (foto.size > maxFileSize) {
      return Swal.fire("Mensaje de Advertencia", "El tamaño máximo permitido es 5 MB por foto", "warning");
    }

    // Generar el nombre único de la foto
    let f = new Date();
    let nombreFoto =
      "IMG-" +
      f.getDate() +
      (f.getMonth() + 1) +
      f.getFullYear() +
      f.getHours() +
      f.getMinutes() +
      f.getSeconds() +
      f.getMilliseconds() +
      "." +
      extension;

    fotoObjects.push({
      foto: foto,
      nombreFoto: nombreFoto,
    });
  }

  let formData = new FormData();
  formData.append("idDifunto", idDifunto);

  fotoObjects.forEach((fotoObj) => {
    formData.append("fotos[]", fotoObj.foto);
    formData.append("nombresFotos[]", fotoObj.nombreFoto);
  });

  $.ajax({
    url: "../controller/foto/controlador_registrar_foto.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          LimpiarModalFotos();
          Swal.fire("Mensaje de Confirmación", "Fotos registradas correctamente", "success").then((value) => {
            $("#modal_registro_imagen").modal("hide");
            LimpiarModalFotos();
            tbl_imagen.ajax.reload();
          });
        }
      } else {
        Swal.fire("Mensaje de Advertencia", "Error al registrar las Fotos", "error");
      }
    },
    error: function (xhr, status, error) {
      Swal.fire(
        "Mensaje de Advertencia",
        "Error en la conexión con el servidor: " + error,
        "error"
      );
    },
  });
}
*/

/** REGISTRAR IMAGEN */
function Registrar_Foto() {
  let idDifunto = document.getElementById("select_id_difunto").value;
  let fotos = document.getElementById("file_foto").files; // Obtener todos los archivos seleccionados

if (fotos.length == 0) {
    return Swal.fire("Mensaje de Advertencia", "Seleccione una o más imágenes", "warning");
}

let formData = new FormData();
formData.append("idDifunto", idDifunto);
for (let i = 0; i < fotos.length; i++) {
    formData.append("foto[]", fotos[i]); // "foto[]" es el campo que usas en PHP
    let extension = fotos[i].name.split(".").pop();
    let nombreFoto = "DIF-" + new Date().getTime() + "-" + i + "." + extension;
    formData.append("nombreFoto[]", nombreFoto); // Guardar los nombres de los archivos
}

$.ajax({
    url: "../controller/foto/controlador_registrar_foto.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                LimpiarModalFotos();
                Swal.fire("Mensaje de Confirmación", "Las imágenes se registraron correctamente", "success").then((value) => {
                    $("#modal_registro_imagen").modal("hide");
                    LimpiarModalFotos();
                    tbl_imagen.ajax.reload();
                });
                
            } else {
                Swal.fire("Mensaje de Advertencia", "Error al registrar imágenes", "error");
            }
        } else {
          LimpiarModalFotos();
          Swal.fire("Mensaje de Confirmación", "Las imágenes se registraron correctamente", "success").then((value) => {
              $("#modal_registro_imagen").modal("hide");
              LimpiarModalFotos();
              tbl_imagen.ajax.reload();
          });
        }
    },
});
}

/** LIMPIAR MODAL */
function LimpiarModalFotos() {
  $("#select_id_difunto").select2().val("").trigger("change.select2");
  document.getElementById("file_foto").value = "";
}
