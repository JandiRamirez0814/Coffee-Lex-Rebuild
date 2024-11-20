<?php
global $pdo, $usuarios_datos, $roles_datos, $productos_datos, $URL, $id_usuario;
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');
include ('../app/controllers/almacen/lista_productos.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de productos</h1>
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
                            <h3 class="card-title">Productos Registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block">
                            <div class="table-responsive">
                                <div class="table table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-sm" >
                                        <thead>
                                        <tr>
                                            <th><center>Nro</center></th>
                                            <th><center>Código</center></th>
                                            <th><center>Categoría</center></th>
                                            <th><center>Imagen</center></th>
                                            <th><center>Nombre</center></th>
                                            <th><center>Descripción</center></th>
                                            <th><center>Stock</center></th>
                                            <th><center>Precio compra</center></th>
                                            <th><center>Precio venta</center></th>
                                            <th><center>Fecha compra</center></th>
                                            <th><center>Usuario</center></th>
                                            <th><center>Acciones</center></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($productos_datos as $productos_dato) {
                                            $id_producto = $productos_dato['id_producto'];
                                            ?>
                                            <tr>
                                                <td><?php echo $contador += 1; ?></td>
                                                <td><?php echo $productos_dato['codigo']; ?></td>
                                                <td><?php echo $productos_dato['nombre_categoria']; ?></td>
                                                <td>
                                                    <img src="<?php echo $URL."/almacen/img_productos/".$productos_dato['imagen']; ?>" width="50px" alt="">
                                                </td>
                                                <td><?php echo $productos_dato['nombre']; ?></td>
                                                <td><?php echo $productos_dato['descripcion']; ?></td>
                                                <?php
                                                $Stock_actual = $productos_dato['stock'];
                                                $stock_maximo = $productos_dato['stock_maximo'];
                                                $stock_minimo = $productos_dato['stock_minimo'];
                                                if($Stock_actual <= $stock_minimo){ ?>

                                                    <td style="background-color: #c42f2f"><center><?php echo $productos_dato['stock']; ?></center></td>
                                                <?php
                                                } else if($Stock_actual > $stock_maximo){ ?>
                                                    <td style="background-color: #30ae4e"><center><?php echo $productos_dato['stock']; ?></center></td>

                                                <?php
                                                }else{ ?>
                                                    <td ><center><?php echo $productos_dato['stock']; ?></center></td>

                                                <?php
                                                }
                                                ?>

                                                <td><?php echo $productos_dato['precio_compra']; ?></td>
                                                <td><?php echo $productos_dato['precio_venta']; ?></td>
                                                <td><?php echo $productos_dato['fecha_ingreso']; ?></td>
                                                <td><?php echo $productos_dato['email']; ?></td>
                                                <td>
                                                    <div style="text-align: center;">
                                                        <a href="show.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                                        <a href="update.php?id=<?php echo $id_producto; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                                                        <a href="delete.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</a>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 productos",
                "infoFiltered": "(filtrado de _MAX_ total productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ productos",
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
