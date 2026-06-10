<?php

session_start();

$id_usuario = $_GET['id'];

$id_reporte = $_GET['reporte'];

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Confirmar Bloqueo</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-danger">

⚠️ Confirmar Bloqueo

</h2>

<form
action="Bloquear_Usuario.php"
method="POST"
>

<input
type="hidden"
name="id_usuario"
value="<?php echo $id_usuario; ?>"

>

<input
type="hidden"
name="id_reporte"
value="<?php echo $id_reporte; ?>"

>

<div class="mb-3">

<label>

Motivo del Bloqueo

</label>

<textarea
name="motivo_bloqueo"
class="form-control"
rows="5"
required
></textarea>

</div>

<button
type="submit"
class="btn btn-danger"

>

Bloquear Usuario

</button>

</form>

</div>

</div>

</div>

</body>

</html>
