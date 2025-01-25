/** LISTAR TESTIMONIO*/
var tbl_testimonio;
function Listar_Testimonio() {
  tbl_testimonio = $("#tabla_testimonio").DataTable({
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
      url: "../controller/comentarios/controlador_listar_testimonio.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      //{ defaultContent: "" },
      { data: "id_tes" },
      { data: "nombre" },
      { data: "comentario" },
      {
        defaultContent:
          "<center>" +
          "<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_testimonio.on("draw.td", function () {
    var PageInfo = $("#tabla_testimonio").DataTable().page.info();
    tbl_testimonio
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/** LISTAR */
var tbl_condolencia;
function Listar_Condolencia() {
  tbl_condolencia = $("#tabla_condolencia").DataTable({
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
      url: "../controller/comentarios/controlador_listar_Condolencia.php",
      type: "POST",
    },
    dom: "Blfrtip",
    columns: [
      //{ defaultContent: "" },
      { data: "id_comentario" },
      { data: "nombre" },
      { data: "nombre_pariente" },
      { data: "numero_celular" },
      { data: "mensaje" },
      { data: "fecha_comentario" },
      {
        defaultContent:
          "<center>" +
          "<span class='eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_condolencia.on("draw.td", function () {
    var PageInfo = $("#tabla_condolencia").DataTable().page.info();
    tbl_condolencia
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/** MENSAJE DE ELIMINAR TESTIMONIO*/
$("#tabla_testimonio").on("click", ".eliminar", function () {
  var data = tbl_testimonio.row($(this).parents("tr")).data();
  if (tbl_testimonio.row(this).child.isShown()) {
    var data = tbl_testimonio.row(this).data();
  }

  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Eliminará el Testimonio seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      EliminarTestimonio(data.id_tes);
    }
  });
});

/** ELIMINAR TESTIMONIO */
function EliminarTestimonio(id_tes) {
  $.ajax({
    url: "../controller/comentarios/controlador_eliminar_testimonio.php",
    type: "POST",
    data: {
      id_tes: id_tes,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Testimonio eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_testimonio.ajax.reload();
      });
    } else {
      Swal.fire(
        "Mensaje de Advertencia",
        "Error al eliminar Testimonio",
        "error"
      );
    }
  });
}

/** MENSAJE DE ELIMINAR CONDOLENCIA*/
$("#tabla_condolencia").on("click", ".eliminar", function () {
  var data = tbl_condolencia.row($(this).parents("tr")).data();
  if (tbl_condolencia.row(this).child.isShown()) {
    var data = tbl_condolencia.row(this).data();
  }

  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Eliminará la Condolencia seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      EliminarCondolencia(data.id_comentario);
    }
  });
});

/** ELIMINAR CONDOLENCIA */
function EliminarCondolencia(id_comentario) {
  $.ajax({
    url: "../controller/comentarios/controlador_eliminar_condolencia.php",
    type: "POST",
    data: {
        id_comentario: id_comentario,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Condolencia eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_condolencia.ajax.reload();
      });
    } else {
      Swal.fire(
        "Mensaje de Advertencia",
        "Error al eliminar Condolencia",
        "error"
      );
    }
  });
}
