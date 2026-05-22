<?php

session_start();

$id_pedido = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Calificar Productor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background: #f4f6f9;

}

.CardCalificacion{

    border: none;

    border-radius: 20px;

}

</style>

</head>

<body>

<div class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-4"
>

    ← Volver Dashboard

</a>

<div class="card CardCalificacion shadow">

<div class="card-body p-5">

<h2 class="mb-4 text-success">

    ⭐ Calificar Productor

</h2>

<form
    action="Guardar_Calificacion.php"
    method="POST"
>

<input
    type="hidden"
    name="id_pedido"
    value="<?php echo $id_pedido; ?>"
>

<!-- ESTRELLAS -->

<div class="mb-3">

<label>

Calificación

</label>

<select
    name="estrellas"
    class="form-select"
    required
>

<option value="">

Seleccione

</option>

<option value="1">
⭐
</option>

<option value="2">
⭐⭐
</option>

<option value="3">
⭐⭐⭐
</option>

<option value="4">
⭐⭐⭐⭐
</option>

<option value="5">
⭐⭐⭐⭐⭐
</option>

</select>

</div>

<!-- COMENTARIO -->

<div class="mb-3">

<label>

Comentario

</label>

<textarea
    name="comentario"
    class="form-control"
    rows="5"
    required
></textarea>

</div>

<button
    type="submit"
    class="btn btn-success w-100"
>

    Guardar Calificación

</button>

</form>

</div>

</div>

</div>

</body>

</html>