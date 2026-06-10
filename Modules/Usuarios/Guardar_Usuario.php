<?php

include("../../Config/Middleware/Validar_Admin.php");

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

/* =========================
   VARIABLES
========================= */

$nombre = $_POST['nombre'];

$correo = $_POST['correo'] ?? null;

$password = null;

if(
    isset($_POST['password'])
    &&
    !empty($_POST['password'])
){

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

}

$rol = $_POST['rol'];

$telefono = $_POST['telefono'] ?? null;

$dpi = $_POST['dpi'] ?? null;

$codigo_mensaje = $_POST['codigo_mensaje'] ?? null;

/* =========================
   INSERTAR USUARIO
========================= */

$query = "
    INSERT INTO usuarios(
        nombre,
        correo,
        password,
        rol,
        telefono,
        dpi,
        codigo_mensaje
    )
    VALUES(
        $1,
        $2,
        $3,
        $4,
        $5,
        $6,
        $7
    )
";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $nombre,
        $correo,
        $password,
        $rol,
        $telefono,
        $dpi,
        $codigo_mensaje

    )

);

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
    "Usuario guardado correctamente"

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
    "Error al guardar usuario"

);

?>

</body>

</html>

<?php

}
?>