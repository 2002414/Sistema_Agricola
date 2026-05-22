<?php

session_start();

if(!isset($_SESSION['usuario'])){

    header("Location: ../../index.php");
    exit;

}

if($_SESSION['rol'] != "admin"){

    echo "
    <script>

        alert('Acceso denegado');

        window.location='../../dashboard.php';

    </script>
    ";

    exit;

}

?>