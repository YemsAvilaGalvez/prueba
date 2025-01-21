/** LISTAR */
var tbl_difunto_vencido;
function Listar_Difunto_Vencido() {
  tbl_difunto_vencido = $("#tabla_difunto_vencer").DataTable({
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
      url: "../controller/difunto/controlador_listar_difunto_vencido.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      { defaultContent: "" },
      { data: "documento_identidad" },
      { data: "nombre" },
    
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
        data: "dias_restantes",
        render: function (data, type, row) {
          
            return "<center><span class='badge badge-danger'>" + data + " DIAS RESTANTES"+"</span></center>";
        },
      },
  
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_difunto_vencido.on("draw.td", function () {
    var PageInfo = $("#tabla_difunto_vencer").DataTable().page.info();
    tbl_difunto_vencido
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

