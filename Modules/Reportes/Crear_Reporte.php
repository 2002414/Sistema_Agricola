<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   USUARIOS DISPONIBLES
========================= */

$query = "
    SELECT *
    FROM usuarios
    WHERE id_usuario <> $1
    AND estado = 'ACTIVADO'
    ORDER BY nombre ASC
";

$resultado = pg_query_params(
    $conn,
    $query,
    array($_SESSION['id_usuario'])
);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

<meta charset="UTF-8">

<meta name="viewport"
   content="width=device-width, initial-scale=1.0">

<title>Nuevo Reporte</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background:#f4f6f9;

}

.CardReporte{

    border:none;

    border-radius:20px;

}

.Titulo{

    color:#198754;

    font-weight:bold;

}

</style>

</head>

<body>

<div class="container mt-5">

<a
href="Listar_Reportes.php"
class="btn btn-secondary mb-4"

>

← Volver

</a>

<div class="card CardReporte shadow">

<div class="card-body p-5">

<h2 class="Titulo mb-4">

⚠️ Crear Reporte

</h2>

<form
action="Guardar_Reporte.php"
method="POST"
enctype="multipart/form-data"
>

<div class="mb-3">

<label>

Usuario Reportado

</label>

<select
name="reportado"
class="form-select"
required

>

<option value="">

Seleccione usuario

</option>

<?php
while($usuario = pg_fetch_assoc($resultado)){
?>

<option
value="<?php echo $usuario['id_usuario']; ?>"
>

<?php

echo $usuario['nombre']
." ("
.$usuario['rol']
.")";

?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label>

Motivo del Reporte

</label>

<textarea
name="motivo"
class="form-control"
rows="6"
required
></textarea>

<div class="mb-3">

<label>

Evidencia (Imagen)

</label>

<input

type="file"

name="evidencia"

class="form-control"

accept=".jpg,.jpeg,.png,.gif,.webp"

>

<small class="text-muted">

Puede adjuntar una fotografía como evidencia.

</small>

</div>

</div>

<button
type="submit"
class="btn btn-danger"

>

Enviar Reporte

</button>

</form>

</div>

</div>

</div>

</body>

</html>
