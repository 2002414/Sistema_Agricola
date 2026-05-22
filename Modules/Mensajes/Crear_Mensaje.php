<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   CONSULTAR USUARIOS
========================= */

$query = "
    SELECT *
    FROM usuarios
    ORDER BY nombre ASC
";

$resultado = pg_query(
    $conn,
    $query
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Nuevo Mensaje</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background: #f4f6f9;

}

.CardMensaje{

    border: none;

    border-radius: 20px;

}

.Titulo{

    color: #198754;

    font-weight: bold;

}

</style>

</head>

<body>

<div class="container mt-5">

<a
    href="Listar_Mensajes.php"
    class="btn btn-secondary mb-4"
>

    ← Volver Mensajes

</a>

<div class="card CardMensaje shadow">

<div class="card-body p-5">

<h2 class="Titulo mb-4">

    Nuevo Mensaje

</h2>

<form
    action="Guardar_Mensaje.php"
    method="POST"
>

<!-- DESTINATARIO -->

<div class="mb-3">

<label>

Destinatario

</label>

<select
    name="destinatario"
    class="form-select"
    required
>

<option value="">

    Seleccione usuario

</option>

<?php
while($usuario = pg_fetch_assoc($resultado)){
?>

<?php
if($usuario['nombre'] != $_SESSION['usuario']){
?>

<option
    value="<?php echo $usuario['nombre']; ?>"
>

    <?php
    echo $usuario['nombre'];
    ?>

</option>

<?php
}
?>

<?php
}
?>

</select>

</div>

<!-- MENSAJE -->

<div class="mb-3">

<label>

Mensaje

</label>

<textarea
    name="mensaje"
    class="form-control"
    rows="5"
    required
></textarea>

</div>

<!-- BOTÓN -->

<button
    type="submit"
    class="btn btn-success w-100"
>

    Enviar Mensaje

</button>

</form>

</div>

</div>

</div>

</body>

</html>