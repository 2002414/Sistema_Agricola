<?php

header("Content-Type: application/json");

include("../Config/conexion.php");

/* =========================
   CONSULTA PRODUCTOS
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

$productos = [];

while($producto = pg_fetch_assoc($resultado)){

    $productos[] = $producto;

}

/* =========================
   RESPUESTA JSON
========================= */

echo json_encode(
    $productos,
    JSON_PRETTY_PRINT
);

?>