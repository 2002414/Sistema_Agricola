<?php

include("../../Config/conexion.php");

/* =========================
   CABECERAS CSV
========================= */

header('Content-Type: text/csv');

header(
    'Content-Disposition: attachment; filename="Reporte_Productos.csv"'
);

/* =========================
   CREAR ARCHIVO
========================= */

$output = fopen(
    "php://output",
    "w"
);

/* =========================
   TITULOS
========================= */

fputcsv($output, array(

    'ID',
    'Nombre',
    'Descripcion',
    'Precio',
    'Stock'

));

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

/* =========================
   AGREGAR DATOS
========================= */

while($producto = pg_fetch_assoc($resultado)){

    fputcsv($output, array(

        $producto['id_producto'],
        $producto['nombre'],
        $producto['descripcion'],
        $producto['precio'],
        $producto['stock']

    ));

}

fclose($output);

exit;

?>