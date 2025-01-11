/********************************************************************
                     LISTAMOS LA TABLA
********************************************************************/
var tbl_usuario;
function listar_usuario() {
    tbl_usuario = $("#tabla_usuario").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/usuario/controlador_listar_usuario.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "nombre_usuario" },
            { "data": "usuario" },
            { 
                "data": "usu_rol",
                "render": function(data, type, row) {
                    return '<span class="badge bg-success">' + data + '</span>';
                }
            },
            
            { "defaultContent": "<span class='eliminar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'><i class='fa fa-trash'></i></span></center>" }
        ],
        "language": idioma_espanol,
        select: true
    });

    tbl_usuario.on('draw.td', function () {
        var PageInfo = $("#tabla_usuario").DataTable().page.info();
        tbl_usuario.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}
/********************************************************************
                    FUNCION PARA ABRIR EL MODAL DE REGISTRO
********************************************************************/
function AbrirRegistro() {
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show');
}

/********************************************************************
                     FUNCION PARA INICIAR SESION
********************************************************************/
function Iniciar_Sesion(){
    let usu = document.getElementById('txt_usuario').value;
    let con = document.getElementById('txt_contra').value;
    if(usu.length==0 || con.length==0){
        return Swal.fire({
            icon: 'warning',
            title: 'Mensaje de Advertencia',
            text: 'Llene los campos de la sesion',
            heightAuto:false
        });
    } 

    $.ajax({
        url:'controller/usuario/controlador_iniciar_sesion.php',
        type:'POST',
        data:{
            u:usu,
            c:con
        }
    }).done(function(resp){
        let data = JSON.parse(resp);
        if(data.length>0){
           


            if(data[0][7]=="INACTIVO"){
                return Swal.fire({
                    icon: 'warning',
                    title: 'Mensaje de Advertencia',
                    text: 'El usuario '+usu+' se encuentra inactivo',
                    heightAuto:false
                });
            }
            $.ajax({
                url:'controller/usuario/controlador_crear_sesion.php',
                type:'POST',
                data:{
                    id_usuario:data[0][0],
                    nombre_usuario:data[0][1],
                    usuario:data[0][2],
                    usu_rol:data[0][4],
                    
                   
                }
            }).done(function(r){
                let timerInterval
                Swal.fire({
                  title: 'Bienvenido al sistema de Control de Asistencia',
                  html: 'Seras redireccionado en <b></b> millisegundos.',
                  timer: 2000,
                  timerProgressBar: true,
                  heightAuto:false,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                  }
                })
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Mensaje de Advertencia',
                text: 'Usuario o contraseña incorrecta',
                heightAuto:false
            });
        }
    })
}

/********************************************************************
                    FUNCION PARA CREAR USUARIO
********************************************************************/
function Registrar_Usuario() {
    let nombre_usuario = document.getElementById('nombre_usuario').value;
    let usuario = document.getElementById('usuario').value;
    let contrasena_usuario = document.getElementById('contrasena_usuario').value;
    let usu_rol = document.getElementById('usu_rol').value;

    if (nombre_usuario.length == 0 || usuario.length == 0 || contrasena_usuario.length == 0 || usu_rol.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
    }

    $.ajax({
        "url": "../controller/usuario/controlador_registro_usuario.php",
        type: 'POST',
        data: {
            nombre_usuario: nombre_usuario,
            usuario: usuario,
            contrasena_usuario: contrasena_usuario,
            usu_rol: usu_rol,
           
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmacion", "Nuevo Usuario Registrado", "success").then((value) => {
                    // Limpiar todos los inputs
                    document.getElementById('nombre_usuario').value = "";
                    document.getElementById('usuario').value = "";
                    document.getElementById('contrasena_usuario').value = "";
                    document.getElementById('usu_rol').value = "";

                    // Recargar la tabla de usuarios
                    tbl_usuario.ajax.reload();

                    // Cerrar el modal
                    $("#modal_registro").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El Usuario ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó el registro", "error");
        }
    });
}
/********************************************************************
                        CARGAR SELECT ROL
********************************************************************/

function Cargar_Select_Rol() {
    $.ajax({
        "url": "../controller/usuario/controlador_cargar_select_rol.php",
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        let cadena = "<option value=''>SELECCIONAR ROL</option>"; // Cambia el texto a "ROL"

        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                // Filtra para que el rol "SUPERADMIN" aparezca seleccionado por defecto
                if (data[i].usu_rol === "SUPERADMIN") {
                    cadena += "<option value='" + data[i].usu_rol + "' selected>" + data[i].usu_rol + "</option>"; // Opción seleccionada por defecto
                } else {
                    cadena += "<option value='" + data[i].usu_rol + "'>" + data[i].usu_rol + "</option>";
                }
            }
        } else {
            cadena += "<option value=''>No hay roles disponibles</option>";
        }

        document.getElementById('usu_rol').innerHTML = cadena;
        document.getElementById('usu_rol_editar').innerHTML = cadena;
    });
}

$('#tabla_usuario').on('click', '.eliminar', function () {
    var data = tbl_usuario.row($(this).parents('tr')).data();
    if (tbl_usuario.row(this).child.isShown()) {
        data = tbl_usuario.row(this).data();
    }
    
    Swal.fire({
        title: '¿Desea eliminar el área?',
        text: "Se borrará el registro de la base de datos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Eliminar_Usuario(data.id_usuario);
        }
    });
});

/********************************************************************
            METODO ELIMINAR USUARIO
********************************************************************/
function Eliminar_Usuario(id_usuario) {
    // Verifica si el id_usuario es 1 (administrador)
    if (id_usuario == 1) {
        Swal.fire("Mensaje de Error", "No se puede eliminar al usuario administrador", "error");
        return; // Detiene la ejecución de la función
    }

    $.ajax({
        url: '../controller/usuario/controlador_eliminar_usuario.php',
        type: 'POST',
        data: {
            id_usuario: id_usuario
        }
    }).done(function (resp) {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmación", "Usuario eliminado Satisfactoriamente", "success").then(() => {
                tbl_usuario.ajax.reload(); // Recargar dataTable
            });
        } else {
            Swal.fire("Mensaje de Error", "No se puede eliminar el usuario", "error");
        }
    }).fail(function () {
        Swal.fire("Mensaje de Error", "Error en la solicitud AJAX", "error");
    });
}
