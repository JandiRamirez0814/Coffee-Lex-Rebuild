<?php
global $pdo, $productos_datos, $categorias_datos, $URL, $id_usuario, $proveedores_datos, $compras_datos;
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/lista_productos.php');
include ('../app/controllers/proveedores/lista_proveedores.php');
include ('../app/controllers/compras/lista_compras.php');
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
                <div class="col-md-9">
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
                                                                            <button class="btn btn-info btn-seleccionar" data-id="<?php echo $id_producto; ?>">
                                                                                Seleccionar
                                                                            </button>
                                                                        </td>
                                                                        <td id="id_producto<?php echo $id_producto; ?>"><?php echo $productos_dato['id_producto']; ?></td>
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
                                                        <input type="text" id="id_producto" hidden="">
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
                                                        <input type="number" name="stock" id="stock" class="form-control" disabled style="background-color: #baff0c">
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
                                    <div style="display:flex">
                                        <h5>Datos del proveedor</h5>
                                        <div style="width: 20px"></div>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-buscar_proveedor">
                                            <i class="fa fa-search"></i> Buscar Proveedor
                                        </button>

                                        <!-- Modal buscar proveedor -->
                                        <div class="modal fade" id="modal-buscar_proveedor">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #043973; color:white">
                                                        <h4 class="modal-title">Buscar proveedor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table table-responsive">
                                                            <table id="example2" class="table table-bordered table-striped table-sm">
                                                                <thead>
                                                                <tr>
                                                                    <th><center>Nro</center></th>
                                                                    <th><center>Seleccionar</center></th>
                                                                    <th><center>Nombre</center></th>
                                                                    <th><center>Celular</center></th>
                                                                    <th><center>Telefono</center></th>
                                                                    <th><center>Empresa</center></th>
                                                                    <th><center>Email</center></th>
                                                                    <th><center>Dirección</center></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $contador = 0;
                                                                foreach ($proveedores_datos as $proveedores_dato) {
                                                                    $id_proveedor = $proveedores_dato['id_proveedor'];
                                                                    $nombre_proveedor = $proveedores_dato['nombre_proveedor'];
                                                                    ?>
                                                                    <tr>
                                                                        <td><center><?php echo ++$contador; ?></center></td>
                                                                        <td>
                                                                            <button class="btn btn-info" id="btn_seleccionar_proveedor<?php echo $id_proveedor; ?>">
                                                                                Seleccionar
                                                                            </button>
                                                                        </td>
                                                                        <td id="id_proveedor<?php echo $id_proveedor; ?>"><?php echo $id_proveedor; ?></td>
                                                                        <td id="nombre_proveedor<?php echo $id_proveedor; ?>"><?php echo $nombre_proveedor; ?></td>
                                                                        <td id="celular<?php echo $id_proveedor; ?>"><?php echo $proveedores_dato['celular']; ?></td>
                                                                        <td id="telefono<?php echo $id_proveedor; ?>"><?php echo $proveedores_dato['telefono']; ?></td>
                                                                        <td id="empresa<?php echo $id_proveedor; ?>"><?php echo $proveedores_dato['empresa']; ?></td>
                                                                        <td id="email<?php echo $id_proveedor; ?>"><?php echo $proveedores_dato['email']; ?></td>
                                                                        <td id="direccion<?php echo $id_proveedor; ?>"><?php echo $proveedores_dato['direccion']; ?></td>
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
                                    <div class="row" style="font-size: 12px">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_proveedor" hidden>
                                                        <label for="">Nombre </label>
                                                        <input type="text" id="nombre_proveedor" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Celular</label>
                                                        <input type="number" id="celular" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Teléfono</label>
                                                        <input type="number" id="telefono" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Empresa</label>
                                                        <input type="text" id="empresa" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" id="email" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Dirección</label>
                                                        <textarea id="direccion" cols="30" rows="3" class="form-control" disabled></textarea>
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
                                                <?php
                                                $contador_de_compras = 1;
                                                foreach ($compras_datos as $compras_dato) {
                                                    $contador_de_compras +=1;

                                                }
                                                ?>
                                                <label for="">Número de la compra</label>
                                                <input type="text" value="<?php echo $contador_de_compras; ?>" style="text-align: center" class="form-control" disabled>
                                                <input type="text" value="<?php echo $contador_de_compras; ?>" id="nro_compra" hidden >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Fecha de la compra</label>
                                                <input type="date" class="form-control" id="fecha_compra">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Comprobante de la compra</label>
                                                <input type="tetx" class="form-control" id="comprobante">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Valor de la compra</label>
                                                <input type="number" class="form-control" id="valor_compra">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Stock actual</label>
                                                <input type="number"  style="background-color: #baff0c; text-align: center" id="Stock_actual" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Stock Total</label>
                                                <input type="number"  style=" text-align: center" id="Stock_total" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Cantidad de la compra</label>
                                                <input type="number" id="cantidad_compra" style="text-align: center" class="form-control">
                                            </div>
                                            <script>
                                                $('#cantidad_compra').keyup(function (){

                                                    var Stock_actual =$('#Stock_actual').val();
                                                    var stock_compra =$('#cantidad_compra').val();
                                                    var total = parseInt(Stock_actual) + parseInt(stock_compra) ;
                                                    $('#Stock_total').val(total);
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="tetx" value="<?php /** @var TYPE_NAME $email_sesion */
                                                echo $email_sesion; ?>" class="form-control" disabled>
                                            </div>
                                        </div>


                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" id="btn_guardar_compra">Guardar Compra</button>
                                        </div>

                                    </div>
                                    <script>
                                        $('#btn_guardar_compra').click(function () {

                                            var id_producto = $('#id_producto').val();
                                            var nro_compra = $('#nro_compra').val();
                                            var fecha_compra = $('#fecha_compra').val();
                                            var id_proveedor = $('#id_proveedor').val();
                                            var comprobante = $('#comprobante').val();
                                            var id_usuario = '<?php /** @var TYPE_NAME $id_usuario_sesion */
                                                echo $id_usuario_sesion;?>'
                                            var valor_compra = $('#valor_compra').val();
                                            var cantidad_compra = $('#cantidad_compra').val();
                                            var Stock_total = $('#Stock_total').val();


                                            if(id_producto == ""){
                                                $('#id_producto').focus();
                                                alert("Debe llenar todos los campos");
                                            }else if(fecha_compra == "") {
                                                $('#fecha_compra').focus();
                                                alert("Debe llenar todos los campos");
                                            }else if(comprobante == ""){
                                                $('#comprobante').focus();
                                                alert("Debe llenar todos los campos");
                                            }else if(valor_compra == ""){
                                                $('#valor_compra').focus();
                                                alert("Debe llenar todos los campos");
                                            }else if(cantidad_compra == ""){
                                                $('#cantidad_compra').focus();
                                                alert("Debe llenar todos los campos");
                                            }
                                            else {
                                                var url = "../app/controllers/compras/create.php";
                                                $.get(url, {
                                                    id_producto: id_producto,
                                                    nro_compra: nro_compra,
                                                    fecha_compra: fecha_compra,
                                                    id_proveedor: id_proveedor,
                                                    comprobante: comprobante,
                                                    id_usuario: id_usuario,
                                                    valor_compra: valor_compra,
                                                    cantidad_compra: cantidad_compra,
                                                    Stock_total: Stock_total
                                                },function (datos) {
                                                    $('#respuesta_create').html(datos);
                                                });
                                            }

                                        });
                                    </script>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div id="respuesta_create"></div>


                </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php include('../layout/parte2.php'); ?>
<script>
    $(document).ready(function() {
        // Delegación de eventos para seleccionar un producto
        $(document).on("click", ".btn-seleccionar", function() {
            const idProducto = $(this).data("id");
            if (idProducto) {
                // Asignar valores a los campos correspondientes
                $("#id_producto").val($(`#id_producto${idProducto}`).text().trim());
                $("#codigo").val($(`#codigo${idProducto}`).text().trim());
                $("#nombre_producto").val($(`#nombre_producto${idProducto}`).text().trim());
                $("#categoria").val($(`#categoria${idProducto}`).text().trim());
                $("#usuario_producto").val($(`#usuario_producto${idProducto}`).text().trim());
                $("#descripcion_producto").val($(`#descripcion_producto${idProducto}`).text().trim());
                $("#stock").val($(`#stock${idProducto}`).text().trim());
                $("#Stock_actual").val($(`#stock${idProducto}`).text().trim());
                $("#stock_minimo").val($(`#stock_minimo${idProducto}`).text().trim());
                $("#stock_maximo").val($(`#stock_maximo${idProducto}`).text().trim());
                $("#precio_compra").val($(`#precio_compra${idProducto}`).text().trim());
                $("#precio_venta").val($(`#precio_venta${idProducto}`).text().trim());
                $("#fecha_ingreso").val($(`#fecha_ingreso${idProducto}`).text().trim());
                $("#imagen_producto").attr("src", $(`#imagen${idProducto}`).attr("src").trim());
                $("#modal-buscar_producto").modal("hide");
            } else {
                alert("Error: No se pudo seleccionar el producto. Inténtelo de nuevo.");
            }
        });
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
    $(function () {
        $("#example2").DataTable({
            "pageLength": 5,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 proveedores",
                "infoFiltered": "(filtrado de _MAX_ total proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ proveedores",
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
