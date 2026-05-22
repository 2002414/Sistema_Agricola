<?php

include("../../Config/conexion.php");

/* =========================
   VARIABLES
========================= */

$nombre = $_POST['nombre'];

$rol = $_POST['rol'];

$telefono = $_POST['telefono'] ?? null;

$dpi = $_POST['dpi'] ?? null;

$codigo_mensaje = $_POST['codigo_mensaje'] ?? null;

/* =========================
   INSERTAR
========================= */

$query = "
    INSERT INTO usuarios(
        nombre,
        rol,
        telefono,
        dpi,
        codigo_mensaje
    )
    VALUES(
        $1,
        $2,
        $3,
        $4,
        $5
    )
";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $nombre,
        $rol,
        $telefono,
        $dpi,
        $codigo_mensaje

    )

);

/* =========================
   VALIDAR
========================= */
if(!$resultado){

    echo pg_last_error($conn);

}

if($resultado){

    echo "
    <script>

        alert('Registro exitoso');

        window.location='../../index.php';

    </script>
    ";

}else{

    echo "
    <script>

        alert('Error al registrar');

        window.location='Registro_Publico.php';

    </script>
    ";

}

?>