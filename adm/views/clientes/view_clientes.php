<script src="../js/clientes.js?rev=<?php echo time(); ?>"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>MANTENIMIENTO DE CLIENTES</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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
                        <h3 class="card-title font-weight-bold">LISTADO DE CLIENTES</h3>
                        <button class="btn btn-danger btn-sm float-right" onclick="AbrirModalRegistrarCliente()">
                            <i class="fas fa-plus"></i> Nuevo Registro
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla_cliente" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Completo</th>
                                    <th>Documento de Identidad</th>
                                    <th>Celular</th>
                                    <th>Departamento</th>
                                    <th>Distrito</th>
                                    <th>Provincia</th>
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
        <div class="modal fade" id="modal_registro_cliente">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_documento">N° Documento</label>
                                <input type="text" class="form-control" id="txt_documento" placeholder="N° Documento">
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
                                <label for="txt_celular">Celular</label>
                                <input type="tel" class="form-control" id="txt_celular" placeholder="Celular">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_departamento">Departamento</label>
                                <input type="text" class="form-control" id="txt_departamento" placeholder="Departamento">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_distrito">Distrito</label>
                                <input type="text" class="form-control" id="txt_distrito" placeholder="Distrito">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_provincia">Provincia</label>
                                <input type="text" class="form-control" id="txt_provincia" placeholder="Provincia">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="LimpiarModalCliente();">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnRegistraCliente">Registrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal end-->

        
        <!-- model registrar -->
        <div class="modal fade" id="modal_editar_cliente">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">editar Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idCliente" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_documento_editar">N° Documento</label>
                                <input type="text" class="form-control" id="txt_documento_editar" placeholder="N° Documento">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_nombre_editar">Nombre Completo</label>
                                <input type="text" class="form-control" id="txt_nombre_editar" placeholder="Nombre Completo">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_celular_editar">Celular</label>
                                <input type="tel" class="form-control" id="txt_celular_editar" placeholder="Celular">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_departamento_editar">Departamento</label>
                                <input type="text" class="form-control" id="txt_departamento_editar" placeholder="Departamento">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_distrito_editar">Distrito</label>
                                <input type="text" class="form-control" id="txt_distrito_editar" placeholder="Distrito">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_provincia">Provincia</label>
                                <input type="text" class="form-control" id="txt_provincia_editar" placeholder="Provincia">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="EditarCliente();">Editar</button>
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
    Listar_Cliente();
    $('#btnRegistraCliente').on('click', function() {
        Registrar_Cliente();
    });
</script>