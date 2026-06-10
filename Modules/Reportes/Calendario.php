<?php

include("../../Config/conexion.php");

/* =========================
   OBTENER ENTREGAS
========================= */

/* =========================
   EVENTOS CALENDARIO
========================= */

$eventos = [];

/* =========================
   PEDIDOS
========================= */

$queryPedidos = "
    SELECT *
    FROM pedidos
";

$resultadoPedidos = pg_query(
    $conn,
    $queryPedidos
);

while($pedido = pg_fetch_assoc($resultadoPedidos)){

    $color = '#ffc107';

    if($pedido['estado'] == 'Entregado'){
        $color = '#198754';
    }
    elseif($pedido['estado'] == 'En Proceso'){
        $color = '#0d6efd';
    }
    elseif($pedido['estado'] == 'Cancelado'){
        $color = '#dc3545';
    }

    $eventos[] = [

        "title" =>
            "Pedido #".$pedido['id_pedido'].
            " - ".$pedido['estado'],

        "start" =>
            date(
                'Y-m-d',
                strtotime($pedido['fecha'])
            ),

        "color" => $color

    ];
}

/* =========================
   ENTREGAS
========================= */

$queryEntregas = "
    SELECT *
    FROM entregas
";

$resultadoEntregas = pg_query(
    $conn,
    $queryEntregas
);

while($entrega = pg_fetch_assoc($resultadoEntregas)){

    $eventos[] = [

        "title" =>
            "Entrega Pedido #".
            $entrega['id_pedido'],

        "start" =>
            $entrega['fecha_entrega'],

        "color" => '#198754'

    ];

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="Assets/css/mobile.css">

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
    href="Listar_Reportes.php"
    class="btn btn-secondary mb-3"
>

    ← Volver 

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

        events: <?php echo json_encode($eventos); ?>,

eventClick: function(info){

    alert(
        "Evento:\n\n" +
        info.event.title
    );

}

    });

    calendar.render();

});

</script>

</body>

</html>
