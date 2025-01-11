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
      { data: "fecha_registro" },
      { data: "fecha_fin" },

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


