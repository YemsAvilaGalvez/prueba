<script src="../js/data.js?rev=<?php echo time(); ?>"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>MANTENIMIENTO DE DATOS PERSONALES</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Datos Perosonales</li>
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
                        <h3 class="card-title font-weight-bold">LISTADO DE DATOS PERSONALES</h3>
                        <button class="btn btn-danger btn-sm float-right" onclick="AbrirRegistroData()">
                            <i class="fas fa-plus"></i> Nuevo Registro
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla_data" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Fecha Importante</th>
                                    <th>Hobbies</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- model registrar -->
        <div class="modal fade" id="modal_registro_data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar Datos Personales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nombre del Difunto</label>
                                <select class="form-control select2" id="select_id_difunto" style="width: 100%;">

                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="txt_fechImport">Fechas Importantes</label>
                                    <input type="text" class="form-control" id="txt_fechImport" placeholder="Ej. Matrimonio, 8 de enero de 1977">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary mt-4" type="button" id="addInputBtn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="newInputsContainer">

                        </div>

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="txt_hobbies">Hobbies</label>
                                    <input type="text" class="form-control" id="txt_hobbies" placeholder="Ej. Cantante">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary mt-4" type="button" id="addInputBtn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="LimpiarModalData();">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnRegistraData">Registrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal end-->


        <!-- model editar -->
        <div class="modal fade" id="modal_editar_difunto">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Difunto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Documento del Cliente</label>
                                    <select class="form-control select2" id="select_documento_cliente_editar" style="width: 100%;">

                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <input type="text" id="idDifunto" hidden>
                                <div class="form-group">
                                    <label for="txt_nombre_editar">Nombre Completo</label>
                                    <input type="text" class="form-control" id="txt_nombre_editar" placeholder="Nombre Completo" onkeypress="return soloLetras(event)">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <input type="text" id="idDifunto" hidden>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date_nacimiento_editar">Fecha Nacimiento</label>
                                    <input type="date" class="form-control" id="date_nacimiento_editar" placeholder="Fecha Nacimiento">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date_fallecimiento_editar">Fecha Fallecimiento</label>
                                    <input type="date" class="form-control" id="date_fallecimiento_editar" placeholder="Fecha Fallecimiento">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Biografia</label>
                                    <textarea class="form-control" rows="3" id="txt_biografia_editar" placeholder="Enter ..."></textarea>
                                </div>
                                <!-- textarea -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txt_video_editar">Video</label>
                                    <input type="text" class="form-control" id="txt_video_editar" placeholder="Link del Video">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txt_ubicacion_editar">Ubicacion</label>
                                    <input type="text" class="form-control" id="txt_ubicacion_editar" placeholder="Link de Ubicacion">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Plan</label>
                                    <select class="form-control select2" id="select_plan_editar" style="width: 100%;">
                                        <option value="">Seleccnione un plan</option>
                                        <option value="BASICO">BASICO</option>
                                        <option value="STANDARD">STANDARD</option>
                                        <option value="PREMIUM">PREMIUM</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control select2" id="select_estado_editar" style="width: 100%;">
                                        <option value="">Seleccnione un estado</option>
                                        <option value="HABILITADO">HABILITADO</option>
                                        <option value="DESABILITADO">DESABILITADO</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="EditarDifunto();">Editar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->


<script>
    $(document).ready(function() {
        $('.select2').select2()
    })

    Listar_Data();
    Cargar_Select_Difunto();

    $('#btnRegistraData').on('click', function() {
        Registrar_Data();
    });


    document.getElementById('addInputBtn').addEventListener('click', function() {
        const newInput = document.createElement('div');
        newInput.classList.add('form-group', 'mt-2');
        newInput.innerHTML = `
             <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="txt_hobbies">Hobbies</label>
                                    <input type="text" class="form-control" id="txt_hobbies" placeholder="Ej. Cantante">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary mt-4" type="button" id="addInputBtn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
        `;
        document.getElementById('newInputsContainer').appendChild(newInput);

        newInput.querySelector('.removeInputBtn').addEventListener('click', function() {
            newInput.remove();
        });
    });
</script>