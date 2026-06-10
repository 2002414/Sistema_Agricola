<?php

function RegistrarHistorial(
    $conn,
    $id_usuario,
    $usuario,
    $accion
){

    pg_query_params(

        $conn,

        "
        INSERT INTO historial_actividades(

            usuario,
            accion,
            id_usuario

        )

        VALUES(

            $1,
            $2,
            $3

        )
        ",

        array(

            $usuario,
            $accion,
            $id_usuario

        )

    );

}

?>
