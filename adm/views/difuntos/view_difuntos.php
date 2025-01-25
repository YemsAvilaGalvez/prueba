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
                                    <th>ID</th>
                                    <th>Documento Cliente</th>
                                    <th>Nombre</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Fecha Fallecimiento</th>
                                    <th>Imagen</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Culminacion</th>
                                    <th>Plan</th>
                                    <th>Estado</th>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar Difunto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Documento del Cliente</label>
                                    <select class="form-control select2" id="select_documento_cliente" style="width: 100%;">

                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txt_nombre">Nombre Completo</label>
                                    <input type="text" class="form-control" id="txt_nombre" placeholder="Nombre Completo" onkeypress="return soloLetras(event)">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date_nacimiento">Fecha Nacimiento</label>
                                    <input type="date" class="form-control" id="date_nacimiento" placeholder="Fecha Nacimiento">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date_fallecimiento">Fecha Fallecimiento</label>
                                    <input type="date" class="form-control" id="date_fallecimiento" placeholder="Fecha Fallecimiento">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Biografia</label>
                                    <textarea class="form-control" rows="3" id="txt_biografia" placeholder="Enter ..."></textarea>
                                </div>
                                <!-- textarea -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="file_foto">Imagen Perfil</label>
                                    <input type="file" class="form-control" id="file_foto" placeholder="Imagen" onchange="soloImagenes(this)">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="file_foto_portada">Imagen Portada</label>
                                    <input type="file" class="form-control" id="file_foto_portada" placeholder="Imagen" onchange="soloImagenes(this)">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txt_video">Video</label>
                                    <input type="text" class="form-control" id="txt_video" placeholder="Link del Video">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txt_ubicacion">Ubicacion</label>
                                    <input type="text" class="form-control" id="txt_ubicacion" placeholder="Link de Ubicacion">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txt_cancion">Cancion</label>
                                    <input type="file" class="form-control" id="txt_cancion" placeholder="Link de Cancion" onchange="soloAudios(this)">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Plan</label>
                                    <select class="form-control select2" id="select_plan" style="width: 100%;">
                                        <option value="">Seleccnione un plan</option>
                                        <option value="ANUAL">ANUAL</option>
                                        <option value="SEMESTRAL">SEMESTRAL</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
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
        <!-- /.modal -->


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
                                        <option value="ANUAL">ANUAL</option>
                                        <option value="SEMESTRAL">SEMESTRAL</option>
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
                        <input type="text" id="idDifuntoFoto" hidden>
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

        <!-- model editar portada -->
        <div class="modal fade" id="modal_editar_portada">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Foto de Portada</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idDifuntoPortada" hidden>
                        <input type="text" id="idDifuntoPortadaActual" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_Portada_editar">Imagen de Portada</label>
                                <input type="file" class="form-control" id="file_Portada_editar" placeholder="Imagen" onchange="soloImagenes(this)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Portada Actual</label>
                                    <div class="card">
                                        <img class="" id="img-preview-portada">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="EditarPortada();">Editar Portada</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal end-->

        <!-- model editar audio -->
        <div class="modal fade" id="modal_editar_audio">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Audio</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idDifuntoAudio" hidden>
                        <input type="text" id="idDifuntoAudioActual" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_cancion_editar">Cancion</label>
                                <input type="file" class="form-control" id="file_cancion_editar" onchange="soloAudios(this)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Portada Actual</label>
                                    <div class="card">
                                        <audio class="" id="aud-preview" controls></audio>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="EditarAudio();">Editar Cancion</button>
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