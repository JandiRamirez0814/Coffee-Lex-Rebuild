<?php
global $pdo, $usuarios_datos, $roles_datos, $productos_datos, $URL, $id_usuario, $compras_datos, $id_proveedor, $ventas_datos, $clientes_datos;
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');
include ('../app/controllers/ventas/lista_ventas.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de ventas</h1>
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
                            <h3 class="card-title">Ventas Registradas</h3>
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
                                            <th><center>Nro de Venta</center></th>
                                            <th><center>Productos</center></th>
                                            <th><center>Cliente</center></th>
                                            <th><center>Total pagado</center></th>
                                            <th><center>Acciones</center></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($ventas_datos as $ventas_dato) {
                                            $id_venta = $ventas_dato['id_venta'];
                                            $id_cliente = $ventas_dato['id_cliente'];
                                            $contador += 1;// Fixed array access
                                            ?>
                                            <tr>
                                                <td><center><?php echo $contador;?></center></td>
                                                <td><center><?php echo $ventas_dato['nro_venta'];?></center></td>
                                                <td>
                                                    <center>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#Modal_productos<?php echo $id_venta;?>">
                                                            <i class="fa fa-shopping-basket"></i> Productos
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modal_productos<?php echo $id_venta;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #82C6E0">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $ventas_dato['nro_venta'];?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm table-hover table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th style="background-color: #9db5d5; text-align: center ">Nro</th>
                                                                                    <th style="background-color: #9db5d5; text-align: center ">Producto</th>
                                                                                    <th style="background-color: #9db5d5; text-align: center ">Descripción</th>
                                                                                    <th style="background-color: #9db5d5; text-align: center ">Cantidad</th>
                                                                                    <th style="background-color: #9db5d5; text-align: center ">Precio unitario</th>
                                                                                    <th style="background-color: #9db5d5; text-align: center ">Precio subtotal</th>


                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php
                                                                                $contador_de_carrito = 0;
                                                                                $cantidad_total = 0;
                                                                                $precio_unitario_total = 0;
                                                                                $precio_total = 0;
                                                                                $nro_venta = $ventas_dato['nro_venta'];
                                                                                $sql_carrito = "SELECT *, pro.nombre as nombre_producto, pro.descripcion as descripcion,
                                                                                pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_productos
                                                                                FROM tb_carrito AS carr INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto
                                                                                WHERE nro_venta = '$nro_venta' ORDER BY id_carrito ASC";
                                                                                $squery_carrito = $pdo->prepare($sql_carrito);
                                                                                $squery_carrito->execute(); // Aquí corregido
                                                                                $carrito_datos = $squery_carrito->fetchAll(PDO::FETCH_ASSOC);
                                                                                foreach ($carrito_datos as $carrito_dato){
                                                                                    $id_carrito = $carrito_dato['id_carrito'];
                                                                                    $contador_de_carrito += 1;
                                                                                    $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
                                                                                    $precio_unitario_total += floatval($carrito_dato['precio_venta']);

                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><center><?php echo $contador_de_carrito;?></center>
                                                                                            <input type="text" value="<?php echo $carrito_dato['id_productos']; ?>" id="id_productos<?php echo $contador_de_carrito; ?>" hidden>
                                                                                        </td>


                                                                                        <td><?php echo $carrito_dato['nombre_producto'];?></td>
                                                                                        <td><?php echo $carrito_dato['descripcion'];?></td>
                                                                                        <td><center>
                                                                                                <span id="cantidad_carrito<?php echo $contador_de_carrito;?>"><?php echo $carrito_dato['cantidad'];?></span>
                                                                                                <input type="text" value="<?php echo $carrito_dato['stock'];?>" hidden id="stock_de_inventario<?php echo $contador_de_carrito;?>">
                                                                                            </center></td>
                                                                                        <td><center><?php echo $carrito_dato['precio_venta'];?></center></td>
                                                                                        <td>
                                                                                            <center>
                                                                                                <?php
                                                                                                $cantidad =floatval($carrito_dato['cantidad']);
                                                                                                $precio_venta =floatval($carrito_dato['precio_venta']);
                                                                                                echo $subtotal = $cantidad * $precio_venta;
                                                                                                $precio_total += $subtotal;
                                                                                                ?>
                                                                                            </center>
                                                                                        </td>

                                                                                    </tr>


                                                                                    <?php
                                                                                }


                                                                                ?>


                                                                                <tr>
                                                                                    <th colspan="3" style="background-color: #b2c8ff; text-align: right ">Total</th>
                                                                                    <th>
                                                                                        <center>
                                                                                            <?php echo $cantidad_total;?>

                                                                                        </center>
                                                                                    </th>
                                                                                    <th><center> <?php echo $precio_unitario_total;?></center></th>
                                                                                    <th style="background-color: #9FEE00"><center><?php echo $precio_total;?></center></th>
                                                                                </tr>
                                                                                </tbody>

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#Modal_cliente<?php echo $id_venta;?>">
                                                            <i class="fa fa-user"></i> <?php echo $ventas_dato['nombre_cliente'];?>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modal_cliente<?php echo $id_venta;?>">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #30ae4e; color:white">
                                                                        <h4 class="modal-title">Cliente </h4>
                                                                        <div style="width: 10px"></div>

                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <?php
                                                                    $sql_clientes = "SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente'";

                                                                    $squery_clientes = $pdo->prepare($sql_clientes);
                                                                    $squery_clientes->execute(); // Aquí corregido
                                                                    $clientes_datos = $squery_clientes->fetchAll(PDO::FETCH_ASSOC);

                                                                    foreach ($clientes_datos as $clientes_dato) {
                                                                        $nombre_cliente = $clientes_dato['nombre_cliente'];
                                                                        $nit_ci_cliente = $clientes_dato['nit_ci_cliente'];
                                                                        $celular_cliente = $clientes_dato['celular_cliente'];
                                                                        $email_cliente = $clientes_dato['email_cliente'];

                                                                    }
                                                                    ?>
                                                                    <div class="modal-body">

                                                                            <div class="form-group">
                                                                                <label for="">Nombre del cliente</label>
                                                                                <input name="nombre_cliente" value="<?php echo $nombre_cliente; ?>" type="text" class="form-control" DISABLED>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Nit</label>
                                                                                <input  name="nit_ci_cliente" value="<?php echo $nit_ci_cliente; ?>" type="text" class="form-control" DISABLED>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Celular del cliente</label>
                                                                                <input name="celular_cliente" value="<?php echo $celular_cliente; ?>" type="number" class="form-control" DISABLED>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Email del cliente</label>
                                                                                <input name="email_cliente" type="email" value="<?php echo $email_cliente; ?>" class="form-control" DISABLED>
                                                                            </div>
                                                                            <hr>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center><button disabled class="btn btn-primary"><?php echo "$ ".$ventas_dato['total_pagado'];?></button></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="show.php?id_venta=<?php echo $id_venta; ?>" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                                                        <a href="delete.php?id_venta=<?php echo $id_venta; ?>&nro_venta=<?php echo $nro_venta;?>" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar</a>
                                                        <a href="factura.php?id_venta=<?php echo $id_venta; ?>&nro_venta=<?php echo $nro_venta;?>" class="btn btn-success"><i class="fa fa-print"></i> Imprimir</a>
                                                    </center>
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