<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Registro Público</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{

            background: linear-gradient(
                135deg,
                #198754,
                #145c32
            );

            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

        }

        .CardRegistro{

            border: none;

            border-radius: 25px;

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card CardRegistro shadow-lg">

                <div class="card-body p-5">

<form
    action="Guardar_Registro_Publico.php"
    method="POST"
>

<h2 class="text-success mb-4">

🛒 Solicitud de Cuenta Comprador

</h2>

<hr>

<div class="mb-3">

<label>

Nombre

</label>

<input
    type="text"
    name="nombre"
    class="form-control"
    required
>

</div>

<div class="mb-3">

<label>

Apellido

</label>

<input
    type="text"
    name="apellido"
    class="form-control"
    required
>

</div>

<div class="mb-3">

<label>

Teléfono

</label>

<input
    type="text"
    name="telefono"
    class="form-control"
    required
>

</div>

<button
    class="btn btn-success"
>

Crear Cuenta

</button>

<a
    href="../../comprador.php"
    class="btn btn-secondary"
>

Volver

</a>

</form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
