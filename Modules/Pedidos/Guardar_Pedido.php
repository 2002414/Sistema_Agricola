<?php

session_start();

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
$direccion = $_POST['direccion'];

/* =========================
   OBTENER PRODUCTO
========================= */

$queryProducto = "
    SELECT *
    FROM productos
    WHERE id_producto = $1
";

$resultadoProducto = pg_query_params(
    $conn,
    $queryProducto,
    array($id_producto)
);

$producto = pg_fetch_assoc($resultadoProducto);

/* =========================
   VALIDAR PRODUCTO
========================= */

if(!$producto){

    die("Producto no encontrado");

}

/* =========================
   VALIDAR STOCK
========================= */

if($cantidad > $producto['stock']){

?>

<!DOCTYPE html>

<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

<meta charset="UTF-8">

<title>Stock insuficiente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

<div class="alert alert-danger text-center">

<h3>

❌ La cantidad solicitada supera el stock disponible.

</h3>

<br>

<h4>

Stock disponible:

<?php echo $producto['stock']; ?>

</h4>

</div>

<div class="text-center">

<a

href="../Productos/Listar_Productos.php"

class="btn btn-danger"

>

Volver

</a>

</div>

</div>

</body>

</html>

<?php

exit();

}

/* =========================
   CALCULAR TOTAL
========================= */

$total = $producto['precio'] * $cantidad;

/* =========================
   CREAR PEDIDO
========================= */

$queryPedido = "
    INSERT INTO pedidos(
        id_usuario,
	estado,
        total,
	direccion
    )
    VALUES(
        $1,
        $2,
	$3,
	$4
    )
    RETURNING id_pedido
";

$resultadoPedido = pg_query_params(
    $conn,
    $queryPedido,
    array(
	$_SESSION['id_usuario'],
        'Pendiente de Confirmar',
        $total,
	$direccion
    )
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
        'Registró un pedido'
    )
);

$pedido = pg_fetch_assoc($resultadoPedido);

$id_pedido = $pedido['id_pedido'];

/* =========================
   GUARDAR DETALLE PEDIDO
========================= */

$queryDetalle = "
    INSERT INTO detalle_pedido(
        id_pedido,
        id_producto,
        cantidad,
        subtotal
    )
    VALUES(
        $1,
        $2,
        $3,
        $4
    )
";

pg_query_params(
    $conn,
    $queryDetalle,
    array(
        $id_pedido,
        $id_producto,
        $cantidad,
        $total
    )
);

/* =========================
   ACTUALIZAR STOCK
========================= */

$nuevoStock = $producto['stock'] - $cantidad;

$queryStock = "
    UPDATE productos
    SET stock = $1
    WHERE id_producto = $2
";

pg_query_params(
    $conn,
    $queryStock,
    array(
        $nuevoStock,
        $id_producto
    )
);

/* =========================
   REDIRECCIÓN
========================= */

header("Location: Listar_Pedido.php");

?>
