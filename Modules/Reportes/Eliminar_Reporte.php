<?php

session_start();

include("../../Config/conexion.php");

$id = $_GET['id'];

/* =========================
   ELIMINAR REPORTE
========================= */

$query = "
    DELETE FROM reportes
    WHERE id_reporte = $1
";

pg_query_params(

    $conn,

    $query,

    array($id)

);

/* =========================
   HISTORIAL
========================= */

pg_query_params(

    $conn,

    "
    INSERT INTO historial_actividades(
        id_usuario,
        usuario,
        accion
    )
    VALUES($1,$2,$3)
    ",

    array(

        $_SESSION['id_usuario'],
        $_SESSION['usuario'],
        'Eliminó un reporte'

    )

);

/* =========================
   REDIRECCIÓN
========================= */

header(

    "Location: Listar_Reportes.php"

);

exit();

?>
