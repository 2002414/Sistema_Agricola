<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   USUARIO ACTUAL
========================= */

$usuario = $_SESSION['usuario'];

/* =========================
   CONSULTAR MENSAJES
========================= */

$query = "
    SELECT *
    FROM mensajes
    ORDER BY id_mensaje DESC
";

$resultado = pg_query(

    $conn,

    $query

);

/* =========================
   VALIDAR ERROR SQL
========================= */

if(!$resultado){

    die(pg_last_error($conn));

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Mensajes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background: #f4f6f9;

}

.CardMensajes{

    border: none;

    border-radius: 20px;

}

.Titulo{

    color: #198754;

    font-weight: bold;

}

</style>

</head>

<body>

<div class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-4"
>

    ← Volver Dashboard

</a>

<div class="card CardMensajes shadow">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="Titulo">

    Mensajes

</h2>

<a
    href="Crear_Mensaje.php"
    class="btn btn-success"
>

    Nuevo Mensaje

</a>

</div>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-success">

<tr>

<th>
ID
</th>

<th>
Mensaje
</th>

</tr>

</thead>

<tbody>

<?php
while($mensaje = pg_fetch_assoc($resultado)){
?>

<tr>

<td>

<?php
echo $mensaje['id_mensaje'];
?>

</td>

<td>

<?php

/* =========================
   MOSTRAR MENSAJE
========================= */

if(isset($mensaje['mensaje'])){

    echo $mensaje['mensaje'];

}else{

    echo "Mensaje no disponible";

}

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