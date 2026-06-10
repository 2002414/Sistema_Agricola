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

<title>Mi Perfil</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background:#eef2f5;

}

.CardPerfil{

    border:none;

    border-radius:20px;

}

.FotoPerfil{

    width:220px;

    height:220px;

    object-fit:cover;

    border-radius:50%;

    border:5px solid #198754;

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
href="../../dashboard.php"
class="btn btn-secondary mb-4"
>

← Volver

</a>

<div class="card CardPerfil shadow">

<div class="card-body p-5">

<h2 class="Titulo mb-4">

Mi Perfil

</h2>

<div class="row">

<!-- FOTO -->

<div class="col-md-4 text-center">

<?php

if(!empty($usuario['foto'])){

?>

<img
src="Fotos/<?php echo $usuario['foto']; ?>"
class="FotoPerfil"
>

<?php

}else{

?>

<img
src="../../Assets/img/perfil_default.png"
class="FotoPerfil"
>

<?php

}

?>

</div>

<!-- DATOS -->

<div class="col-md-8">

<div class="card shadow-sm mb-3">

<div class="card-body">

<h5>

Nombre

</h5>

<p>

<?php echo $usuario['nombre']; ?>

</p>

</div>

</div>

<div class="card shadow-sm mb-3">

<div class="card-body">

<h5>

Rol

</h5>

<p>

<?php echo ucfirst($usuario['rol']); ?>

</p>

</div>

</div>

<div class="card shadow-sm mb-3">

<div class="card-body">

<h5>

Teléfono

</h5>

<p>

<?php echo $usuario['telefono']; ?>

</p>

</div>

</div>

<?php
if($usuario['rol'] == 'productor'){
?>

<div class="card shadow-sm mb-3">

<div class="card-body">

<h5>

DPI

</h5>

<p>

<?php echo $usuario['dpi']; ?>

</p>

</div>

</div>

<div class="card shadow-sm mb-3">

<div class="card-body">

<h5>

Código de Mensaje

</h5>

<p>

<?php echo $usuario['codigo_mensaje']; ?>

</p>

</div>

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

<div class="card shadow-sm mb-3">

<div class="card-body">

<h5>

Correo

</h5>

<p>

<?php echo $usuario['correo']; ?>

</p>

</div>

</div>

<?php
}
?>

<a
href="Editar_Perfil.php"
class="btn btn-success"
>

<i class="fa-solid fa-user-pen"></i>

Editar Perfil

</a>

<?php
if(
    $usuario['rol'] == 'miembro asociado'
    ||
    $usuario['rol'] == 'admin'
){
?>

<a
href="Cambiar_Password.php"
class="btn btn-dark"
>

<i class="fa-solid fa-key"></i>

Cambiar Contraseña

</a>

<?php
}
?>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
