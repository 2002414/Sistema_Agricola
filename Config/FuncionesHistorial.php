<?php

function guardarHistorial($conn, $id_usuario, $usuario, $accion)
{
    $sql = "INSERT INTO historial_actividades
            (id_usuario, usuario, accion)
            VALUES ($1, $2, $3)";

    pg_query_params(
        $conn,
        $sql,
        array(
            $id_usuario,
            $usuario,
            $accion
        )
    );
}

?>
