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
