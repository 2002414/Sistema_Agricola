<?php

session_start();

include("Config/conexion.php");

/* =========================
   VALIDAR SESION
========================= */

if(!isset($_SESSION['usuario'])){

    header("Location: index.php");
    exit();

}

/* =========================
   MENSAJES SIN LEER
========================= */

$mensajesSinLeer = 0;

if(isset($_SESSION['id_usuario'])){

    $queryMensajes = "
        SELECT COUNT(*) AS total
        FROM mensajes
        WHERE receptor = $1
	AND leido = False
    ";

    $resultadoMensajes = pg_query_params(
        $conn,
        $queryMensajes,
        array($_SESSION['id_usuario'])
    );

    if($resultadoMensajes){

        $filaMensajes = pg_fetch_assoc(
            $resultadoMensajes
        );

        $mensajesSinLeer =
            $filaMensajes['total'];

    }

}

$rol = strtolower(
    trim($_SESSION['rol'])
);

/* =========================
   CONTADORES
========================= */

$totalProductos = 0;
$totalPedidos = 0;
$totalReportes = 0;

$r = pg_query(
    $conn,
    "SELECT COUNT(*) total FROM productos"
);

if($r){

    $totalProductos =
    pg_fetch_assoc($r)['total'];

}

$r = pg_query(
    $conn,
    "SELECT COUNT(*) total FROM pedidos"
);

if($r){

    $totalPedidos =
    pg_fetch_assoc($r)['total'];

}

$r = pg_query(
    $conn,
    "SELECT COUNT(*) total FROM reportes"
);

if($r){

    $totalReportes =
    pg_fetch_assoc($r)['total'];

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
   content="width=device-width, initial-scale=1.0">

<title>Sistema Agrícola</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    margin:0;

    background:#eef2f5;

    font-family:Arial, sans-serif;

}

/* SIDEBAR */

.Sidebar{

    position:fixed;

    top:0;
    left:0;

    width:260px;

    height:100vh;

    background:#198754;

    overflow-y:auto;

    box-shadow:3px 0 15px rgba(0,0,0,.15);

}

.Logo{

    text-align:center;

    color:white;

    padding:25px 15px;

    border-bottom:1px solid rgba(255,255,255,.2);

}

.Logo h4{

    margin:0;

    font-weight:bold;

}

.Logo p{

    margin-top:8px;

    font-size:13px;

}

/* MENU */

.Menu{

    padding-top:10px;

}

.Menu a{

    display:block;

    color:white;

    text-decoration:none;

    padding:14px 20px;

    transition:.3s;

}

.Menu a:hover{

    background:rgba(255,255,255,.15);

    padding-left:30px;

}

.Menu i{

    width:30px;

}

/* CONTENIDO */

.Contenido{

    margin-left:260px;

    padding:30px;

}

/* TARJETAS */

.CardResumen{

    border:none;

    border-radius:15px;

}

