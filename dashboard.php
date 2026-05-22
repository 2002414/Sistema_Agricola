<?php

session_start();

/* =========================
   VALIDAR SESIÓN
========================= */

if(!isset($_SESSION['usuario'])){

    header("Location: index.php");

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- FONT AWESOME -->

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background: #f4f6f9;

}

/* =========================
   TARJETAS
========================= */

.CardModulo{

    border: none;

    border-radius: 20px;

    min-height: 250px;

    transition: 0.3s;

    color: black;

    display: flex;

    justify-content: center;

    align-items: center;

}

.CardModulo:hover{

    transform: translateY(-10px);

    box-shadow: 0 15px 30px rgba(0,0,0,0.2);

}

/* =========================
   ICONOS
========================= */

.Icono{

    font-size: 60px;

    color: #198754;

}

/* =========================
   TITULO
========================= */

.Titulo{

    color: #198754;

    font-weight: bold;

}

/* =========================
   LINKS
========================= */

a{

    text-decoration: none;

}

</style>

</head>

<body>

<div class="container mt-5">

<!-- BIENVENIDA -->

<div class="mb-5">

<h1 class="Titulo">

    Bienvenido
    <?php echo $_SESSION['usuario']; ?>

</h1>

<h5>

Rol:
<?php echo $_SESSION['rol']; ?>

</h5>

</div>

<!-- MODULOS -->

<div class="row g-4">

    <!-- PRODUCTOS -->

    <div class="col-md-4">

        <a
            href="Modules/Productos/Listar_Productos.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-box Icono"></i>

                <h3 class="mt-4">

                    Productos

                </h3>

            </div>

        </a>

    </div>

    <!-- PEDIDOS -->

    <div class="col-md-4">

        <a
            href="Modules/Pedidos/Listar_Pedido.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-cart-shopping Icono"></i>

                <h3 class="mt-4">

                    Pedidos

                </h3>

            </div>

        </a>

    </div>

    <!-- MENSAJES -->

    <div class="col-md-4">

        <a
            href="Modules/Mensajes/Listar_Mensajes.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-envelope Icono"></i>

                <h3 class="mt-4">

                    Mensajes

                </h3>

            </div>

        </a>

    </div>

    <!-- HISTORIAL -->

    <div class="col-md-4">

        <a
            href="Modules/Historial/Listar_Historial.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-clock-rotate-left Icono"></i>

                <h3 class="mt-4">

                    Historial

                </h3>

            </div>

        </a>

    </div>

    <!-- CALIFICACIONES -->

    <div class="col-md-4">

        <a
            href="Modules/Calificaciones/Ver_Calificaciones.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-star Icono"></i>

                <h3 class="mt-4">

                    Calificaciones

                </h3>

            </div>

        </a>

    </div>

    <!-- REPORTES -->

    <?php

    $rol = strtolower(trim($_SESSION['rol']));

    if(
        $rol == 'admin'
        ||
        $rol == 'miembro asociado'
    ){
    ?>

    <div class="col-md-4">

        <a
            href="Modules/Reportes/Dashboard_Reportes.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-chart-column Icono"></i>

                <h3 class="mt-4">

                    Reportes

                </h3>

            </div>

        </a>

    </div>

    <?php
    }
    ?>

    <!-- USUARIOS SOLO ADMIN -->

    <?php
    if($rol == 'admin'){
    ?>

    <div class="col-md-4">

        <a
            href="Modules/Usuarios/Listar_Usuarios.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-users Icono"></i>

                <h3 class="mt-4">

                    Usuarios

                </h3>

            </div>

        </a>

    </div>

    <?php
    }
    ?>

    <!-- CERRAR SESIÓN -->

    <div class="col-md-4">

        <a
            href="Modules/Login/Logout.php"
            class="card CardModulo shadow p-5 text-center"
        >

            <div>

                <i class="fa-solid fa-right-from-bracket Icono"></i>

                <h3 class="mt-4">

                    Cerrar Sesión

                </h3>

            </div>

        </a>

    </div>

</div>

</div>

</body>

</html>