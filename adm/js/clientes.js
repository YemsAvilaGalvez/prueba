var tbl_cliente;
function Listar_Cliente() {

  tbl_cliente = $("#tabla_cliente").DataTable({
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
      url: "../controller/cliente/controlador_listar_cliente.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [

      { defaultContent: "" }, 

      { data: "nombre_completo" },
      { data: "documento_identidad" },
      { data: "celular" },
      { data: "departamento" },
      { data: "distrito" },
      { data: "provincia" },
      {
        defaultContent:
          "<center>" +
          "<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class= 'fa fa-edit'></i></span><span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_cliente.on("draw.td", function () {
    var PageInfo = $("#tabla_cliente").DataTable().page.info();
    tbl_cliente
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}


