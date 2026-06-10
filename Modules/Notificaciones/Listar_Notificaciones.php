<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   MARCAR NOTIFICACIONES LEIDAS
========================= */

if(isset($_SESSION['id_usuario'])){

    pg_query_params(

        $conn,

        "
        UPDATE notificaciones

        SET leido = TRUE

        WHERE id_usuario = $1
        ",

        array(

            $_SESSION['id_usuario']

        )

    );

}

if(!isset($_SESSION['usuario'])){

    header("Location: ../../index.php");

    exit();

}

$query = "

    SELECT

        id_notificacion,

        mensaje,

        leido,

        TO_CHAR(

            fecha,

            'DD/MM/YYYY HH24:MI:SS'

        ) AS fecha

    FROM notificaciones

    WHERE id_usuario = $1

    ORDER BY id_notificacion DESC

";

$resultado = pg_query_params(
    $conn,
    $query,
    array($_SESSION['id_usuario'])
);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<meta charset="UTF-8">

<title>Notificaciones</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{

    background:#f4f6f9;

}

.Titulo{

    color:#198754;

    font-weight:bold;

}

.CardNotificacion{

    border:none;

    border-radius:15px;

    margin-bottom:15px;

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

<h2 class="Titulo mb-4">

🔔 Notificaciones

</h2>

<?php

while(
$notificacion =
pg_fetch_assoc(
$resultado
)
){

?>

<div class="card CardNotificacion shadow mb-3">

<div class="card-body">

<?php

if(
    !$notificacion['leido']
){

?>

<span class="badge bg-danger">

Nueva

</span>

<?php

}else{

?>

<span class="badge bg-success">

Leída

</span>

<?php

}

?>

<br><br>

<h6 class="text-muted">

<i class="fa-solid fa-clock"></i>

<?php

echo $notificacion['fecha'];

?>

</h6>

<hr>

<p class="fs-5">

<i class="fa-solid fa-bell text-warning"></i>

<?php

echo $notificacion['mensaje'];

?>

</p>

</div>

</div>

<?php

}

?>

</div>

</body>

</html>

