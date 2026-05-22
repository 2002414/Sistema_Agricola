<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   CONSULTAR PRODUCTOS
========================= */

$query = "
    SELECT *
    FROM productos
    ORDER BY id_producto DESC
";

$resultado = pg_query(
    $conn,
    $query
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Productos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background: #f4f6f9;

}

.CardProducto{

    border: none;

    border-radius: 20px;

    transition: 0.3s;

}

.CardProducto:hover{

    transform: translateY(-10px);

    box-shadow: 0 15px 30px rgba(0,0,0,0.2);

}

.ImagenProducto{

    height: 250px;

    object-fit: cover;

    border-top-left-radius: 20px;

    border-top-right-radius: 20px;

}

.Titulo{

    color: #198754;

    font-weight: bold;

}

</style>

</head>

<body>

<div class="container mt-5">

<!-- VOLVER -->

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-4"
>

    ← Volver Dashboard

</a>

<div class="d-flex justify-content-between align-items-center mb-4">

<h1 class="Titulo">

    Productos Agrícolas

</h1>

<!-- =========================
     SOLO PRODUCTOR
========================= -->

<?php
if($_SESSION['rol'] == 'productor'){
?>

<a
    href="Crear_Productos.php"
    class="btn btn-success"
>

    Nuevo Producto

</a>

<?php
}
?>

</div>

<div class="row">

<?php
while($producto = pg_fetch_assoc($resultado)){
?>

<div class="col-md-4 mb-4">

<div class="card CardProducto shadow">

<!-- IMAGEN -->

<img
    src="../../Assets/img/<?php echo $producto['imagen']; ?>"
    class="ImagenProducto"
>

<div class="card-body">

<h3>

<?php
echo $producto['nombre'];
?>

</h3>

<p>

<?php
echo $producto['descripcion'];
?>

</p>

<h4 class="text-success">

Q.
<?php
echo $producto['precio'];
?>

</h4>

<p>

Stock:
<?php
echo $producto['stock'];
?>

</p>

<!-- =========================
     COMPRADOR
========================= -->

<?php
if($_SESSION['rol'] == 'comprador'){
?>

<button
    class="btn btn-success w-100"
    data-bs-toggle="collapse"
    data-bs-target="#pedido<?php echo $producto['id_producto']; ?>"
>

    Hacer Pedido

</button>

<div
    class="collapse mt-3"
    id="pedido<?php echo $producto['id_producto']; ?>"
>

<form
    action="../Pedidos/Guardar_Pedido.php"
    method="POST"
>

<input
    type="hidden"
    name="id_producto"
    value="<?php echo $producto['id_producto']; ?>"
>

<input
    type="hidden"
    name="precio"
    value="<?php echo $producto['precio']; ?>"
>

<label>

Cantidad

</label>

<input
    type="number"
    name="cantidad"
    class="form-control"
    min="1"
    max="<?php echo $producto['stock']; ?>"
    required
>

<button
    type="submit"
    class="btn btn-primary w-100 mt-3"
>

    Confirmar Pedido

</button>

</form>

</div>

<?php
}
?>

<!-- =========================
     SOLO PRODUCTOR
========================= -->

<?php
if($_SESSION['rol'] == 'productor'){
?>

<div class="d-flex gap-2 mt-3">

<a
    href="Editar_Productos.php?id=<?php echo $producto['id_producto']; ?>"
    class="btn btn-warning w-50"
>

    Editar

</a>

<a
    href="Eliminar_Productos.php?id=<?php echo $producto['id_producto']; ?>"
    class="btn btn-danger w-50"

    onclick="return confirm(
        '¿Desea eliminar este producto?'
    )"

>

    Eliminar

</a>

</div>

<?php
}
?>

<!-- =========================
     MIEMBRO ASOCIADO
========================= -->

<?php
if($_SESSION['rol'] == 'admin'){
?>

<div class="alert alert-info mt-3 text-center">

    Solo visualización productos

</div>

<?php
}
?>

</div>

</div>

</div>

<?php
}
?>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>