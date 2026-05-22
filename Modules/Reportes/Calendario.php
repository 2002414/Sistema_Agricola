<?php

include("../../Config/conexion.php");

/* =========================
   OBTENER ENTREGAS
========================= */

$query = "
    SELECT *
    FROM entregas
";

$resultado = pg_query($conn, $query);

$eventos = [];

while($entrega = pg_fetch_assoc($resultado)){

    $eventos[] = [

        "title" => "Entrega Pedido #".$entrega['id_pedido'],

        "start" => $entrega['fecha_entrega']

    ];

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Calendario</title>

    <!-- FULLCALENDAR -->

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css'
          rel='stylesheet'>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-3"
>

    ← Volver Dashboard

</a>

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Calendario de Entregas
            </h2>

            <div id='calendar'></div>

        </div>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function(){

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        locale: 'es',

        height: 650,

        events: <?php echo json_encode($eventos); ?>

    });

    calendar.render();

});

</script>

</body>

</html>