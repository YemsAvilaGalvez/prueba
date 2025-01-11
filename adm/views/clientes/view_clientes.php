<script src="../js/consolidado.js?rev=<?php echo time(); ?>"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Consolidado</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Consolidado</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-9">
                                <input class="form-control" type="file" id="text_archivo" accept=".xls, .xlsx, .xlsm, .csv">
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary" onclick="cargar_excel()">Cargar Consolidado</button>
                            </div>
                            <div class="col-lg-1">
                                <button type="submit" class="btn btn-danger" onclick="Eliminar_Consolidado()"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabla_consolidado" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Id_Cita</th>
                                        <th>Fecha_Atencion</th>
                                        <th>Lote</th>
                                        <th>Num_Pag</th>
                                        <th>Num_Reg</th>
                                        <th>Id_Ups</th>
                                        <th>Descripcion_Ups</th>
                                        <th>Descripcion_Sector</th>
                                        <th>Descripcion_Disa</th>
                                        <th>Descripcion_Red</th>
                                        <th>Descripcion_MicroRed</th>
                                        <th>Codigo_Unico</th>
                                        <th>Nombre_Establecimiento</th>
                                        <th>Abrev_Tipo_Doc_Paciente</th>
                                        <th>Numero_Documento_Paciente</th>
                                        <th>Apellido_Paciente</th>
                                        <th>Nombres_Paciente</th>
                                        <th>Fecha_Nacimiento_Paciente</th>
                                        <th>Genero</th>
                                        <th>Id_Etnia</th>
                                        <th>Descripcion_Etnia</th>
                                        <th>Historia_Clinica</th>
                                        <th>Ficha_Familiar</th>
                                        <th>Id_Financiador</th>
                                        <th>Descripcion_Financiador</th>
                                        <th>Descripcion_Pais</th>
                                        <th>Abrev_Tipo_Doc_Personal</th>
                                        <th>Numero_Documento_Personal</th>
                                        <th>Apellido_Personal</th>
                                        <th>Nombres_Personal</th>
                                        <th>Fecha_Nacimiento_Personal</th>
                                        <th>Id_Condicion</th>
                                        <th>Descripcion_Condicion</th>
                                        <th>Id_Profesion</th>
                                        <th>Descripcion_Profesion</th>
                                        <th>Id_Colegio</th>
                                        <th>Descripcion_Colegio</th>
                                        <th>Numero_Colegiatura</th>
                                        <th>Abrev_Tipo_Doc_Registrador</th>
                                        <th>Numero_Documento_Registrador</th>
                                        <th>Apellido_Registrador</th>
                                        <th>Nombres_Registrador</th>
                                        <th>Fecha_Nacimiento_Registrador</th>
                                        <th>Id_Condicion_Establecimiento</th>
                                        <th>Id_Condicion_Servicio</th>
                                        <th>Edad_Reg</th>
                                        <th>Tipo_Edad</th>
                                        <th>Fecha_Actual_Paciente</th>
                                        <th>Id_Turno</th>
                                        <th>Codigo_Item</th>
                                        <th>Descripcion_Item</th>
                                        <th>Tipo_Diagnostico</th>
                                        <th>Valor_Lab</th>
                                        <th>Id_Correlativo</th>
                                        <th>Peso</th>
                                        <th>Talla</th>
                                        <th>Hemoglobina</th>
                                        <th>Perimetro_Abdominal</th>
                                        <th>Perimetro_Cefalico</th>
                                        <th>Descripcion_Otra_Condicion</th>
                                        <th>Fecha_Ultima_Regla</th>
                                        <th>Fecha_Solicitud_Hb</th>
                                        <th>Fecha_Resultado_Hb</th>
                                        <th>Fecha_Registro</th>
                                        <th>Fecha_Modificacion</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Id_Cita</th>
                                        <th>Fecha_Atencion</th>
                                        <th>Lote</th>
                                        <th>Num_Pag</th>
                                        <th>Num_Reg</th>
                                        <th>Id_Ups</th>
                                        <th>Descripcion_Ups</th>
                                        <th>Descripcion_Sector</th>
                                        <th>Descripcion_Disa</th>
                                        <th>Descripcion_Red</th>
                                        <th>Descripcion_MicroRed</th>
                                        <th>Codigo_Unico</th>
                                        <th>Nombre_Establecimiento</th>
                                        <th>Abrev_Tipo_Doc_Paciente</th>
                                        <th>Numero_Documento_Paciente</th>
                                        <th>Apellido_Paciente</th>
                                        <th>Nombres_Paciente</th>
                                        <th>Fecha_Nacimiento_Paciente</th>
                                        <th>Genero</th>
                                        <th>Id_Etnia</th>
                                        <th>Descripcion_Etnia</th>
                                        <th>Historia_Clinica</th>
                                        <th>Ficha_Familiar</th>
                                        <th>Id_Financiador</th>
                                        <th>Descripcion_Financiador</th>
                                        <th>Descripcion_Pais</th>
                                        <th>Abrev_Tipo_Doc_Personal</th>
                                        <th>Numero_Documento_Personal</th>
                                        <th>Apellido_Personal</th>
                                        <th>Nombres_Personal</th>
                                        <th>Fecha_Nacimiento_Personal</th>
                                        <th>Id_Condicion</th>
                                        <th>Descripcion_Condicion</th>
                                        <th>Id_Profesion</th>
                                        <th>Descripcion_Profesion</th>
                                        <th>Id_Colegio</th>
                                        <th>Descripcion_Colegio</th>
                                        <th>Numero_Colegiatura</th>
                                        <th>Abrev_Tipo_Doc_Registrador</th>
                                        <th>Numero_Documento_Registrador</th>
                                        <th>Apellido_Registrador</th>
                                        <th>Nombres_Registrador</th>
                                        <th>Fecha_Nacimiento_Registrador</th>
                                        <th>Id_Condicion_Establecimiento</th>
                                        <th>Id_Condicion_Servicio</th>
                                        <th>Edad_Reg</th>
                                        <th>Tipo_Edad</th>
                                        <th>Fecha_Actual_Paciente</th>
                                        <th>Id_Turno</th>
                                        <th>Codigo_Item</th>
                                        <th>Descripcion_Item</th>
                                        <th>Tipo_Diagnostico</th>
                                        <th>Valor_Lab</th>
                                        <th>Id_Correlativo</th>
                                        <th>Peso</th>
                                        <th>Talla</th>
                                        <th>Hemoglobina</th>
                                        <th>Perimetro_Abdominal</th>
                                        <th>Perimetro_Cefalico</th>
                                        <th>Descripcion_Otra_Condicion</th>
                                        <th>Fecha_Ultima_Regla</th>
                                        <th>Fecha_Solicitud_Hb</th>
                                        <th>Fecha_Resultado_Hb</th>
                                        <th>Fecha_Registro</th>
                                        <th>Fecha_Modificacion</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    Listar_Consolidado();

    /**************************************************
    IMPORTAR DESDE EXCEL
    ****************************************************/
    //validar que solo seleccione un archivo excel 
    document.getElementById("text_archivo").addEventListener("change", () => {
        var fileName = document.getElementById("text_archivo").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).
        toLowerCase();
        if (extFile == "xlsm" || extFile == "xls" || extFile == "xlsx" || extFile == "csv" || extFile == ".xlsm") {
            //TO DO 
        } else {
            Swal.fire("MENSAJE DE ADVERTENCIA",
                "SOLO SE ACEPTAN ARCHIVOS EXCEL - USTED SUBIO UN ARCHIVO CON EXTESION " + extFile, "warning");
            document.getElementById("text_archivo").value = "";
        }
    });

    function cargar_excel() {
        let archivo = document.getElementById("text_archivo").value;
        if (archivo.length == 0) {
            return Swal.fire("Mensaje de Advertencia", "Selecciones un Archivo", "warning");
        }

        let formData = new FormData();
        let excel = $("#text_archivo")[0].files[0];
        formData.append('excel', excel);
        $.ajax({
            url: '../document/excel_import.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resp) {
                Swal.fire("Mensaje de Confirmacion", "Importacion de Productos Exitosa", "success")
                document.getElementById('text_archivo').value = "";
                tbl_consolidado.ajax.reload()


            }

        });
        return false;

    }
</script>