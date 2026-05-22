<?php

session_start();

/* =========================
   VALIDAR SESIÓN
========================= */

if(!isset($_SESSION['usuario'])){

    header("Location: ../../index.php");

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Reportes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background: #f4f6f9;

}

.CardReporte{

    border: none;

    border-radius: 20px;

    min-height: 250px;

    transition: 0.3s;

    color: black;

    display: flex;

    justify-content: center;

    align-items: center;

}

.CardReporte:hover{

    transform: translateY(-10px);

    box-shadow: 0 15px 30px rgba(0,0,0,0.2);

}

.Icono{

    font-size: 60px;

    color: #198754;

}

.Titulo{

    color: #198754;

    font-weight: bold;

}

a{

    text-decoration: none;

}

</style>

</head>

<body>

<div class="container mt-5">

<div class="mb-5">

<h1 class="Titulo">

    Reportes del Sistema

</h1>

<h5>

Bienvenido
<?php echo $_SESSION['usuario']; ?>

</h5>

</div>

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-5"
>

    ← Volver Dashboard

</a>

<div class="row g-4">

    <!-- CALENDARIO -->

    <div class="col-md-4">

        <a
            href="Calendario.php"
            class="card CardReporte shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-calendar-days Icono"></i>

                <h3 class="mt-4">

                    Calendario

                </h3>

            </div>

        </a>

    </div>

    <!-- GRAFICAS -->

    <div class="col-md-4">

        <a
            href="Graficas.php"
            class="card CardReporte shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-chart-pie Icono"></i>

                <h3 class="mt-4">

                    Gráficas

                </h3>

            </div>

        </a>

    </div>

    <!-- EXCEL -->

    <div class="col-md-4">

        <a
            href="Reporte_Productos_Excel.php"
            class="card CardReporte shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-file-excel Icono"></i>

                <h3 class="mt-4">

                    Reporte Excel

                </h3>

            </div>

        </a>

    </div>

    <!-- PDF -->

    <div class="col-md-4">

        <a
            href="Reporte_Productos_PDF.php"
            class="card CardReporte shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-file-pdf Icono"></i>

                <h3 class="mt-4">

                    Reporte PDF

                </h3>

            </div>

        </a>

    </div>

</div>

</div>

</body>

</html>