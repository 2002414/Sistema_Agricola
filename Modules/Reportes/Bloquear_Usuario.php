<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   DATOS
========================= */

$id_usuario = $_POST['id_usuario'];

$id_reporte = $_POST['id_reporte'];

$motivo_bloqueo =
    $_POST['motivo_bloqueo'];
/* =========================
   BLOQUEAR USUARIO
========================= */

$query = "
    UPDATE usuarios
    SET estado = 'BLOQUEADO'
    WHERE id_usuario = $1
";

pg_query_params(
    $conn,
    $query,
    array($id_usuario)
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

    VALUES(

        $1,
        $2,
        $3

    )
    ",

    array(

        $_SESSION['id_usuario'],
        $_SESSION['usuario'],
        'Bloqueó un usuario'

    )

);

/* =========================
   OBTENER MOTIVO
========================= */

$queryReporte = "
    SELECT *
    FROM reportes
    WHERE id_reporte = $1
";

$resultadoReporte = pg_query_params(
    $conn,
    $queryReporte,
    array($id_reporte)
);

$reporte = pg_fetch_assoc(
    $resultadoReporte
);

/* =========================
   GUARDAR MOTIVO BLOQUEO
========================= */

$queryGuardarMotivo = "
    UPDATE reportes
    SET motivo_bloqueo = $1
    WHERE id_reporte = $2
";

pg_query_params(
    $conn,
    $queryGuardarMotivo,
    array(
        $motivo_bloqueo,
        $id_reporte
    )
);

/* =========================
   BUSCAR ADMINISTRADOR
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

$id_admin = $admin['id_usuario'];

/* =========================
   MENSAJE AUTOMATICO
========================= */

$mensaje =

"Su cuenta ha sido bloqueada temporalmente.

Motivo del bloqueo:

".$motivo_bloqueo."

Si considera que existe un error, comuníquese con la administración.";

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
   REPORTE RESUELTO
========================= */

$queryEstado = "
    UPDATE reportes
    SET estado = 'Bloqueado'
    WHERE id_reporte = $1
";

pg_query_params(
    $conn,
    $queryEstado,
    array($id_reporte)
);

/* =========================
   REDIRECCION
========================= */

header(
    "Location: Listar_Reportes.php"
);

exit();

?>
