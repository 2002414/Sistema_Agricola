<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   CONSULTAR CALIFICACIONES
========================= */

$query = "
    SELECT *
    FROM calificaciones
    ORDER BY id_calificacion DESC
";

$resultado = pg_query(

    $conn,

    $query

);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

<meta charset="UTF-8">

<title>Calificaciones</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background: #f4f6f9;

}

.CardCalificaciones{

    border: none;

    border-radius: 20px;

}

</style>

</head>

<body>

<div class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-4"
>

    ← Volver 

</a>

<div class="card CardCalificaciones shadow">

<div class="card-body">

<h2 class="text-success mb-4">

    ⭐ Calificaciones

</h2>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-success">

<tr>

<th>
Comprador
</th>

<th>
Productor
</th>

<th>
Estrellas
</th>

<th>
Comentario
</th>

<th>
Fecha
</th>

</tr>

</thead>

<tbody>

<?php
while($calificacion = pg_fetch_assoc($resultado)){
?>

<tr>

<td>

<?php
echo $calificacion['comprador'];
?>

</td>

<td>

<?php
echo $calificacion['productor'];
?>

</td>

<td>

<?php
echo $calificacion['estrellas'];
?>

⭐

</td>

<td>

<?php
echo $calificacion['comentario'];
?>

</td>

<td>

<?php
echo date(
    "d/m/Y H:i:s",
    strtotime($calificacion['fecha'])
);
?>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>

</html>
