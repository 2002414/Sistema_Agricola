<?php

header("Content-Type: application/json");

include("../Config/conexion.php");

/* =========================
   OBTENER ID
========================= */

$id = $_GET['id'];

/* =========================
   CONSULTA PRODUCTO
========================= */

$query = "
    SELECT *
    FROM productos
    WHERE id_producto = $1
";

$resultado = pg_query_params(
    $conn,
    $query,
    array($id)
);

$producto = pg_fetch_assoc($resultado);

/* =========================
   RESPUESTA JSON
========================= */

echo json_encode(
    $producto,
    JSON_PRETTY_PRINT
);

?>