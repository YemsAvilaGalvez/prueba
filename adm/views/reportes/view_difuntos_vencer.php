<script src="../js/difuntos_vencimientos.js?rev=<?php echo time(); ?>"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>REPORTE DE VENCIMIENTO DE PLAN</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Vencimiento de Plan</li>
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
               
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla_difunto_vencer" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Documento Cliente</th>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Culminacion</th>
                                    <th>Plan</th>
                                    <th>Dias Restantes</th>
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

      

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->


<script>
    $(document).ready(function() {
        $('.select2').select2()
    })

    Listar_Difunto_Vencido();
</script>