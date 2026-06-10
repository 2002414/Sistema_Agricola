<?php

session_start();

include("../../Config/conexion.php");

$id = $_GET['id'];

$query = "SELECT * FROM productos
          WHERE id_producto = $1";

$resultado = pg_query_params(
    $conn,
    $query,
    array($id)
);

pg_query_params(
    $conn,
    "
    INSERT INTO historial_actividades(
        id_usuario,
        usuario,
        accion
    )
    VALUES($1,$2,$3)
    ",
    array(
        $_SESSION['id_usuario'],
        $_SESSION['usuario'],
        'Agregó un producto'
    )
);

$producto = pg_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

    <meta charset="UTF-8">

    <title>Editar Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-light">

<div class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-3"
>

    ← Volver

</a>

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Editar Producto
            </h2>

            <form action="Actualizar_Productos.php" method="POST">

                <input
                    type="hidden"
                    name="id_producto"
                    value="<?php echo $producto['id_producto']; ?>"
                >

                <div class="mb-3">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="<?php echo $producto['nombre']; ?>"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Descripción</label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                    ><?php echo $producto['descripcion']; ?></textarea>

                </div>

                <div class="mb-3">

                    <label>Precio</label>

                    <input
                        type="number"
                        step="0.01"
                        name="precio"
                        class="form-control"
                        value="<?php echo $producto['precio']; ?>"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Stock</label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="<?php echo $producto['stock']; ?>"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Categoría</label>

                    <input
                        type="text"
                        name="categoria"
                        class="form-control"
                        value="<?php echo $producto['categoria']; ?>"
                    >

                </div>

                <button class="btn btn-primary">
                    Actualizar Producto
                </button>

                <a href="Listar_Productos.php"
                   class="btn btn-secondary">

                    Volver

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>
