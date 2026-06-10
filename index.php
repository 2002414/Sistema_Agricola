<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="Assets/css/mobile.css">

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
Sistema Agrícola "La Esperanza S.A."
</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{

    background:
        linear-gradient(
            rgba(0,0,0,0.45),
            rgba(0,0,0,0.45)
        ),
        url('Assets/img/fondo_agricola.jpg');

    background-size: cover;

    background-position: center;

    background-repeat: no-repeat;

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

}

        .CardLogin{

    border:none;

    border-radius:25px;

    background:rgba(255,255,255,0.95);

    backdrop-filter: blur(5px);

    box-shadow:
    0 20px 50px rgba(0,0,0,.35);

}  

        .BotonTipo{

            width: 100%;

            margin-bottom: 10px;

            border-radius: 10px;

        }

        .Formulario{

            display: none;

        }

        .Activo{

            display: block;

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card CardLogin shadow-lg">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

    <i class="fa-solid fa-wheat-awn text-success"></i>

    <h1 class="fw-bold text-success mt-3">

        Sistema Agrícola
        <br>

        "La Esperanza S.A."

    </h1>

    <p class="text-muted mt-3">

        Plataforma Integral para la Gestión de
        Producción, Comercialización y Distribución Agrícola

    </p>

</div>

<hr>

<div class="d-grid gap-3">

    <a
        href="comprador.php"
        class="btn btn-success btn-lg"
    >
        🛒 Comprador
    </a>

    <a
        href="productor.php"
        class="btn btn-warning btn-lg"
    >
        🌾 Productor
    </a>

<a
    href="Consultar_Solicitud.php"
    class="btn btn-outline-primary btn-lg"
>
    📄 Consultar Solicitud
</a>

</div>

<div class="text-center mt-4">

    <a
        href="admin.php"
        class="text-muted text-decoration-none"
        style="font-size:12px;"
    >
        Acceso Administrativo
    </a>

</div>

</body>

</html>
