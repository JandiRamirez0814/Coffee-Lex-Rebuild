<?php
global $pdo, $productos_datos, $categorias_datos, $URL, $id_usuario;
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/lista_productos.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de una nueva compra</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Registra los campos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="display:flex">
                                <h5>Datos del producto</h5>
                                <div style="width: 20px"></div>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-buscar_producto">
                                    <i class="fa fa-search"></i> Buscar Producto
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal-buscar_producto">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #043973; color:white">
                                                <h4 class="modal-title">Buscar producto</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table table-responsive">
                                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th><center>Nro</center></th>
                                                            <th><center>Seleccionar</center></th>
                                                            <th><center>Código</center></th>
                                                            <th><center>Categoría</center></th>
                                                            <th><center>Imagen</center></th>
                                                            <th><center>Nombre</center></th>
                                                            <th><center>Descripción</center></th>
                                                            <th><center>Stock</center></th>
                                                            <th><center>Stock Mínimo</center></th>
                                                            <th><center>Stock Máximo</center></th>
                                                            <th><center>Precio compra</center></th>
                                                            <th><center>Precio venta</center></th>
                                                            <th><center>Fecha compra</center></th>
                                                            <th><center>Usuario</center></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $contador = 0;
                                                        foreach ($productos_datos as $productos_dato) {
                                                            $id_producto = $productos_dato['id_producto'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$contador; ?></td>
                                                                <td>
                                                                    <button class="btn btn-info" id="btn_seleccionar<?php echo $id_producto; ?>">
                                                                        Seleccionar
                                                                    </button>
                                                                </td>
                                                                <td id="codigo<?php echo $id_producto; ?>"><?php echo $productos_dato['codigo']; ?></td>
                                                                <td id="categoria<?php echo $id_producto; ?>"><?php echo $productos_dato['nombre_categoria']; ?></td>
                                                                <td><img id="imagen<?php echo $id_producto; ?>" src="<?php echo $URL . "/almacen/img_productos/" . $productos_dato['imagen']; ?>" width="50px" alt=""></td>
                                                                <td id="nombre_producto<?php echo $id_producto; ?>"><?php echo $productos_dato['nombre']; ?></td>
                                                                <td id="descripcion_producto<?php echo $id_producto; ?>"><?php echo $productos_dato['descripcion']; ?></td>
                                                                <td id="stock<?php echo $id_producto; ?>"><?php echo $productos_dato['stock']; ?></td>
                                                                <td id="stock_minimo<?php echo $id_producto; ?>"><?php echo $productos_dato['stock_minimo']; ?></td>
                                                                <td id="stock_maximo<?php echo $id_producto; ?>"><?php echo $productos_dato['stock_maximo']; ?></td>
                                                                <td id="precio_compra<?php echo $id_producto; ?>"><?php echo $productos_dato['precio_compra']; ?></td>
                                                                <td id="precio_venta<?php echo $id_producto; ?>"><?php echo $productos_dato['precio_venta']; ?></td>
                                                                <td id="fecha_ingreso<?php echo $id_producto; ?>"><?php echo $productos_dato['fecha_ingreso']; ?></td>
                                                                <td id="usuario_producto<?php echo $id_producto; ?>"><?php echo $productos_dato['email']; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="font-size: 10px">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="codigo">Código:</label>
                                                <input type="text" class="form-control" id="codigo" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre_producto">Nombre:</label>
                                                <input type="text" id="nombre_producto" name="nombre" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="categoria">Categoría:</label>
                                                <input type="text" class="form-control" id="categoria" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="usuario_producto">Usuario:</label>
                                                <input type="text" class="form-control" id="usuario_producto" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="descripcion_producto">Descripción:</label>
                                                <textarea name="descripcion" id="descripcion_producto" cols="30" rows="2" class="form-control" disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock">Stock:</label>
                                                <input type="number" name="stock" id="stock" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock_minimo">Stock mínimo:</label>
                                                <input type="number" name="stock_minimo" id="stock_minimo" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock_maximo">Stock máximo:</label>
                                                <input type="number" name="stock_maximo" id="stock_maximo" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="precio_compra">Precio Compra:</label>
                                                <input type="number" name="precio_compra" id="precio_compra" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="precio_venta">Precio Venta:</label>
                                                <input type="number" name="precio_venta" id="precio_venta" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                                <input type="text" class="form-control" id="fecha_ingreso" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h5>Imagen del producto</h5>
                                    <img id="imagen_producto" src="" alt="Imagen del producto" style="max-width: 50%; max-height: 200px;">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Número de la compra</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha de la compra</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php include('../layout/parte2.php'); ?>
<script>
    $(document).ready(function() {
        // Funcionalidad para seleccionar producto
        <?php foreach ($productos_datos as $productos_dato) { ?>
        $("#btn_seleccionar<?php echo $productos_dato['id_producto']; ?>").on("click", function() {
            $("#codigo").val($("#codigo<?php echo $productos_dato['id_producto']; ?>").text());
            $("#nombre_producto").val($("#nombre_producto<?php echo $productos_dato['id_producto']; ?>").text());
            $("#categoria").val($("#categoria<?php echo $productos_dato['id_producto']; ?>").text());
            $("#usuario_producto").val($("#usuario_producto<?php echo $productos_dato['id_producto']; ?>").text());
            $("#descripcion_producto").val($("#descripcion_producto<?php echo $productos_dato['id_producto']; ?>").text());
            $("#stock").val($("#stock<?php echo $productos_dato['id_producto']; ?>").text());
            $("#stock_minimo").val($("#stock_minimo<?php echo $productos_dato['id_producto']; ?>").text());
            $("#stock_maximo").val($("#stock_maximo<?php echo $productos_dato['id_producto']; ?>").text());
            $("#precio_compra").val($("#precio_compra<?php echo $productos_dato['id_producto']; ?>").text());
            $("#precio_venta").val($("#precio_venta<?php echo $productos_dato['id_producto']; ?>").text());
            $("#fecha_ingreso").val($("#fecha_ingreso<?php echo $productos_dato['id_producto']; ?>").text());
            $("#imagen_producto").attr("src", $("#imagen<?php echo $productos_dato['id_producto']; ?>").attr("src"));
            $("#modal-buscar_producto").modal("hide");
        });
        <?php } ?>



    });
</script>


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

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
