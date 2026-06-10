<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>

Consultar Solicitud

</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

<style>

body{

    background:
    linear-gradient(
        135deg,
        #198754,
        #145c32
    );

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

}

.CardSolicitud{

    border:none;

    border-radius:20px;

}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card CardSolicitud shadow-lg">

<div class="card-body p-5">

<h2 class="text-center text-success">

🌾 Consultar Solicitud

</h2>

<hr>

<form
action="Modules/Productores/Verificar_Solicitud.php"
method="POST"
>

<div class="mb-3">

<label>

Número de Teléfono

</label>

<input
type="text"
name="telefono"
class="form-control"
required
>

</div>

<div class="mb-3">

<label>

DPI

</label>

<input
type="text"
name="dpi"
class="form-control"
required
>

</div>

<button
class="btn btn-success w-100"
>

Consultar

</button>

<a
href="index.php"
class="btn btn-secondary w-100 mt-3"
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
