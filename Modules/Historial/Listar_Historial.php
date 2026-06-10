<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   VALIDAR SESIÓN
========================= */

if(!isset($_SESSION['usuario'])){

    header("Location: ../../index.php");

    exit();

}

/* =========================
   ROL
========================= */

$rol = strtolower(
    trim($_SESSION['rol'])
);

/* =========================
   CONSULTAR HISTORIAL
========================= */

if(
    $rol == 'miembro asociado'
    ||
    $rol == 'admin'
){

$query = "
    SELECT
        id_historial,
        usuario,
        accion,
        TO_CHAR(fecha, 'DD/MM/YYYY HH24:MI:SS') AS fecha
    FROM historial_actividades
    ORDER BY id_historial DESC
";
    $resultado = pg_query(
        $conn,
        $query
    );

}else{

       $query = "
    SELECT
        id_historial,
        usuario,
        accion,
        TO_CHAR(fecha, 'DD/MM/YYYY HH24:MI:SS') AS fecha
    FROM historial_actividades
    WHERE id_usuario = $1
    ORDER BY id_historial DESC
";

    $resultado = pg_query_params(
        $conn,
        $query,
        array($_SESSION['id_usuario'])
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

<title>Historial de Actividades</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background:#f4f6f9;

}

.CardHistorial{

    border:none;

    border-radius:20px;

}

.Titulo{

    color:#198754;

    font-weight:bold;

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

<div class="card CardHistorial shadow">

<div class="card-body">

<h2 class="Titulo mb-4">

<i class="fa-solid fa-clock-rotate-left"></i>

Historial de Actividades

</h2>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-success">

<tr>

<th>ID</th>

<th>Usuario</th>

<th>Acción</th>

<th>Fecha</th>

</tr>

</thead>

<tbody>

<?php
while($historial = pg_fetch_assoc($resultado)){
?>

<tr>

<td>

<?php
echo $historial['id_historial'];
?>

</td>

<td>

<?php
echo $historial['usuario'];
?>

</td>

<td>

<?php
echo $historial['accion'];
?>

</td>

<td>

<?php
echo $historial['fecha'];
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
