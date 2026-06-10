<?php

include("../../Config/conexion.php");

$id = $_GET['id'];

pg_query_params(

    $conn,

    "
    UPDATE solicitudes_productor
    SET estado = 'RECHAZADA'
    WHERE id_solicitud = $1
    ",

    array($id)

);

header(
    "Location: Listar_Solicitudes.php"
);

exit();

?>
