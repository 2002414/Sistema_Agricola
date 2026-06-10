<?php

session_start();

include("../../Config/conexion.php");

$id_usuario = $_SESSION['id_usuario'];

$actual = $_POST['actual'];
$nueva = $_POST['nueva'];
$confirmar = $_POST['confirmar'];

/* =========================
   VALIDAR NUEVA PASSWORD
========================= */

if($nueva != $confirmar){

    die("Las contraseñas no coinciden");

}

/* =========================
   OBTENER USUARIO
========================= */

$query = "
    SELECT *
    FROM usuarios
    WHERE id_usuario = $1
";

$resultado = pg_query_params(
    $conn,
    $query,
    array($id_usuario)
);

$usuario = pg_fetch_assoc($resultado);

/* =========================
   VALIDAR PASSWORD ACTUAL
========================= */

if(
    !password_verify(
        $actual,
        $usuario['password']
    )
){

    die("La contraseña actual es incorrecta");

}

/* =========================
   ACTUALIZAR PASSWORD
========================= */

$nuevoHash = password_hash(
    $nueva,
    PASSWORD_DEFAULT
);

$queryUpdate = "
    UPDATE usuarios
    SET password = $1
    WHERE id_usuario = $2
";

pg_query_params(
    $conn,
    $queryUpdate,
    array(
        $nuevoHash,
        $id_usuario
    )
);

/* =========================
   REDIRECCION
========================= */

header(
    "Location: Ver_Perfil.php"
);

exit();

?>