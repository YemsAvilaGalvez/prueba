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
      { data: "nombre" },
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
          "<span class='foto text-info px-1' style='cursor:pointer;' title='Cambiar foto'><i class='fa fa-image'></i></span>&nbsp;<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
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

/** ABRIR MODAL EDITAR FOTO */
$("#tabla_imagen").on("click", ".foto", function () {
  var data = tbl_imagen.row($(this).parents("tr")).data();
  if (tbl_imagen.row(this).child.isShown()) {
    var data = tbl_imagen.row(this).data();
  }

  $("#modal_editar_foto").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_foto").modal("show");

  document.getElementById("idImangen").value = data.id_foto;
  document.getElementById("idDifuntoFotoActual").value = data.ruta_foto;
  document.getElementById("img-preview").src = "../" + data.ruta_foto;
});

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

/** REGISTRAR IMAGEN */
function Registrar_Foto() {
  let idDifunto = document.getElementById("select_id_difunto").value;
  let fotos = document.getElementById("file_foto").files;

  if (fotos.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione una o más imágenes",
      "warning"
    );
  }

  let formData = new FormData();
  formData.append("idDifunto", idDifunto);

  let imagenProcesada = 0;

  for (let i = 0; i < fotos.length; i++) {
    let reader = new FileReader();
    reader.readAsDataURL(fotos[i]);

    reader.onload = function (event) {
      let img = new Image();
      img.src = event.target.result;

      img.onload = function () {
        let canvas = document.createElement("canvas");
        let ctx = canvas.getContext("2d");

        // Ajustar tamaño máximo (puedes cambiarlo según tu necesidad)
        let maxWidth = 800; // Ancho máximo
        let maxHeight = 800; // Alto máximo
        let width = img.width;
        let height = img.height;

        if (width > height) {
          if (width > maxWidth) {
            height *= maxWidth / width;
            width = maxWidth;
          }
        } else {
          if (height > maxHeight) {
            width *= maxHeight / height;
            height = maxHeight;
          }
        }

        canvas.width = width;
        canvas.height = height;
        ctx.drawImage(img, 0, 0, width, height);

        // Convertir a formato WebP (más ligero que JPEG/PNG)
        canvas.toBlob(
          (blob) => {
            let extension = "webp"; // Cambiamos a WebP
            let nombreFoto = `DIF-${new Date().getTime()}-${i}.${extension}`;

            formData.append("foto[]", blob, nombreFoto);
            formData.append("nombreFoto[]", nombreFoto);

            imagenProcesada++;

            // Cuando todas las imágenes hayan sido procesadas, enviar AJAX
            if (imagenProcesada === fotos.length) {
              enviarFormulario(formData);
            }
          },
          "image/webp",
          0.7
        ); // Calidad de 70%
      };
    };
  }
}

// Función para enviar el FormData procesado
function enviarFormulario(formData) {
  $.ajax({
    url: "../controller/foto/controlador_registrar_foto.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      //console.log("Respuesta del servidor:", resp); // Muestra la respuesta del servidor

      // Asegúrate de que la respuesta sea un número entero
      if (resp > 0) {
        Swal.fire(
          "Mensaje de Confirmación",
          "Las imágenes se registraron correctamente",
          "success"
        ).then(() => {
          $("#modal_registro_imagen").modal("hide");
          LimpiarModalFotos();
          tbl_imagen.ajax.reload();
        });
      } else {
        /*
        Swal.fire(
          "Mensaje de Advertencia",
          "Error al registrar imágenes",
          "error"
        );*/
        Swal.fire(
          "Mensaje de Confirmación",
          "Las imágenes se registraron correctamente",
          "success"
        ).then(() => {
          $("#modal_registro_imagen").modal("hide");
          LimpiarModalFotos();
          tbl_imagen.ajax.reload();
        });
      }
    },
  });
}




/** EDITAR FOTO */
function EditarFoto() {
  let idImangen = document.getElementById("idImangen").value;
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

  formData.append("idImangen", idImangen);
  formData.append("fotoActual", fotoActual);
  formData.append("nombreFoto", nombreFoto);
  formData.append("foto", fotoObject);

  $.ajax({
    url: "../controller/foto/controlador_editar_foto.php",
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
          tbl_imagen.ajax.reload();
        });
      } else {
        Swal.fire("Mensaje de Error", "Error al editar foto", "error");
      }
    },
  });
}

/** LIMPIAR MODAL */
function LimpiarModalFotos() {
  $("#select_id_difunto").select2().val("").trigger("change.select2");
  document.getElementById("file_foto").value = "";
}

/** MENSAJE DE ELIMINAR */
$("#tabla_imagen").on("click", ".eliminar", function () {
  var data = tbl_imagen.row($(this).parents("tr")).data();
  if (tbl_imagen.row(this).child.isShown()) {
    var data = tbl_imagen.row(this).data();
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
      EliminarFoto(data.id_foto);
    }
  });
});

/** ELIMINAR DIFUNTO */
function EliminarFoto(idFoto) {
  $.ajax({
    url: "../controller/foto/controlador_eliminar_foto.php",
    type: "POST",
    data: {
      idFoto: idFoto,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Foto eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_imagen.ajax.reload();
      });
    } else {
      Swal.fire("Mensaje de Advertencia", "Error al eliminar Foto", "error");
    }
  });
}
