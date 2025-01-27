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

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_fecha">Fecha Importante</label>
                                <input type="text" class="form-control" id="txt_fecha" placeholder="Imagen">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_hobbies">Hobbies</label>
                                <input type="text" class="form-control" id="txt_hobbies" placeholder="Imagen">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->


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

        <div class="modal fade" id="modal_editar_data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Datos Personales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idData" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_fecha">Fecha Importante</label>
                                <input type="text" class="form-control" id="txt_fecha_editar" placeholder="Imagen">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_hobbies">Hobbies</label>
                                <input type="text" class="form-control" id="txt_hobbies_editar" placeholder="Imagen">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="EditarData();">Editar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal end-->

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
</script>