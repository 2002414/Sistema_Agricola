<?php

include("../../Config/Middleware/Validar_Admin.php");

include("../../Config/conexion.php");

/* =========================
   DATOS
========================= */

$nombre = $_POST['nombre'];

$correo = $_POST['correo'];

$password = $_POST['password'];

$confirmar = $_POST['confirmar'];

/* =========================
   VALIDAR CONTRASEÑAS
========================= */

if($password != $confirmar){

    die("Las contraseñas no coinciden");

}

/* =========================
   VALIDAR CORREO
========================= */

$validar = pg_query_params(

    $conn,

    "
    SELECT id_usuario

    FROM usuarios

    WHERE correo = $1
    ",

    array($correo)

);

if(

    pg_num_rows($validar) > 0

){

    die("El correo ya existe");

}

/* =========================
   GUARDAR ADMINISTRADOR
========================= */

pg_query_params(

    $conn,

    "
    INSERT INTO usuarios(

        nombre,
        correo,
        password,
        rol,
        estado

    )

    VALUES(

        $1,
        $2,
        $3,
        'admin',
        'ACTIVADO'

    )
    ",

    array(

        $nombre,

        $correo,

        password_hash(

            $password,

            PASSWORD_DEFAULT

        )

    )

);

/* =========================
   REDIRECCIONAR
========================= */

header(

    "Location: Listar_Usuarios.php"

);

exit();

?>
