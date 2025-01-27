/** SELECT DEPARTAMENTO */
function Cargar_Select_Departamento() {
  $.ajax({
    url: "adm/controller/cliente/controlador_cargar_departamento.php",
    type: "POST",
  }).done(function (resp) {
    let data = JSON.parse(resp);
    let llenardata = "<option value=''>Seleccione Departamento</option>";
    if (data.length > 0) {
      for (let i = 0; i < data.length; i++) {
        llenardata +=
          "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
      }
      document.getElementById("select_departamento").innerHTML = llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_departamento").innerHTML = llenardata;
    }
  });
}

/** SELECT PROVINCIA */
function Cargar_Select_Provincia() {
  let departamento = document.getElementById("select_departamento").value;

  $.ajax({
    url: "adm/controller/cliente/controlador_cargar_provincia.php",
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
      document.getElementById("select_provincia").innerHTML = llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_provincia").innerHTML = llenardata;
    }
  });
}

/** SELECT PROVINCIA */
function Cargar_Select_Distrito() {
  let provincia = document.getElementById("select_provincia").value;

  $.ajax({
    url: "adm/controller/cliente/controlador_cargar_distrito.php",
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
      document.getElementById("select_distrito").innerHTML = llenardata;
    } else {
      llenardata += "<option value=''>No se encontraron datos</option>";
      document.getElementById("select_distrito").innerHTML = llenardata;
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

  if (nombre.length == 0 || documento.length == 0 || celular.length == 0) {
    ValidarCamposCliente("txt_nombre", "txt_documento", "txt_celular");
    return Swal.fire({
      title: "Advertencia",
      text: "Campos vacios",
      icon: "warning",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
    });
  }
  
  if (departamento.length == 0) {
    return Swal.fire({
      title: "Advertencia",
      text: "Seleccionde departamento",
      icon: "warning",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
    });
  }
  if (provincia.length == 0) {
    return Swal.fire({
      title: "Advertencia",
      text: "Seleccionde provincia",
      icon: "warning",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
    });
  }
  if (distrito.length == 0) {
    return Swal.fire({
      title: "Advertencia",
      text: "Seleccionde distrito",
      icon: "warning",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
    });
  }


  let formData = new FormData();

  formData.append("nombre", nombre);
  formData.append("documento", documento);
  formData.append("celular", celular);
  formData.append("departamento", departamento);
  formData.append("distrito", distrito);
  formData.append("provincia", provincia);

  $.ajax({
    url: "adm/controller/cliente/controlador_registrar_cliente.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          LimpiarModalCliente();
          Swal.fire({
            title: "Exito",
            text: "Tú registro se realizo de manera correcta, en breve nos comunicaremos contigo. Gracias !.",
            icon: "success",
            toast: true,
            position: "top-end",
            showConfirmButton: true,
            //timer: 2000,
          }).then((value) => {
            LimpiarModalCliente();
          });
        } else {
          Swal.fire({
            title: "Advertencia",
            text: "Ya existe un cliente con el mismo documento",
            icon: "warning",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
          });
        }
      } else {
        Swal.fire({
          title: "Error",
          text: "No se completó el registro",
          icon: "error",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
        });
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
  $("#select_departamento").val(null).trigger("change");
  $("#select_provincia").val(null).trigger("change");
  $("#select_distrito").val(null).trigger("change");
}
