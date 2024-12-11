<?php
global $nro_venta, $contador_de_ventas;
$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];
global $pdo, $productos_datos, $categorias_datos, $URL, $id_usuario, $proveedores_datos, $compras_datos, $ventas_datos, $clientes_datos;
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/ventas/cargar_venta.php');
include('../app/controllers/clientes/cargar_cliente.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Detalle de la Venta nro <?php echo $nro_venta;?> ¿Esta seguro de borrar la venta?</h1>
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
                    <div class="card card-outline card-danger">
                        <div class="card-header">

                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i>  Venta Nro
                                <input type="text" style="text-align: center" value="<?php echo $nro_venta;?>" >
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
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
                                                <input type="text" value="<?php echo $carrito_dato['id_productos']; ?>" id="id_productos<?php echo $contador_de_carrito; ?>" hidden >
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



                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Card: Detalle de la compra -->
                <div class="col-md-9">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-users"></i>  Datos del cliente</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <?php
                        foreach ($clientes_datos as $clientes_dato){
                            $nombre_cliente = $clientes_dato['nombre_cliente'];
                            $nit_ci_cliente = $clientes_dato['nit_ci_cliente'];
                            $celular_cliente = $clientes_dato['celular_cliente'];
                            $email_cliente = $clientes_dato['email_cliente'];
                        }
                        ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="id_cliente" hidden>
                                        <label for="">Nombre del cliente</label>
                                        <input type="text" value="<?php echo $nombre_cliente;?>" class="form-control" id="nombre_cliente" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nit</label>
                                        <input type="text" value="<?php echo $nit_ci_cliente;?>" class="form-control" id="nit_ci_cliente" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Celular</label>
                                        <input type="text" value="<?php echo $celular_cliente;?>" class="form-control" id="celular_cliente" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" value="<?php echo $email_cliente;?>" class="form-control" id="email_cliente" disabled>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-outline card-danger">
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
                            <hr>
                            <div class="form-group">
                                <button id="btn_borrar_venta" class="btn btn-danger btn-block">Borrar venta</button>
                                <div id="btn_borrar_venta"></div>
                            </div>
                            <script>
                                $('#btn_borrar_venta').click(function () {
                                    var id_venta = '<?php echo addslashes($id_venta_get); ?>';
                                    var nro_venta = '<?php echo addslashes($nro_venta_get); ?>';// Escapamos posibles comillas

                                    actualizar_stock();
                                    borrar_venta();

                                    function actualizar_stock() {
                                        var n = '<?php echo $contador_de_carrito; ?>'; // Número de productos en el carrito

                                        for (var i = 1; i <= n; i++) {

                                            var a = '#stock_de_inventario' + i; // Selector dinámico para stock
                                            var stock_de_inventario = parseFloat($(a).val()); // Obtener valor de stock (asegurándonos de que sea un número)

                                            var b = '#cantidad_carrito' + i; // Selector dinámico para cantidad
                                            var cantidad_carrito;

                                            if ($(b).length > 0) { // Verificamos si el campo existe
                                                cantidad_carrito = parseFloat($(b).text()); // Obtener texto de cantidad
                                            } else {
                                                console.log("No se encontró el campo de cantidad para el producto " + i);
                                                continue; // Continuamos con el siguiente producto si no encontramos el campo
                                            }

                                            var c = '#id_productos' + i; // Selector dinámico para id_producto
                                            var id_productos = $(c).val(); // Obtener id del producto

                                            // Validar los valores
                                            if (isNaN(stock_de_inventario) || isNaN(cantidad_carrito) || !id_productos) {
                                                alert(`Error en los datos del producto ${i}: stock=${stock_de_inventario}, cantidad=${cantidad_carrito}, id_producto=${id_productos}`);
                                                continue;
                                            }

                                            // Calcula el nuevo stock
                                            var stock_calculado = stock_de_inventario + cantidad_carrito;

                                            // Mostrar los datos para depuración
                                            console.log(`Producto ${i}: ID=${id_productos}, Stock Inicial=${stock_de_inventario}, Cantidad=${cantidad_carrito}, Stock Calculado=${stock_calculado}`);

                                            // Enviar los datos al servidor para actualizar el stock
                                            var url2 = "../app/controllers/ventas/actualizar_stock.php";
                                            $.get(url2, {
                                                id_productos: id_productos,
                                                stock_calculado: stock_calculado
                                            })
                                                .done(function (datos) {
                                                    console.log(`Respuesta del servidor para producto ${id_productos}: ${datos}`);
                                                })
                                                .fail(function () {
                                                    alert(`Error al actualizar el producto ${id_productos}`);
                                                });
                                        }
                                    }
                                    function borrar_venta() {
                                        var url = "../app/controllers/ventas/borrar_venta.php";
                                        $.get(url, { id_venta: id_venta,nro_venta: nro_venta }, function (datos) {
                                            $('#btn_borrar_venta').html(datos); // Mostrar respuesta del servidor
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
