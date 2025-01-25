<script src="../js/fotos.js?rev=<?php echo time(); ?>"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>MANTENIMIENTO DE IMAGENES</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Imagenes</li>
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
                        <h3 class="card-title font-weight-bold">LISTADO DE IMAGENES</h3>
                        <button class="btn btn-danger btn-sm float-right" onclick="AbrirRegistroImagen()">
                            <i class="fas fa-plus"></i> Nuevo Registro
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla_imagen" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Difjunto</th>
                                    <th>Imagen</th>
                                    <th>Fecha</th>
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
        <div class="modal fade" id="modal_registro_imagen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar Imagen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ID Difunto</label>
                                <select class="form-control select2" id="select_id_difunto" style="width: 100%;">

                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_foto">Imagen</label>
                                <input type="file" class="form-control" id="file_foto" placeholder="Imagen" name="foto[]" multiple onchange="soloImagenes(this)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="LimpiarModalFotos();">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnRegistrarFoto">Registrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal end-->

        <!-- model editar foto -->
        <div class="modal fade" id="modal_editar_foto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Foto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idImangen" hidden>
                        <input type="text" id="idDifuntoFotoActual" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_foto">Imagen</label>
                                <input type="file" class="form-control" id="file_foto_editar" placeholder="Imagen" onchange="soloImagenes(this)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Foto Actual</label>
                                    <div class="card">
                                        <img class="" id="img-preview">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="EditarFoto();">Editar Foto</button>
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

    Listar_Foto();
    Cargar_Select_Difunto();

    $('#btnRegistrarFoto').on('click', function() {
        Registrar_Foto();
    });
</script>