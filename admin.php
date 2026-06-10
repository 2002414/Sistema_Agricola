<!DOCTYPE html>
<html lang="es">

<head>

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

<div class="text-center mb-4">

    <h1 class="fw-bold text-success">

        👨‍💼 Administrador

    </h1>

    <p class="text-muted">

        Acceso exclusivo para Miembros Asociados autorizados

    </p>

</div>

<form
    action="Modules/Login/Validar_Login.php"
    method="POST"
>

<input
    type="hidden"
    name="tipo"
    value="asociado"
>
<div class="mb-3">

    <label>

        Correo

    </label>

    <input
        type="email"
        name="correo"
        class="form-control"
        required
    >

</div>
    <div class="mb-3">

        <label>
            Contraseña
        </label>

        <input
            type="password"
            name="password"
            class="form-control"
            required
        >

    </div>

    <button class="btn btn-dark w-100">

        Ingresar

    </button>

</form>

</div>
 
</form>

<hr>

<a
    href="index.php"
    class="btn btn-secondary w-100"
>

    Volver

</a>
        </div>

        </div>

    </div>

</div>

</body>

</html>
