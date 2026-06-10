<?php

include("../../Config/conexion.php");

/* =========================
   TOTAL PRODUCTOS
========================= */

$queryProductos = "
    SELECT COUNT(*) AS total
    FROM productos
";

$resultadoProductos = pg_query($conn, $queryProductos);

$totalProductos = pg_fetch_assoc($resultadoProductos);

/* =========================
   TOTAL PEDIDOS
========================= */

$queryPedidos = "
    SELECT COUNT(*) AS total
    FROM pedidos
";

$resultadoPedidos = pg_query($conn, $queryPedidos);

$totalPedidos = pg_fetch_assoc($resultadoPedidos);

/* =========================
   TOTAL USUARIOS
========================= */

$queryUsuarios = "
    SELECT COUNT(*) AS total
    FROM usuarios
";

$resultadoUsuarios = pg_query($conn, $queryUsuarios);

$totalUsuarios = pg_fetch_assoc($resultadoUsuarios);

/* =========================
   TOTAL ENTREGAS
========================= */

$queryEntregas = "
    SELECT COUNT(*) AS total
    FROM entregas
";

$resultadoEntregas = pg_query($conn, $queryEntregas);

$totalEntregas = pg_fetch_assoc($resultadoEntregas);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

    <meta charset="UTF-8">

    <title>Gráficas</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    <h1 class="mb-5">
        Estadísticas del Sistema
    </h1>

    <div class="card shadow p-4">

        <canvas id="graficaSistema"></canvas>

    </div>

</div>

<script>

const ctx = document.getElementById('graficaSistema');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Productos',
            'Pedidos',
            'Usuarios',
            'Entregas'
        ],

        datasets: [{

            label: 'Cantidad',

            data: [

                <?php echo $totalProductos['total']; ?>,
                <?php echo $totalPedidos['total']; ?>,
                <?php echo $totalUsuarios['total']; ?>,
                <?php echo $totalEntregas['total']; ?>

            ],

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>

</body>

</html>
