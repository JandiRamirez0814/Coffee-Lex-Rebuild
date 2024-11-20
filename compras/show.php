<?php
global $pdo, $productos_datos, $categorias_datos, $URL, $id_usuario, $proveedores_datos, $compras_datos, $nro_compra, $codigo, $nombre_categoria, $descripcion, $stock, $stock_minimo, $stock_maximo, $fecha_ingreso, $nombre_proveedor, $empresa, $id_compra_get, $fecha_compra, $comprobante, $precio_compra, $cantidad;
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/lista_productos.php');
include ('../app/controllers/proveedores/lista_proveedores.php');
include ('../app/controllers/compras/cargar_compra.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Compra Nro <?php echo $nro_compra;?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Datos de la compra</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" style="font-size: 10px">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_producto" hidden="">
                                                        <label for="codigo">Código:</label>
                                                        <input type="text" class="form-control" value="<?php echo $codigo; ?>" id="codigo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nombre_producto">Nombre:</label>
                                                        <input type="text" id="nombre_producto" value="<?php /** @var TYPE_NAME $nombre_producto */
                                                        echo $nombre_producto; ?>" name="nombre" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="categoria">Categoría:</label>
                                                        <input type="text" class="form-control" value="<?php echo $nombre_categoria; ?>" id="categoria" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="usuario_producto">Usuario:</label>
                                                        <input type="text" class="form-control" value="<?php /** @var TYPE_NAME $nombre_usuarios_producto */
                                                        echo $nombre_usuarios_producto; ?>" id="usuario_producto" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="descripcion_producto" >Descripción:</label>
                                                        <textarea name="descripcion" id="descripcion_producto"  cols="30" rows="2" class="form-control" disabled><?php echo $descripcion; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="stock">Stock:</label>
                                                        <input type="number" name="stock" id="stock" value="<?php echo $stock; ?>" class="form-control" disabled style="background-color: #baff0c">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="stock_minimo">Stock mínimo:</label>
                                                        <input type="number" name="stock_minimo" value="<?php echo $stock_minimo; ?>" id="stock_minimo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="stock_maximo">Stock máximo:</label>
                                                        <input type="number" name="stock_maximo" value="<?php echo $stock_maximo; ?>" id="stock_maximo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="precio_compra">Precio Compra:</label>
                                                        <input type="number" name="precio_compra" value="<?php /** @var TYPE_NAME $precio_compra_producto */
                                                        echo $precio_compra_producto; ?>" id="precio_compra" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="precio_venta">Precio Venta:</label>
                                                        <input type="number" name="precio_venta" value="<?php /** @var TYPE_NAME $precio_venta_producto */
                                                        echo $precio_venta_producto; ?>" id="precio_venta" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                                        <input type="text" class="form-control"  value="<?php echo $fecha_ingreso; ?>" id="fecha_ingreso" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>Imagen del producto</h5>
                                            <img id="imagen_producto" src="<?php /** @var TYPE_NAME $imagen */
                                            echo $URL."/almacen/img_productos/".$imagen;?>" alt="Imagen del producto" style="max-width: 50%; max-height: 200px;">
                                        </div>
                                    </div>
                                    <hr>
                                    <div style="display:flex">
                                        <h5>Datos del proveedor</h5>
                                    </div>
                                    <hr>
                                    <div class="row" style="font-size: 12px">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_proveedor" hidden>
                                                        <label for="">Nombre </label>
                                                            <input type="text" id="nombre_proveedor" value="<?php /** @var TYPE_NAME $nombre_proveedor_tabla */
                                                        echo $nombre_proveedor_tabla; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Celular</label>
                                                        <input type="number" id="celular" value="<?php /** @var TYPE_NAME $celular_proveedor */
                                                        echo $celular_proveedor; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Teléfono</label>
                                                        <input type="number" id="telefono" value="<?php /** @var TYPE_NAME $telefono_proveedor */
                                                        echo $telefono_proveedor; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Empresa</label>
                                                        <input type="text" id="empresa" value="<?php echo $empresa; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" id="email" value="<?php /** @var TYPE_NAME $email_proveedor */
                                                        echo $email_proveedor; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Dirección</label>
                                                        <textarea id="direccion"   cols="30" rows="3" class="form-control" disabled><?php /** @var TYPE_NAME $direccion_proveedor */
                                                            echo $direccion_proveedor; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-md-3">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Detalle de la compra</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label for="">Número de la compra</label>
                                                <input type="text" value="<?php echo $id_compra_get; ?>" style="text-align: center" class="form-control" disabled>
                                                <input type="text" value="<?php echo $id_compra_get; ?>" id="nro_compra" hidden >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Fecha de la compra</label>
                                                <input type="date" class="form-control" value="<?php echo $fecha_compra; ?>" id="fecha_compra" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Comprobante de la compra</label>
                                                <input type="tetx" class="form-control" value="<?php echo $comprobante; ?>" id="comprobante" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Valor de la compra</label>
                                                <input type="number" class="form-control" id="valor_compra" value="<?php echo $precio_compra; ?>" disabled>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Cantidad de la compra</label>
                                                <input type="number" value="<?php echo $cantidad; ?>" id="cantidad_compra" style="text-align: center" class="form-control" disabled>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="tetx" value="<?php /** @var TYPE_NAME $nombre_usuarios_producto */
                                                echo $nombre_usuarios_producto; ?>" class="form-control" disabled>
                                            </div>
                                        </div>


                                    </div>
                                    <hr>

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

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
                    $("#id_producto").val($("#id_producto<?php echo $productos_dato['id_producto']; ?>").text());
                    $("#codigo").val($("#codigo<?php echo $productos_dato['id_producto']; ?>").text());
                    $("#nombre_producto").val($("#nombre_producto<?php echo $productos_dato['id_producto']; ?>").text());
                    $("#categoria").val($("#categoria<?php echo $productos_dato['id_producto']; ?>").text());
                    $("#usuario_producto").val($("#usuario_producto<?php echo $productos_dato['id_producto']; ?>").text());
                    $("#descripcion_producto").val($("#descripcion_producto<?php echo $productos_dato['id_producto']; ?>").text());
                    $("#stock").val($("#stock<?php echo $productos_dato['id_producto']; ?>").text());
                    $("#Stock_actual").val($("#stock<?php echo $productos_dato['id_producto']; ?>").text());// Asignar el valor de Stock_actual a #stock
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
            $(document).ready(function() {
                // Funcionalidad para seleccionar proveedor
                <?php foreach ($proveedores_datos as $proveedores_dato) { ?>
                $("#btn_seleccionar_proveedor<?php echo $proveedores_dato['id_proveedor']; ?>").on("click", function() {
                    // Asignar valores al formulario o campos correspondientes
                    $("#id_proveedor").val($("#id_proveedor<?php echo $proveedores_dato['id_proveedor']; ?>").text());
                    $("#nombre_proveedor").val($("#nombre_proveedor<?php echo $proveedores_dato['id_proveedor']; ?>").text());
                    $("#celular").val($("#celular<?php echo $proveedores_dato['id_proveedor']; ?>").text());
                    $("#telefono").val($("#telefono<?php echo $proveedores_dato['id_proveedor']; ?>").text());
                    $("#empresa").val($("#empresa<?php echo $proveedores_dato['id_proveedor']; ?>").text());
                    $("#email").val($("#email<?php echo $proveedores_dato['id_proveedor']; ?>").text());
                    $("#direccion").val($("#direccion<?php echo $proveedores_dato['id_proveedor']; ?>").text());

                    // Cerrar modal después de seleccionar
                    $("#modal-buscar_proveedor").modal("hide");
                });
                <?php } ?>
            });
        </script>




