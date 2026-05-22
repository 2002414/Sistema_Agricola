<?php

include("../../Config/conexion.php");

$queryProductos = "SELECT * FROM productos ORDER BY nombre ASC";
$resultadoProductos = pg_query($conn, $queryProductos);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Crear Pedido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-3"
>

    ← Volver Dashboard

</a>

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Nuevo Pedido
            </h2>

            <form action="Guardar_Pedido.php"
                  method="POST">

                <div class="mb-3">

                    <label>Cliente</label>

                    <input
                        type="text"
                        name="cliente"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Producto</label>

                    <select
                        name="id_producto"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione producto
                        </option>

                        <?php
                        while($producto = pg_fetch_assoc($resultadoProductos)){
                        ?>

                            <option
                                value="<?php echo $producto['id_producto']; ?>">

                                <?php echo $producto['nombre']; ?>

                            </option>

                        <?php
                        }
                        ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Cantidad</label>

                    <input
                        type="number"
                        name="cantidad"
                        class="form-control"
                        required
                    >

                </div>

                <button class="btn btn-success w-100">

                    Guardar Pedido

                </button>

                <a href="Listar_Pedido.php"
                   class="btn btn-secondary">

                    Ver Pedidos

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>