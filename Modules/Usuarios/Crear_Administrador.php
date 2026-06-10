<?php

include("../../Config/Middleware/Validar_Admin.php");

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>

Crear Administrador

</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

<style>

body{

    background:
    linear-gradient(
        rgba(0,0,0,0.45),
        rgba(0,0,0,0.45)
    ),
    url('../../Assets/img/fondo_agricola.jpg');

    background-size:cover;

    background-position:center;

    background-repeat:no-repeat;

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

}

.CardRegistro{

    border:none;

    border-radius:25px;

    background:rgba(255,255,255,.95);

    backdrop-filter:blur(5px);

    box-shadow:
    0 20px 50px rgba(0,0,0,.35);

}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card CardRegistro shadow-lg">

<div class="card-body p-5">

<div class="text-center mb-4">

<h2 class="text-success">

👨‍💼 Crear Administrador

</h2>

<p class="text-muted">

Registrar nuevo administrador del sistema

</p>

</div>

<form
action="Guardar_Administrador.php"
method="POST"
>

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

<div class="mb-3">

<label>

Confirmar Contraseña

</label>

<input
type="password"
name="confirmar"
class="form-control"
required
>

</div>

<button
class="btn btn-dark w-100"
>

Crear Administrador

</button>

<a
href="Listar_Usuarios.php"
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
