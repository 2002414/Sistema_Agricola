<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Cambiar Contraseña</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<a
href="Ver_Perfil.php"
class="btn btn-secondary mb-3"
>

← Volver Perfil

</a>

<div class="card shadow">

<div class="card-body p-5">

<h2 class="text-success mb-4">

Cambiar Contraseña

</h2>

<form
action="Actualizar_Password.php"
method="POST"
>

<div class="mb-3">

<label>

Contraseña Actual

</label>

<input
type="password"
name="actual"
class="form-control"
required
>

</div>

<div class="mb-3">

<label>

Nueva Contraseña

</label>

<input
type="password"
name="nueva"
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
type="submit"
class="btn btn-success"
>

Actualizar Contraseña

</button>

</form>

</div>

</div>

</div>

</body>

</html>