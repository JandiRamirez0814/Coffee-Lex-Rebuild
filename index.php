<?php
global $pdo, $usuarios_datos, $URL, $roles_datos, $categorias_datos, $productos_datos, $proveedores_datos, $compras_datos, $ventas_datos, $clientes_datos;
include ('app/config.php');
include ('layout/sesion.php');
include ('layout/parte1.php');
include ('app/controllers/usuarios/lista_usuarios.php');
include ('app/controllers/roles/lista_roles.php');
include ('app/controllers/categorias/lista_categorias.php');
include ('app/controllers/almacen/lista_productos.php');
include ('app/controllers/proveedores/lista_proveedores.php');
include ('app/controllers/compras/lista_compras.php');
include ('app/controllers/ventas/lista_ventas.php');
include ('app/controllers/clientes/lista_clientes.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Bienvenido - <?php /** @var TYPE_NAME $rol_sesion */
                        echo $rol_sesion ?> </h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            contenido del sistema

            <br><br>
            <div class="row">


                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $contador_de_user = 0;
                            foreach ($usuarios_datos as $usuarios_dato) {
                                $contador_de_user += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_user; ?> </h3>

                            <p>Usuarios registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/usuarios/create.php">
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/usuarios" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $contador_de_rol = 0;
                            foreach ($roles_datos as $roles_dato) {
                                $contador_de_rol += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_rol; ?> </h3>

                            <p>Roles registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/roles/create.php">
                            <div class="icon">
                                <i class="fas fa-address-card "></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/roles" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $contador_de_categorias = 0;
                            foreach ($categorias_datos as $categorias_dato) {
                                $contador_de_categorias += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_rol; ?> </h3>

                            <p>Categorias registradas</p>
                        </div>
                        <a href="<?php echo $URL;?>/categorias">
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/categorias" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            $contador_de_productos = 0;
                            foreach ($productos_datos as $productos_dato) {
                                $contador_de_productos += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_productos; ?> </h3>

                            <p>Productos registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/almacen/create.php">
                            <div class="icon">
                                <i class="fas fa-list"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/almacen" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <?php
                            $contador_de_proveedores = 0;
                            foreach ($proveedores_datos as $proveedores_dato) {
                                $contador_de_proveedores += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_proveedores; ?> </h3>

                            <p>Proveedores registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/proveedores">
                            <div class="icon">
                                <i class="fas fa-car"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/proveedores" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $contador_de_compras = 0;
                            foreach ($compras_datos as $compra_dato) {
                                $contador_de_compras += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_compras; ?> </h3>

                            <p>Compras registradas</p>
                        </div>
                        <a href="<?php echo $URL;?>/compras">
                            <div class="icon">
                                <i class="fas fa-cart-plus"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/compras" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-gradient-secondary">
                        <div class="inner">
                            <?php
                            $contador_de_ventas = 0;
                            foreach ($ventas_datos as $ventas_dato) {
                                $contador_de_ventas += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_ventas; ?> </h3>

                            <p>Ventas registradas</p>
                        </div>
                        <a href="<?php echo $URL;?>/ventas">
                            <div class="icon">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/ventas" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-fuchsia">
                        <div class="inner">
                            <?php
                            $contador_de_clientes = 0;
                            foreach ($clientes_datos as $clientes_dato) {
                                $contador_de_clientes += 1;
                            }
                            ?>
                            <h3> <?php echo $contador_de_clientes; ?> </h3>

                            <p>Clientes registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/clientes">
                            <div class="icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/clientes" class="small-box-footer">
                            Mas información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include ('layout/parte2.php');
?>