.Titulo{

    color:#198754;

    font-weight:bold;

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="Sidebar">

```
<div class="Logo">

    <h4>

        🌱 Sistema Agrícola

    </h4>

    <p>

        La Esperanza S.A.

    </p>

</div>

<div class="Menu">

    <a href="dashboard.php">

        <i class="fa-solid fa-house"></i>

        Inicio

    </a>

    <a href="Modules/Productos/Listar_Productos.php">

        <i class="fa-solid fa-box"></i>

        Productos

    </a>

    <a href="Modules/Pedidos/Listar_Pedido.php">

        <i class="fa-solid fa-cart-shopping"></i>

        Pedidos

    </a>

    <a href="Modules/Mensajes/Listar_Mensajes.php">

        <i class="fa-solid fa-envelope"></i>

        Mensajes

    </a>

    <a href="Modules/Historial/Listar_Historial.php">

        <i class="fa-solid fa-clock-rotate-left"></i>

        Historial

    </a>

    <a href="Modules/Calificaciones/Ver_Calificaciones.php">

        <i class="fa-solid fa-star"></i>

        Calificaciones

    </a>

    <a href="Modules/Perfil/Ver_Perfil.php">

        <i class="fa-solid fa-user"></i>

        Mi Perfil

    </a>

    <a href="Modules/Reportes/Listar_Reportes.php">

        <i class="fa-solid fa-triangle-exclamation"></i>

        Reportes

    </a>

    <?php
    if(
        $rol == 'admin'
        ||
        $rol == 'miembro asociado'
    ){
    ?>

    <a href="Modules/Usuarios/Listar_Usuarios.php">

        <i class="fa-solid fa-users"></i>

        Usuarios

    </a>

    <?php
    }
    ?>

    <a href="Modules/Login/Logout.php">

        <i class="fa-solid fa-right-from-bracket"></i>

        Cerrar Sesión

    </a>

</div>

</div>

<!-- CONTENIDO -->

<div class="Contenido">
    
<div class="card CardResumen shadow-sm bg-white p-4">

    <h2 class="Titulo">

        Bienvenido,
        <?php echo $_SESSION['usuario']; ?>

    </h2>
    <p>

        <strong>Rol:</strong>

        <?php echo ucfirst($_SESSION['rol']); ?>

    </p>

    <p class="mb-0">

    Sistema de Gestión Agrícola

</p>

    <?php
    if($mensajesSinLeer > 0){
    ?>

    <div class="alert alert-warning mt-3">

        📩 Tiene

        <strong>

            <?php echo $mensajesSinLeer; ?>

        </strong>

        mensaje(s) sin leer.

    </div>

    <?php
    }
    ?>

</div>

<div class="row mt-4">

    <div class="col-md-3">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <i class="fa-solid fa-box fs-1 text-success"></i>

                <h3 class="mt-3">

                    <?php echo $totalProductos; ?>

                </h3>

                <p>

                    Productos

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <i class="fa-solid fa-cart-shopping fs-1 text-primary"></i>

                <h3 class="mt-3">

                    <?php echo $totalPedidos; ?>

                </h3>

                <p>

                    Pedidos

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <i class="fa-solid fa-envelope fs-1 text-warning"></i>

                <h3 class="mt-3">

                    <?php echo $mensajesSinLeer; ?>

                </h3>

                <p>

                    Mensajes Nuevos

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <i class="fa-solid fa-triangle-exclamation fs-1 text-danger"></i>

                <h3 class="mt-3">

                    <?php echo $totalReportes; ?>

                </h3>

                <p>

                    Reportes

                </p>

            </div>

        </div>

    </div>

</div>

<?php

if(
    $rol == 'admin'
    ||
    $rol == 'miembro asociado'
){

    $queryHistorial = "

        SELECT
            usuario,
            accion,
            fecha

        FROM historial_actividades

        ORDER BY fecha DESC

        LIMIT 10

    ";

    $resultadoHistorial = pg_query(

        $conn,

        $queryHistorial

    );

}else{

    $queryHistorial = "

        SELECT
            usuario,
            accion,
            fecha

        FROM historial_actividades

	WHERE id_usuario = $1

        ORDER BY fecha DESC

        LIMIT 10

    ";

    $resultadoHistorial = pg_query_params(

        $conn,

        $queryHistorial,

        array($_SESSION['id_usuario'])

    );

}

?>

<div class="card shadow border-0 mt-4">

    <div class="card-body">

        <h4 class="text-success mb-4">

            <i class="fa-solid fa-clock-rotate-left"></i>

            Últimas Actividades

        </h4>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-success">

                    <tr>

                        <th>Usuario</th>

                        <th>Actividad</th>

                        <th>Fecha</th>

                    </tr>

                </thead>

                <tbody>

                <?php
                while(
                    $actividad =
                    pg_fetch_assoc(
                        $resultadoHistorial
                    )
                ){
                ?>

                    <tr>

                        <td>

                            <?php
                            echo $actividad['usuario'];
                            ?>

                        </td>

                        <td>

                            <?php
                            echo $actividad['accion'];
                            ?>

                        </td>

                        <td>

                            <?php
                            echo $actividad['fecha'];
                            ?>

                        </td>

                    </tr>

                <?php
                }
                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

</body>

</html>
