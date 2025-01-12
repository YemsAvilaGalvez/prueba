<script src="../js/difuntos.js?rev=<?php echo time(); ?>"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>MANTENIMIENTO DE DIFUNTOS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Difuntos</li>
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
                        <h3 class="card-title font-weight-bold">LISTADO DE DIFUNTOS</h3>
                        <button class="btn btn-danger btn-sm float-right" onclick="AbrirRegistroDifunto()">
                            <i class="fas fa-plus"></i> Nuevo Registro
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla_difunto" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Documento Cliente</th>
                                    <th>Nombre</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Fecha Fallecimiento</th>
                                    <th>Biografia</th>
                                    <th>Imagen</th>
                                    <th>Video</th>
                                    <th>Ubicacion</th>
                                    <th>Canción</th>
                                    <th>Fecha de Creación</th>
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
        <div class="modal fade" id="modal_registro_difunto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar Difunto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Documento del Cliente</label>
                                <select class="form-control select2" id="select_documento_cliente" style="width: 100%;">
                                
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_nombre">Nombre Completo</label>
                                <input type="text" class="form-control" id="txt_nombre" placeholder="Nombre Completo">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_nacimiento">Fecha Nacimiento</label>
                                <input type="date" class="form-control" id="date_nacimiento" placeholder="Fecha Nacimiento">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_fallecimiento">Fecha Fallecimiento</label>
                                <input type="date" class="form-control" id="date_fallecimiento" placeholder="Fecha Fallecimiento">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Biografia</label>
                                <textarea class="form-control" rows="3" id="txt_biografia" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_foto">Imagen</label>
                                <input type="file" class="form-control" id="file_foto" placeholder="Imagen">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_video">Video</label>
                                <input type="text" class="form-control" id="txt_video" placeholder="Link del Video">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_ubicacion">Ubicacion</label>
                                <input type="text" class="form-control" id="txt_ubicacion" placeholder="Link de Ubicacion">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_cancion">Cancion</label>
                                <input type="text" class="form-control" id="txt_cancion" placeholder="Link de Cancion">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="LimpiarModalDifunto();">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnRegistrarDifunto">Registrar</button>
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

    Listar_Difunto();
    Cargar_Select_Cliente();

    $('#btnRegistrarDifunto').on('click', function() {
        Registrar_Difunto();
    });
    
</script>