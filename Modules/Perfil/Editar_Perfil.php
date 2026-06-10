<?php

session_start();

include("../../Config/conexion.php");

$query = "
    SELECT *
    FROM usuarios
    WHERE id_usuario = $1
";

$resultado = pg_query_params(
    $conn,
    $query,
    array($_SESSION['id_usuario'])
);

$usuario = pg_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

<meta charset="UTF-8">

<title>Editar Perfil</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background:#eef2f5;

}

.CardPerfil{

    border:none;

    border-radius:20px;

}

</style>

</head>

<body>

<div class="container mt-5">

<a
href="Ver_Perfil.php"
class="btn btn-secondary mb-3"
>

← Volver Perfil

</a>

<div class="card CardPerfil shadow">

<div class="card-body p-5">

<h2 class="text-success mb-4">

Editar Perfil

</h2>

<form
action="Actualizar_Perfil.php"
method="POST"
enctype="multipart/form-data"
>

<div class="mb-3">

<label>

Foto de Perfil

</label>

<input
type="file"
name="foto"
class="form-control"
accept="image/*"
>

</div>

<div class="mb-3">

<label>

Nombre

</label>

<input
type="text"
name="nombre"
class="form-control"
value="<?php echo $usuario['nombre']; ?>"
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
value="<?php echo $usuario['telefono']; ?>"
required
>

</div>

<?php
if($usuario['rol'] == 'productor'){
?>

<div class="mb-3">

<label>

DPI

</label>

<input
type="text"
name="dpi"
class="form-control"
value="<?php echo $usuario['dpi']; ?>"
required
>

</div>

<div class="mb-3">

<label>

Código de Mensaje

</label>

<input
type="text"
name="codigo_mensaje"
class="form-control"
value="<?php echo $usuario['codigo_mensaje']; ?>"
required
>

</div>

<?php
}
?>

<?php
if(
    $usuario['rol'] == 'miembro asociado'
    ||
    $usuario['rol'] == 'admin'
){
?>

<div class="mb-3">

<label>

Correo

</label>

<input
type="email"
name="correo"
class="form-control"
value="<?php echo $usuario['correo']; ?>"
required
>

</div>

<?php
}
?>

<button
type="submit"
class="btn btn-success"
>

Guardar Cambios

</button>

</form>

</div>

</div>

</div>

</body>

</html>
