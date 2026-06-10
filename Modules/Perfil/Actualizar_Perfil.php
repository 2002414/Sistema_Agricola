<?php

session_start();

include("../../Config/conexion.php");

$id_usuario = $_SESSION['id_usuario'];

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];

/* =========================
   CONSULTAR USUARIO
========================= */

$queryUsuario = "
    SELECT *
    FROM usuarios
    WHERE id_usuario = $1
";

$resultadoUsuario = pg_query_params(
    $conn,
    $queryUsuario,
    array($id_usuario)
);

$usuario = pg_fetch_assoc($resultadoUsuario);

/* =========================
   FOTO
========================= */

$foto = $usuario['foto'];

if(
    isset($_FILES['foto'])
    &&
    $_FILES['foto']['error'] == 0
){

    $nombreFoto =
        time()
        . "_"
        . basename($_FILES['foto']['name']);

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "Fotos/".$nombreFoto
    );

    $foto = $nombreFoto;

}

/* =========================
   PRODUCTOR
========================= */

if($usuario['rol'] == 'productor'){

    $dpi = $_POST['dpi'];

    $codigo_mensaje =
        $_POST['codigo_mensaje'];

    $query = "
        UPDATE usuarios
        SET
            nombre = $1,
            telefono = $2,
            dpi = $3,
            codigo_mensaje = $4,
            foto = $5
        WHERE id_usuario = $6
    ";

    pg_query_params(
        $conn,
        $query,
        array(
            $nombre,
            $telefono,
            $dpi,
            $codigo_mensaje,
            $foto,
            $id_usuario
        )
    );

}

/* =========================
   ASOCIADO O ADMIN
========================= */

elseif(
    $usuario['rol'] == 'miembro asociado'
    ||
    $usuario['rol'] == 'admin'
){

    $correo = $_POST['correo'];

    $query = "
        UPDATE usuarios
        SET
            nombre = $1,
            telefono = $2,
            correo = $3,
            foto = $4
        WHERE id_usuario = $5
    ";

    pg_query_params(
        $conn,
        $query,
        array(
            $nombre,
            $telefono,
            $correo,
            $foto,
            $id_usuario
        )
    );

}

/* =========================
   COMPRADOR
========================= */

else{

    $query = "
        UPDATE usuarios
        SET
            nombre = $1,
            telefono = $2,
            foto = $3
        WHERE id_usuario = $4
    ";

    pg_query_params(
        $conn,
        $query,
        array(
            $nombre,
            $telefono,
            $foto,
            $id_usuario
        )
    );

}

/* =========================
   ACTUALIZAR SESION
========================= */

$_SESSION['usuario'] = $nombre;

/* =========================
   REDIRECCION
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
        'Actualizó su perfil'
    )
);

header(
    "Location: Ver_Perfil.php"
);

exit();

?>