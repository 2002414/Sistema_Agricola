<?php

include("../../Config/Middleware/Validar_Admin.php");

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

/* =========================
   VARIABLES
========================= */

$id = $_POST['id_usuario'];

$nombre = $_POST['nombre'];

$rol = $_POST['rol'];

$telefono = $_POST['telefono'] ?? null;

$dpi = $_POST['dpi'] ?? null;

$codigo_mensaje = $_POST['codigo_mensaje'] ?? null;

$correo = $_POST['correo'] ?? null;

$password = $_POST['password'] ?? null;

/* =========================
   ADMIN
========================= */

if($rol == "admin"){

    /* =========================
       ACTUALIZAR CON PASSWORD
    ========================= */

    if(!empty($password)){

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $query = "
            UPDATE usuarios
            SET
            nombre = $1,
            rol = $2,
            correo = $3,
            password = $4
            WHERE id_usuario = $5
        ";

        $resultado = pg_query_params(

            $conn,

            $query,

            array(
                $nombre,
                $rol,
                $correo,
                $passwordHash,
                $id
            )

        );

    }

    /* =========================
       SIN PASSWORD
    ========================= */

    else{

        $query = "
            UPDATE usuarios
            SET
            nombre = $1,
            rol = $2,
            correo = $3
            WHERE id_usuario = $4
        ";

        $resultado = pg_query_params(

            $conn,

            $query,

            array(
                $nombre,
                $rol,
                $correo,
                $id
            )

        );

    }

}

/* =========================
   PRODUCTOR
========================= */

elseif($rol == "productor"){

    $query = "
        UPDATE usuarios
        SET
        nombre = $1,
        rol = $2,
        telefono = $3,
        dpi = $4,
        codigo_mensaje = $5,
        correo = NULL,
        password = NULL
        WHERE id_usuario = $6
    ";

    $resultado = pg_query_params(

        $conn,

        $query,

        array(
            $nombre,
            $rol,
            $telefono,
            $dpi,
            $codigo_mensaje,
            $id
        )

    );

}

/* =========================
   COMPRADOR
========================= */

elseif($rol == "comprador"){

    $query = "
        UPDATE usuarios
        SET
        nombre = $1,
        rol = $2,
        telefono = $3,
        dpi = NULL,
        codigo_mensaje = NULL,
        correo = NULL,
        password = NULL
        WHERE id_usuario = $4
    ";

    $resultado = pg_query_params(

        $conn,

        $query,

        array(
            $nombre,
            $rol,
            $telefono,
            $id
        )

    );

}

/* =========================
   VALIDAR
========================= */

if($resultado){

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<meta http-equiv="refresh"
      content="2;url=Listar_Usuarios.php">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "success",
    "Usuario actualizado correctamente"

);

?>

</body>

</html>

<?php

}else{

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "danger",
    "Error al actualizar usuario"

);

?>

</body>

</html>

<?php

}
?>