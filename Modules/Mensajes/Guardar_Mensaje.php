<?php

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

session_start();

/* =========================
   VARIABLES
========================= */

$remitente = $_SESSION['usuario'];

$destinatario = $_POST['destinatario'];

$mensaje = $_POST['mensaje'];

/* =========================
   FECHA
========================= */

$fecha = date("Y-m-d H:i:s");

/* =========================
   INSERTAR MENSAJE
========================= */

$query = "
    INSERT INTO mensajes(

        remitente,
        destinatario,
        mensaje,
        fecha

    )
    VALUES(

        $1,
        $2,
        $3,
        $4

    )
";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $remitente,
        $destinatario,
        $mensaje,
        $fecha

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

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Mensaje Enviado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<meta http-equiv="refresh"
      content="2;url=Listar_Mensajes.php">

<style>

body{

    background: #f4f6f9;

}

</style>

</head>

<body>

<div class="container mt-5">

<?php

Mensaje(

    "success",
    "Mensaje enviado al destinatario correctamente"

);

?>

<div class="text-center mt-4">

<a
    href="Listar_Mensajes.php"
    class="btn btn-success"
>

    Volver a Mensajes

</a>

</div>

</div>

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

<style>

body{

    background: #f4f6f9;

}

</style>

</head>

<body>

<div class="container mt-5">

<?php

Mensaje(

    "danger",
    "Error al enviar mensaje"

);

?>

<div class="text-center mt-4">

<a
    href="Listar_Mensajes.php"
    class="btn btn-danger"
>

    Volver a Mensajes

</a>

</div>

</div>

</body>

</html>

<?php

}

?>