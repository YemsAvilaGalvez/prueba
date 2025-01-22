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
      { data: "Departamento" },
      { data: "Distrito" },
      { data: "Provincia" },
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

  
});

/** REGISTAR  */
function Registrar_Cliente() {
  let documento = document.getElementById("txt_documento").value;
  let nombre = document.getElementById("txt_nombre").value;
  let celular = document.getElementById("txt_celular").value;
  let departamento = document.getElementById("select_departamento").value;
  let distrito = document.getElementById("select_provincia").value;
  let provincia = document.getElementById("select_distrito").value;
  
  if (departamento.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione Departamento",
      "warning"
    );
  }
  if (provincia.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione Provincia",
      "warning"
    );
  }
  if (distrito.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione Distrito",
      "warning"
    );
  }

  if (
    nombre.length == 0 ||
    documento.length == 0 ||
    celular.length == 0 
  ) {
    ValidarCamposCliente(
      "txt_nombre",
      "txt_documento",
      "txt_celular"
    );
    return Swal.fire(
      "Mensaje de Advertencia",
      "Complete los campos",
      "warning"
    );
  }

  let formData = new FormData();

  formData.append("nombre", nombre);
  formData.append("documento", documento);
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
  let departamento = document.getElementById("select_departamento_editar").value;
  let distrito = document.getElementById("select_distrito_editar").value;
  let provincia = document.getElementById("select_provincia_editar").value;

  if (departamento.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione Departamento",
      "warning"
    );
  }
  if (provincia.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione Provincia",
      "warning"
    );
  }
  if (distrito.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Seleccione Distrito",
      "warning"
    );
  }
  
  if (
    nombre.length == 0 ||
    documento.length == 0 ||
    celular.length == 0 
  ) {
    ValidarCamposCliente(
      "txt_nombre",
      "txt_documento",
      "txt_celular"
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

/** SELECT DEPARTAMENTO */
function Cargar_Select_Departamento() {
  $.ajax({
    url: "../controller/cliente/controlador_cargar_departamento.php",
    type: "POST",
  }).done(function (resp) {
    let data = JSON.parse(resp);
    let llenardata = "<option value=''>Seleccione Departamento</option>";
    if (data.length > 0) {
      for (let i = 0; i < data.length; i++) {
        llenardata +=
          "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
      }
      document.getElementById("select_departamento").innerHTML =
        llenardata;
      document.getElementById("select_departamento_editar").innerHTML =
        llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_departamento").innerHTML =
        llenardata;
      document.getElementById("select_departamento_editar").innerHTML =
        llenardata;
    }
  });
}

/** SELECT PROVINCIA */
function Cargar_Select_Provincia() {
  let departamento = document.getElementById("select_departamento").value;
  $.ajax({
    url: "../controller/cliente/controlador_cargar_provincia.php",
    type: "POST",
    data: { departamento: departamento },
  }).done(function (resp) {
    let data = JSON.parse(resp);
    let llenardata = "<option value=''>Seleccione Provincia</option>";
    if (data.length > 0) {
      for (let i = 0; i < data.length; i++) {
        llenardata +=
          "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
      }
      document.getElementById("select_provincia").innerHTML =
        llenardata;
      document.getElementById("select_provincia_editar").innerHTML =
        llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_provincia").innerHTML =
        llenardata;
      document.getElementById("select_provincia_editar").innerHTML =
        llenardata;
    }
  });
}

/** SELECT PROVINCIA */
function Cargar_Select_Distrito() {
  let provincia = document.getElementById("select_provincia").value;
  $.ajax({
    url: "../controller/cliente/controlador_cargar_distrito.php",
    type: "POST",
    data: { provincia: provincia },
  }).done(function (resp) {
    let data = JSON.parse(resp);
    let llenardata = "<option value=''>Seleccione Distrito</option>";
    if (data.length > 0) {
      for (let i = 0; i < data.length; i++) {
        llenardata +=
          "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
      }
      document.getElementById("select_distrito").innerHTML =
        llenardata;
      document.getElementById("select_distrito_editar").innerHTML =
        llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_distrito").innerHTML =
        llenardata;
      document.getElementById("select_distrito_editar").innerHTML =
        llenardata;
    }
  });
}

/** VALIDAR COMPOS */
function ValidarCamposCliente(documento, nombre, celular) {
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
}

/** LIMPIAR MODAL */
function LimpiarModalCliente() {
  document.getElementById("txt_documento").value = "";
  document.getElementById("txt_nombre").value = "";
  document.getElementById("txt_celular").value = "";
  $("#select_departamento").select2().val("").trigger("change.select2");
  $("#select_provincia").select2().val("").trigger("change.select2");
  $("#select_distrito").select2().val("").trigger("change.select2");
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




