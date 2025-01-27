/** LISTAR */
var tbl_data;
function Listar_Data() {
  tbl_data = $("#tabla_data").DataTable({
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
      url: "../controller/data/controlador_listar_data.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      { defaultContent: "" },
      { data: "nombre" },
      { data: "fecha_import" },
      { data: "hobbies" },
      {
        defaultContent:
          "<center>" +
          "<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class= 'fa fa-edit'></i></span>&nbsp;<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_data.on("draw.td", function () {
    var PageInfo = $("#tabla_data").DataTable().page.info();
    tbl_data
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/*** ABRIR MODAL */
function AbrirRegistroData() {
  $("#modal_registro_data").modal({ backdrop: "static", keyboard: false });
  $("#modal_registro_data").modal("show");
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
}

/** ABRIR MODAL EDITAR */
$("#tabla_data").on("click", ".editar", function () {
  var data = tbl_data.row($(this).parents("tr")).data();
  if (tbl_data.row(this).child.isShown()) {
    var data = tbl_data.row(this).data();
  }

  $("#modal_editar_data").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_data").modal("show");

  document.getElementById("idData").value = data.id_data;
  document.getElementById("txt_fecha_editar").value = data.fecha_import;
  document.getElementById("txt_hobbies_editar").value = data.hobbies;
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

/** REGISTRAR */
function Registrar_Data() {
  let idDifunto = document.getElementById("select_id_difunto").value;
  let fecha = document.getElementById("txt_fecha").value;
  let hobbies = document.getElementById("txt_hobbies").value;

  if (idDifunto.length == 0) {
    return Swal.fire("Mensaje de Advertencia", "Seleccione difunto", "warning");
  }

  let formData = new FormData();
  formData.append("idDifunto", idDifunto);
  formData.append("fecha", fecha);
  formData.append("hobbies", hobbies);

  $.ajax({
    url: "../controller/data/controlador_registrar_data.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          LimpiarModalData();
          Swal.fire(
            "Mensaje de Confirmación",
            "Se registro correctamente",
            "success"
          ).then((value) => {
            $("#modal_registro_data").modal("hide");
            LimpiarModalData();
            tbl_data.ajax.reload();
          });
        } else {
          Swal.fire("Mensaje de Advertencia", "Error al registrar", "error");
        }
      }
    },
  });
}

/** LIMPIAR MODAL */
function LimpiarModalData() {
  $("#select_id_difunto").select2().val("").trigger("change.select2");
  document.getElementById("txt_fecha").value = "";
  document.getElementById("txt_hobbies").value = "";
}

/** EDITAR */
function EditarData() {
  let idData = document.getElementById("idData").value;
  let fecha = document.getElementById("txt_fecha_editar").value;
  let hobbies = document.getElementById("txt_hobbies_editar").value;

  $.ajax({
    url: "../controller/data/controlador_editar_data.php",
    type: "POST",
    data: {
      idData: idData,
      fecha: fecha,
      hobbies: hobbies,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        Swal.fire(
          "Mensaje de Confirmacion",
          "Editado correctamente",
          "success"
        ).then((value) => {
          $("#modal_editar_data").modal("hide");
          tbl_data.ajax.reload();
        });
      }
    } else {
      Swal.fire("Mensaje de Advertencia", "Error al editar", "error");
    }
  });
}

/** MENSAJE DE ELIMINAR */
$("#tabla_data").on("click", ".eliminar", function () {
  var data = tbl_data.row($(this).parents("tr")).data();
  if (tbl_data.row(this).child.isShown()) {
    var data = tbl_data.row(this).data();
  }

  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Eliminará el Datos",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
        EliminarData(data.id_data);
    }
  });
});

/** ELIMINAR DIFUNTO */
function EliminarData(id_data) {
  $.ajax({
    url: "../controller/data/controlador_eliminar_data.php",
    type: "POST",
    data: {
        id_data: id_data,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Se eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_data.ajax.reload();
      });
    } else {
      Swal.fire("Mensaje de Advertencia", "Error al eliminar", "error");
    }
  });
}
