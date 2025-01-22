/** SELECT DEPARTAMENTO */
function Cargar_Select_Departamento() {
  $.ajax({
    url: "./departamento.php",
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
  //let departamento = document.getElementById("select_departamento").value;
  let departamento = $("#select_departamento_editar").val() || $("#select_departamento").val();
  $.ajax({
    url: "provincia.php",
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
  //let provincia = document.getElementById("select_provincia").value;
  let provincia = $("#select_provincia").val() || $("#select_provincia_editar").val();

  $.ajax({
    url: "distrito.php",
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


/** REGISTAR  */
function Registrar_Cliente() {
  let documento = document.getElementById("txt_documento").value;
  let nombre = document.getElementById("txt_nombre").value;
  let celular = document.getElementById("txt_celular").value;
  let departamento = document.getElementById("select_departamento").value;
  let distrito = document.getElementById("select_distrito").value;
  let provincia = document.getElementById("select_provincia").value;
  
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
    url: "registrar_cliente.php",
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

