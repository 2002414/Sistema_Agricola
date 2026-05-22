<?php

include("../../Config/Middleware/Validar_Admin.php");

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

/* =========================
   OBTENER ID
========================= */

$id = $_GET['id'];

/* =========================
   ELIMINAR USUARIO
========================= */

$query = "
    DELETE FROM usuarios
    WHERE id_usuario = $1
";

$resultado = pg_query_params(

    $conn,

    $query,

    array($id)

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

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Eliminar Usuario</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<meta http-equiv="refresh"
      content="2;url=Listar_Usuarios.php">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "warning",
    "Usuario eliminado correctamente"

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

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Error</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "danger",
    "Error al eliminar usuario"

);

?>

</body>

</html>

<?php

}

?>