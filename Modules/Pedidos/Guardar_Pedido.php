<?php

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

$cliente = $_POST['cliente'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];

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

    die("Stock insuficiente");

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
        estado,
        total
    )
    VALUES(
        $1,
        $2
    )
    RETURNING id_pedido
";

$resultadoPedido = pg_query_params(
    $conn,
    $queryPedido,
    array(
        'Pendiente',
        $total
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

session_start();

/* =========================
   HISTORIAL PEDIDO
========================= */

$queryHistorial = "
    INSERT INTO historial_actividades(
        usuario,
        accion
    )
    VALUES(
        $1,
        $2
    )
";

pg_query_params(
    $conn,
    $queryHistorial,
    array(
        $_SESSION['usuario'],
        'Registró un pedido'
    )
);

header("Location: Listar_Pedido.php");

?>