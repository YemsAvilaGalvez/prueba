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

/*** ABRIR MODAL */
function AbrirModalRegistrarCliente() {
  $("#modal_registro_cliente").modal({ backdrop: "static", keyboard: false });
  $("#modal_registro_cliente").modal("show");
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
}

/** ABRIR MODAL EDITAR */
$("#tabla_cliente").on("click", ".editar", function () {
  var data = tbl_cliente.row($(this).parents("tr")).data();
  if (tbl_cliente.row(this).child.isShown()) {
    var data = tbl_cliente.row(this).data();
  }

  $("#modal_editar_cliente").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_cliente").modal("show");

  document.getElementById("idCliente").value = data.id_cliente;
  document.getElementById("txt_nombre_editar").value = data.nombre_completo;
  document.getElementById("txt_documento_editar").value = data.documento_identidad;
  document.getElementById("txt_celular_editar").value = data.celular;
  document.getElementById("txt_departamento_editar").value = data.departamento;
  document.getElementById("txt_distrito_editar").value = data.distrito;
  document.getElementById("txt_provincia_editar").value = data.provincia;
  
});

/** REGISTAR  */
function Registrar_Cliente() {
  let documento = document.getElementById("txt_documento").value;
  let nombre = document.getElementById("txt_nombre").value;
  let celular = document.getElementById("txt_celular").value;
  let departamento = document.getElementById("txt_departamento").value;
  let distrito = document.getElementById("txt_distrito").value;
  let provincia = document.getElementById("txt_provincia").value;

  if (
    nombre.length == 0 ||
    documento.length == 0 ||
    celular.length == 0 ||
    departamento.length == 0 ||
    distrito.length == 0 ||
    provincia.length == 0
  ) {
    ValidarCamposCliente(
      "txt_nombre",
      "txt_documento",
      "txt_celular",
      "txt_departamento",
      "txt_distrito",
      "txt_provincia"
    );
    return Swal.fire(
      "Mensaje de Advertencia",
      "Complete los campos",
      "warning"
    );
  }

  let formData = new FormData();

  formData.append("documento", documento);
  formData.append("nombre", nombre);
  formData.append("celular", celular);
  formData.append("departamento", departamento);
  formData.append("distrito", distrito);
  formData.append("provincia", provincia);

  $.ajax({
    url: "../controller/cliente/controlador_registrar_cliente.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          LimpiarModalCliente();
          Swal.fire(
            "Mensaje de Confirmacion",
            "Cliente registrado correctamente",
            "success"
          ).then((value) => {
            $("#modal_registro_cliente").modal("hide");
            LimpiarModalCliente();
            tbl_cliente.ajax.reload();
          });
        } else {
          Swal.fire(
            "Mensaje de Advertencia",
            "El Cliente ya se encuentra registrado",
            "warning"
          );
        }
      } else {
        Swal.fire(
          "Mensaje de Advertencia",
          "Error al registrar Cliente",
          "error"
        );
      }
    },
  });
}

/** EDITAR */
function EditarCliente() {
  let idCliente = document.getElementById("idCliente").value;
  let nombre = document.getElementById("txt_nombre_editar").value;
  let documento = document.getElementById("txt_documento_editar").value;
  let celular = document.getElementById("txt_celular_editar").value;
  let departamento = document.getElementById("txt_departamento_editar").value;
  let distrito = document.getElementById("txt_distrito_editar").value;
  let provincia = document.getElementById("txt_provincia_editar").value;

  
  if (
    nombre.length == 0 ||
    documento.length == 0 ||
    celular.length == 0 ||
    departamento.length == 0 ||
    distrito.length == 0 ||
    provincia.length == 0
  ) {
    ValidarCamposCliente(
      "txt_nombre",
      "txt_documento",
      "txt_celular",
      "txt_departamento",
      "txt_distrito",
      "txt_provincia"
    );
    return Swal.fire(
      "Mensaje de Advertencia",
      "Complete los campos",
      "warning"
    );
  }

  $.ajax({
    url: "../controller/cliente/controlador_editar_cliente.php",
    type: "POST",
    data: {
      idCliente: idCliente,
      nombre: nombre,
      documento: documento,
      celular: celular,
      departamento: departamento,
      distrito: distrito,
      provincia: provincia
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        Swal.fire(
          "Mensaje de Confirmacion",
          "Cliente editado correctamente",
          "success"
        ).then((value) => {
          $("#modal_editar_cliente").modal("hide");
          tbl_cliente.ajax.reload();
        });
      } else {
        Swal.fire(
          "Mensaje de Advertencia",
          "El Cliente ya se encuentra registrado",
          "warning"
        );
      }
    } else {
      Swal.fire("Mensaje de Advertencia", "Error al editar Cliente", "error");
    }
  });
}

/** VALIDAR COMPOS */
function ValidarCamposCliente(documento, nombre, celular, departamento, distrito, provincia) {
  Boolean(document.getElementById(documento).value.length > 0)
  ? $("#" + documento)
      .removeClass("is-invalid")
      .addClass("is-valid")
  : $("#" + documento)
      .removeClass("is-valid")
      .addClass("is-invalid");
  Boolean(document.getElementById(nombre).value.length > 0)
  ? $("#" + nombre)
      .removeClass("is-invalid")
      .addClass("is-valid")
  : $("#" + nombre)
      .removeClass("is-valid")
      .addClass("is-invalid");
  Boolean(document.getElementById(celular).value.length > 0)
  ? $("#" + celular)
      .removeClass("is-invalid")
      .addClass("is-valid")
  : $("#" + celular)  
      .removeClass("is-valid")
      .addClass("is-invalid");
  Boolean(document.getElementById(departamento).value.length > 0)
  ? $("#" + departamento)
      .removeClass("is-invalid")
      .addClass("is-valid")
  : $("#" + departamento)
      .removeClass("is-valid")
      .addClass("is-invalid");
  Boolean(document.getElementById(distrito).value.length > 0)
  ? $("#" + distrito)
      .removeClass("is-invalid")
      .addClass("is-valid")
  : $("#" + distrito)
      .removeClass("is-valid")
      .addClass("is-invalid");
  Boolean(document.getElementById(provincia).value.length > 0)
  ? $("#" + provincia)
      .removeClass("is-invalid")
      .addClass("is-valid")
  : $("#" + provincia)
      .removeClass("is-valid")
      .addClass("is-invalid");
}

/** LIMPIAR MODAL */
function LimpiarModalCliente() {
  document.getElementById("txt_documento").value = "";
  document.getElementById("txt_nombre").value = "";
  document.getElementById("txt_celular").value = "";
  document.getElementById("txt_departamento").value = "";
  document.getElementById("txt_distrito").value = "";
  document.getElementById("txt_provincia").value = "";
}

/** MENSAJE DE ELIMINAR */
$("#tabla_cliente").on("click", ".eliminar", function () {
  var data = tbl_cliente.row($(this).parents("tr")).data();
  if (tbl_cliente.row(this).child.isShown()) {
    var data = tbl_cliente.row(this).data();
  }

  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Eliminará el cliente seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      EliminarCliente(data.id_cliente);
    }
  });
});

/** ELIMINAR DIFUNTO */
function EliminarCliente(idCliente) {
  $.ajax({
    url: "../controller/cliente/controlador_eliminar_cliente.php",
    type: "POST",
    data: {
      idCliente: idCliente,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje de Confirmacion",
        "Cliente eliminado correctamente",
        "success"
      ).then((value) => {
        tbl_cliente.ajax.reload();
      });
    } else {
      Swal.fire("Mensaje de Advertencia", "Error al eliminar Cliente", "error");
    }
  });
}




