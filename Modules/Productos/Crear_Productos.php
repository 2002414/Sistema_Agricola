<?php
include("../../Config/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Crear Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                Nuevo Producto
            </h2>

            <form action="Guardar_Productos.php"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="mb-3">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Descripción</label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                    ></textarea>

                </div>

                <div class="mb-3">

                    <label>Precio</label>

                    <input
                        type="number"
                        step="0.01"
                        name="precio"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Stock</label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Categoría</label>

                    <input
                        type="text"
                        name="categoria"
                        class="form-control"
                    >

                </div>

                <div class="mb-3">

                    <label>Imagen</label>

                    <input
                        type="file"
                        name="imagen"
                        class="form-control"
                    >

                </div>

                <button class="btn btn-success w-100">
                    Guardar Producto
                </button>

                <a href="Listar_Productos.php"
                   class="btn btn-secondary">

                    Ver Productos

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>