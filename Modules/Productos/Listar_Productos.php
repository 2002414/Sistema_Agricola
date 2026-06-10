<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   CONSULTAR PRODUCTOS
========================= */

if($_SESSION['rol'] == 'productor'){

    $query = "
        SELECT
            p.*,
            u.nombre AS productor
        FROM productos p
        LEFT JOIN usuarios u
            ON p.id_usuario = u.id_usuario
        WHERE p.id_usuario = $1
        ORDER BY p.id_producto DESC
    ";

    $resultado = pg_query_params(
        $conn,
        $query,
        array($_SESSION['id_usuario'])
    );

}else{

    $query = "
        SELECT
            p.*,
            u.nombre AS productor
        FROM productos p
        LEFT JOIN usuarios u
            ON p.id_usuario = u.id_usuario
        ORDER BY p.id_producto DESC
    ";

    $resultado = pg_query(
        $conn,
        $query
    );

}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

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

    border:none;

    border-radius:20px;

    transition:.3s;

    height:100%;

    display:flex;

    flex-direction:column;

}

.card-body{

    display:block;

    flex-direction:column;

    flex:1;

}

.BotonesFinal{

    margin-top:20px;

}

.CardProducto:hover{

    transform: translateY(-10px);

    box-shadow: 0 15px 30px rgba(0,0,0,0.2);

}

.ImagenProducto{

    height: 300px;

    object-fit: cover;

    border-top-left-radius: 20px;

    border-top-right-radius: 20px;

}

.Titulo{

    color: #198754;

    font-weight: bold;

}

.row{

    align-items:stretch;

}

.CardProducto{

    min-height:650px;

}

.card-body{

    flex:1;

}

.container{

    max-width: 1400px;

}

.row{

    display:flex;

    flex-wrap:wrap;

}

.col-lg-4{

    display:flex;

}

.CardProducto{

    width:100%;

}

</style>

</head>

<body>

<div class="container-fluid px-5 mt-5">

<!-- VOLVER -->

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-4"
>

    ← Volver

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

<div class="col-lg-4 col-md-6 mb-4 d-flex">

<div class="card CardProducto shadow w-100">

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

<?php

if($producto['stock'] > 0){

    echo "Stock: ".$producto['stock'];

}else{

    echo "<span class='text-danger fw-bold'>Stock: Agotado</span>";

}

?>

</p>

<p>

<strong>

<i class="fa-solid fa-user"></i>

Productor:

</strong>

<br>

<?php echo $producto['productor']; ?>

</p>

<!-- =========================
     COMPRADOR
========================= -->

<?php
if($_SESSION['rol'] == 'comprador'){
?>

<div class="mt-auto">

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

<label class="fw-bold">

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

<label class="fw-bold mt-3">

Dirección de entrega

</label>

<textarea

    name="direccion"

    class="form-control"

    rows="3"

    placeholder="Ingrese la dirección de entrega"

    required

></textarea>

<div class="BotonesFinal">

<div class="row mt-3">

<div class="col-6">

<button
    type="submit"
    class="btn btn-success w-100"
>

<i class="fa-solid fa-cart-shopping"></i>

Hacer Pedido

</button>

</div>

<div class="col-6">

<a

href="../Mensajes/Chat_Producto.php?id=<?php echo $producto['id_usuario']; ?>"

class="btn btn-primary w-100"

>

<i class="fa-solid fa-comments"></i>

Mensaje

</a>

</div>

</div>

</div>

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
