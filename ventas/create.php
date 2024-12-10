<?php
global $pdo, $productos_datos, $categorias_datos, $URL, $id_usuario, $proveedores_datos, $compras_datos, $ventas_datos, $clientes_datos;
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/ventas/lista_ventas.php');
include('../app/controllers/almacen/lista_productos.php');
include('../app/controllers/clientes/lista_clientes.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Ventas</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Card: Detalle de la compra -->
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <?php
                            $contador_de_ventas = 0;
                            foreach ($ventas_datos as $ventas_dato) {
                                $contador_de_ventas+= 1;

                            }
                            ?>
                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i>  Venta Nro
                                <input type="text" style="text-align: center" value="<?php echo $contador_de_ventas+1?>" disabled></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <b>Carrito </b>
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
                                                            <td>
                                                                <img id="imagen<?php echo $id_producto; ?>" src="<?php echo $URL . "/almacen/img_productos/" . $productos_dato['imagen']; ?>" width="50px" alt="">
                                                            </td>
                                                            <td id="nombre_producto<?php echo $id_producto; ?>"><?php echo $productos_dato['nombre']; ?></td>
                                                            <td id="descripcion<?php echo $id_producto; ?>"><?php echo $productos_dato['descripcion']; ?></td>
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
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" id="id_producto" hidden="">
                                                            <label for="">Producto</label>
                                                            <input type="text" id="producto" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">descripcion</label>
                                                            <input type="text" id="descripcion" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Cantidad</label>
                                                            <input type="text" id="cantidad" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Precio Unitario</label>
                                                            <input type="text" id="precio_venta" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <button style="float: right" id="guardar_carrito" class="btn btn-primary">Guardar</button>
                                                <div id="respuesta_carrito"></div>
                                                <script>
                                                    $('#guardar_carrito').click(function () {
                                                        var nro_venta = '<?php echo $contador_de_ventas+1; ?>';
                                                        var id_producto = $('#id_producto').val();
                                                        var cantidad = $('#cantidad').val();

                                                        if(id_producto == ""){
                                                            alert("debe llenar los campos");
                                                        }else if(cantidad == ""){
                                                            alert("debe llenar la cantidad del producto");
                                                        }else{
                                                            var url = "../app/controllers/ventas/registrar_carrito.php";
                                                            $.get(url, {
                                                                nro_venta : nro_venta,
                                                                id_producto : id_producto,
                                                                cantidad : cantidad
                                                            },function (datos) {
                                                                $('#respuesta_carrito').html(datos);
                                                            });
                                                        }
                                                    });

                                                </script>
                                                <br><br>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>

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
                                        <th style="background-color: #9db5d5; text-align: center ">Accion</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $contador_de_carrito = 0;
                                    $cantidad_total = 0;
                                    $precio_unitario_total = 0;
                                    $precio_total = 0;
                                    $nro_venta = $contador_de_ventas + 1 ;
                                    $sql_carrito = "SELECT *, pro.nombre as nombre_producto, pro.descripcion as descripcion,
                                    pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto
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
                                                <input type="text" value="<?php echo $carrito_dato['id_producto'];?>" id="id_producto<?php echo $contador_de_carrito;?>"    >
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
                                            <td>
                                                <form action="../app/controllers/ventas/borrar_carrito.php" method="post">
                                                    <input type="text" name="id_carrito" value="<?php echo $id_carrito; ?>" hidden>
                                                   <center> <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button></center>
                                                </form>
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



                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Card: Detalle de la compra -->
                <div class="col-md-9">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-users"></i>  Datos del cliente</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Agregar contenido dinámico aquí -->
                            <b>Cliente </b>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-buscar_cliente">
                                <i class="fa fa-search"></i> Buscar cliente
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-buscar_cliente">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #043973; color:white">
                                            <h4 class="modal-title">Buscar cliente </h4>
                                            <div style="width: 10px"></div>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-agregar_cliente">
                                                <i class="fa fa-users"></i> Agregar cliente
                                            </button>
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
                                                        <th><center>Nombre del cliente</center></th>
                                                        <th><center>nit</center></th>
                                                        <th><center>Celular</center></th>
                                                        <th><center>Email</center></th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $contador_de_clientes = 0;
                                                    foreach ($clientes_datos as $clientes_dato) {
                                                        $id_cliente = $clientes_dato['id_cliente'];
                                                        $contador_de_clientes += 1;
                                                        ?>
                                                        <tr>
                                                            <td><center><?php echo $contador_de_clientes; ?></center></td>
                                                            <td>
                                                                <center><button id="btn_pasar_cliente<?php echo $id_cliente; ?>" class="btn btn-info">Seleccionar</button></center>
                                                                <script>
                                                                    // Usamos el ID dinámico para el botón de selección
                                                                    $('#btn_pasar_cliente<?php echo $id_cliente; ?>').click(function (){
                                                                        var id_cliente = '<?php echo $clientes_dato['id_cliente']; ?>';
                                                                        $('#id_cliente').val(id_cliente);

                                                                        var nombre_cliente = '<?php echo $clientes_dato['nombre_cliente']; ?>';
                                                                        $('#nombre_cliente').val(nombre_cliente);

                                                                        var nit_ci_cliente = '<?php echo $clientes_dato['nit_ci_cliente']; ?>'; // Corregido el campo 'nit_ci_client' a 'nit_ci_cliente'
                                                                        $('#nit_ci_cliente').val(nit_ci_cliente);

                                                                        var celular_cliente = '<?php echo $clientes_dato['celular_cliente']; ?>';
                                                                        $('#celular_cliente').val(celular_cliente);

                                                                        var email_cliente = '<?php echo $clientes_dato['email_cliente']; ?>'; // Corregido el nombre del campo a 'email_cliente'
                                                                        $('#email_cliente').val(email_cliente);
                                                                        $("#modal-buscar_cliente").modal("hide");
                                                                    });

                                                                </script>

                                                            </td>
                                                            <td><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                                            <td><?php echo $clientes_dato['nit_ci_cliente']; ?></td>
                                                            <td><?php echo $clientes_dato['celular_cliente']; ?></td>
                                                            <td><?php echo $clientes_dato['email_cliente']; ?></td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                    </tbody>
                                                </table>


                                            </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                            <br><br>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="id_cliente" hidden>
                                        <label for="">Nombre del cliente</label>
                                        <input type="text" class="form-control" id="nombre_cliente">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nit</label>
                                        <input type="text" class="form-control" id="nit_ci_cliente">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Celular</label>
                                        <input type="text" class="form-control" id="celular_cliente">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" id="email_cliente">
                                    </div>
                                </div>

                            </div>
                    </div>

                </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-cart"></i>  Registar venta</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Agregar contenido dinámico aquí -->
                            <div class="form-group">
                                <label for="">Monto a cancelar</label>
                                <input id="total_a_cancelar" type="text"style="text-align: center;background-color: #9FEE00" class="form-control" value="<?php echo $precio_total;?>" disabled>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Total pagado</label>
                                        <input id="total_cancelado" type="text" class="form-control" >
                                        <script>
                                            $('#total_cancelado').keyup(function () {
                                                var total_a_cancelar = parseFloat($('#total_a_cancelar').val()) || 0;  // Convierte a número, si no es un número, usa 0
                                                var total_cancelado = parseFloat($('#total_cancelado').val()) || 0;   // Lo mismo para el total cancelado

                                                // Asegúrate de que ambas variables sean números antes de operar
                                                var cambio = total_cancelado - total_a_cancelar;

                                                // Actualizar el valor de "cambio"
                                                $('#cambio').val(cambio.toFixed(2));  // Opcional: redondear el cambio a dos decimales
                                            });
                                        </script>

                                    </div>
                                </div>
                                <div class="col-md-6"><div class="form-group">
                                        <label for="">Cambio</label>
                                        <input  id="cambio" type="text" class="form-control" disabled>
                                    </div>
                                </div>


                            </div>
                            <hr>
                            <div class="form-group">
                                <button  id="btn_guardar_venta" class="btn btn-primary btn-block" >Guardar</button>
                                <div id="respuesta_registro_ventas"></div>
                                <script>
                                    $('#btn_guardar_venta').click(function (){
                                        var nro_venta = '<?php echo $contador_de_ventas+1;?>';
                                        var id_cliente  = $('#id_cliente').val();
                                        var total_a_cancelar  = $('#total_a_cancelar').val();

                                        if(id_cliente == ""){
                                            alert("debe seleccionar un cliente")

                                        }else {
                                           // guardar_venta();
                                            actualizar_stock();

                                        }


                                        function actualizar_stock() {
                                            var n = '<?php echo $contador_de_carrito; ?>'; // Total de elementos
                                            for (var i = 1; i <= n; i++) {
                                                var a = '#stock_de_inventario' + i; // Selector dinámico para stock
                                                var stock_de_inventario = $(a).val(); // Obtener valor de stock

                                                var b = '#cantidad_carrito' + i; // Selector dinámico para cantidad
                                                var cantidad_carrito = $(b).text(); // Obtener texto de cantidad

                                                var c = '#id_producto' + i; // Selector dinámico para id_producto
                                                var id_producto = $(c).val(); // Obtener valor del id_producto

                                                // Calcula el stock resultante
                                                var stock_calculado = parseFloat(stock_de_inventario) - parseFloat(cantidad_carrito);

                                                // Muestra la información para cada elemento
                                                alert(
                                                    'Producto: ' + id_producto + '\n' +
                                                    'Stock inicial: ' + stock_de_inventario + '\n' +
                                                    'Cantidad comprada: ' + cantidad_carrito + '\n' +
                                                    'Stock final: ' + stock_calculado
                                                );
                                            }
                                        }



                                        function guardar_venta(){
                                            var url = "../app/controllers/ventas/registro_de_ventas.php";
                                            $.get(url, {
                                                nro_venta : nro_venta,
                                                id_cliente : id_cliente,
                                                total_a_cancelar : total_a_cancelar
                                            },function (datos) {
                                                $('#respuesta_registro_ventas').html(datos);
                                            });
                                        }
                                    });
                                </script>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/parte2.php'); ?>

<script>
    // Función para inicializar DataTables con configuración reutilizable


    $(document).ready(function() {
        $('#example1').DataTable({
            pageLength: 5,  // Número de filas por página
            responsive: true,  // Hacer la tabla responsive
            lengthChange: true,  // Permitir cambiar el número de filas mostradas
            autoWidth: false,  // Desactivar el auto ajuste de las columnas
            language: {
                emptyTable: "No hay información disponible",
                decimal: "",
                info: "Mostrando _START_ a _END_ de _TOTAL_ productos",
                infoEmpty: "Mostrando 0 a 0 de 0 productos",
                infoFiltered: "(filtrado de _MAX_ productos totales)",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_ productos",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscador:",
                zeroRecords: "Sin resultados encontrados",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            },
            dom: 'Bfrtip',  // Configuración para mostrar botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf'  // Los botones de exportación
            ]
        });
    });


    $(document).ready(function() {
        $('#example2').DataTable({
            pageLength: 5,  // Número de filas por página
            responsive: true,  // Hacer la tabla responsive
            lengthChange: true,  // Permitir cambiar el número de filas mostradas
            autoWidth: false,  // Desactivar el auto ajuste de las columnas
            language: {
                emptyTable: "No hay información disponible",
                decimal: "",
                info: "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                infoEmpty: "Mostrando 0 a 0 de 0 clientes",
                infoFiltered: "(filtrado de _MAX_ clientes totales)",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_ clientes",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscador:",
                zeroRecords: "Sin resultados encontrados",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            },
            dom: 'Bfrtip',  // Configuración para botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf'  // Los botones de exportación
            ]
        });
    });


    $(document).on("click", ".btn-seleccionar", function () {
        const idProducto = $(this).data("id");
        if (idProducto) {
            // Asignar valores a los campos del formulario
            $("#id_producto").val($(`#id_producto${idProducto}`).text().trim());
            $("#producto").val($(`#nombre_producto${idProducto}`).text().trim()); // Corregido
            $("#descripcion").val($(`#descripcion${idProducto}`).text().trim()); // Corregido
            $("#precio_venta").val($(`#precio_venta${idProducto}`).text().trim());
            $("#cantidad").focus();
        } else {
            alert("Error: No se pudo seleccionar el producto. Inténtelo de nuevo.");
        }
    });


</script>
<!-- Modal -->
<div class="modal fade" id="modal-agregar_cliente">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #30ae4e; color:white">
                <h4 class="modal-title">Nuevo cliente </h4>
                <div style="width: 10px"></div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/guardar_clientes.php" method="post">
                    <div class="form-group">
                        <label for="">Nombre del cliente</label>
                        <input name="nombre_cliente" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nit</label>
                        <input  name="nit_ci_cliente" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Celular del cliente</label>
                        <input name="celular_cliente" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email del cliente</label>
                        <input name="email_cliente" type="email" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block">Guardar</button>
                    </div>

            </div>
        </div>
    </div>

</div>
