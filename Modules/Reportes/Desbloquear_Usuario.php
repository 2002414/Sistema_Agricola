<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   USUARIO
========================= */

$id_usuario = $_GET['id'];

/* =========================
   DESBLOQUEAR
========================= */

$query = "
    UPDATE usuarios
    SET estado = 'ACTIVADO'
    WHERE id_usuario = $1
";

pg_query_params(
    $conn,
    $query,
    array($id_usuario)
);

/* =========================
   ADMINISTRADOR
========================= */

$queryAdmin = "
    SELECT id_usuario
    FROM usuarios
    WHERE rol IN ('admin','miembro asociado')
    LIMIT 1
";

$resultadoAdmin = pg_query(
    $conn,
    $queryAdmin
);

$admin = pg_fetch_assoc(
    $resultadoAdmin
);

if(!$admin){
    die("No existe un administrador registrado");
}

/* =========================
   MENSAJE
========================= */

$mensaje =

"Su cuenta ha sido reactivada por la administración.

Ya puede volver a utilizar la plataforma con normalidad.";

/* =========================
   CREAR NOTIFICACION
========================= */

pg_query_params(

    $conn,

    "
    INSERT INTO notificaciones(

        id_usuario,
        mensaje

    )

    VALUES(

        $1,
        $2

    )
    ",

    array(

        $id_usuario,
        $mensaje

    )

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
        'Desbloqueó un usuario'
    )
);

/* =========================
   REDIRECCION
========================= */

pg_query(
    $conn,
    "
    UPDATE reportes
    SET estado = 'Resuelto'
    WHERE reportado = $id_usuario
    "
);

header(
    "Location: Listar_Reportes.php"
);

exit();

?>
