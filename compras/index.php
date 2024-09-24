<?php
global $pdo, $usuarios_datos, $roles_datos, $productos_datos, $URL, $id_usuario, $compras_datos, $id_proveedor;
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');
include ('../app/controllers/compras/lista_compras.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de compras</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Compras Registradas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block">
                            <div class="table-responsive">
                                <div class="table table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th><center>Nro</center></th>
                                            <th><center># de la compra</center></th>
                                            <th><center>Producto</center></th>
                                            <th><center>Fecha de compra</center></th>
                                            <th><center>Proveedor</center></th>
                                            <th><center>Comprobante</center></th>
                                            <th><center>Usuario</center></th>
                                            <th><center>Precio compra</center></th>
                                            <th><center>Cantidad</center></th>
                                            <th><center>Acciones</center></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($compras_datos as $compras_dato) {
                                            $id_compra = $compras_dato['id_compra']; // Fixed array access
                                            ?>
                                            <tr>
                                                <td><?php echo $contador += 1;?></td>
                                                <td><?php echo $compras_dato['nro_compra'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                            data-target="#modal-producto<?php echo $id_compra;?>">
                                                        <?php echo $compras_dato['nombre_producto'];?>
                                                    </button>
                                                    <div class="modal fade" id="modal-producto<?php echo $id_compra;?>">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #30a3ae; color:white">
                                                                    <h4 class="modal-title">Información del Producto</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">Código</label>
                                                                                <input type="text" value="<?php echo $compras_dato['codigo'];?>" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Descripción</label>
                                                                                <input type="text" value="<?php echo $compras_dato['descripcion'];?>" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Stock</label>
                                                                                <input type="text" value="<?php echo $compras_dato['stock'];?>" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Stock Mínimo</label>
                                                                                <input type="text" value="<?php echo $compras_dato['stock_minimo'];?>" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Stock Máximo</label>
                                                                                <input type="text" value="<?php echo $compras_dato['stock_maximo'];?>" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">Precio Compra</label>
                                                                                <input type="text" value="<?php echo $compras_dato['precio_compra_producto'];?>" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Precio Venta</label>
                                                                                <input type="text" value="<?php echo $compras_dato['precio_venta_producto'];?>" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Fecha Ingreso</label>
                                                                                <input type="text" value="<?php echo $compras_dato['fecha_ingreso'];?>" class="form-control" readonly>
                                                                            </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="">Imagen</label>
                                                                                <img src="<?php echo $URL."/almacen/img_productos/".$compras_dato['imagen'];?>" width="100%"  alt="">


                                                                            </div>
                                                                        </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo $compras_dato['fecha_compra'];?></td>
                                                <td><?php echo $compras_dato['id_proveedor'];?></td>
                                                <td><?php echo $compras_dato['comprobante'];?></td>
                                                <td><?php echo $compras_dato['id_usuario'];?></td>
                                                <td><?php echo $compras_dato['precio_compra'];?></td>
                                                <td><?php echo $compras_dato['cantidad'];?></td>
                                                <td>
                                                    <div style="text-align: center;">
                                                        <a href="show.php?id=<?php echo $id_compra; ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                                        <a href="update.php?id=<?php echo $id_compra; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                                                        <a href="delete.php?id=<?php echo $id_compra; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include ('../layout/mensajes.php'); include ('../layout/parte2.php'); ?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ compras",
                "infoEmpty": "Mostrando 0 a 0 de 0 compras",
                "infoFiltered": "(filtrado de _MAX_ total compras)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ compras",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [
                        { extend: 'copy', text: 'Copiar' },
                        { extend: 'pdf', text: 'PDF' },
                        { extend: 'csv', text: 'CSV' },
                        { extend: 'excel', text: 'Excel' },
                        { extend: 'print', text: 'Imprimir' }
                    ]
                },
                {
                    extend: 'colvis',
                    text: 'Visibilidad de columnas'
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>