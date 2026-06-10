<?php

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

session_start();

/* =========================
   VARIABLES
========================= */

$remitente = $_SESSION['id_usuario'];

if(
    !isset($_POST['receptor'])
    ||
    empty($_POST['receptor'])
){
    die("No se seleccionó un destinatario");
}

$destinatario = $_POST['receptor'];

$mensaje = $_POST['mensaje'];

$chat_producto = false;

if(

isset($_POST['chat_producto'])

&&

$_POST['chat_producto'] == "1"

){

    $chat_producto = true;

}

/* =========================
   INSERTAR MENSAJE
========================= */
$query = "
    INSERT INTO mensajes(

        emisor,
        receptor,
        mensaje

    )

    VALUES(

        $1,
        $2,
        $3

    )
";


$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $remitente,
        $destinatario,
        $mensaje

    )

);

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
        'Envió un mensaje'
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

<?php

if($chat_producto){

?>

<meta

http-equiv="refresh"

content="2;url=Chat_Producto.php?id=<?php echo $destinatario; ?>"

>

<?php

}else{

?>

<meta

http-equiv="refresh"

content="2;url=Listar_Mensajes.php"

>

<?php

}

?>

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

href="<?php

if($chat_producto){

echo "Chat_Producto.php?id=".$destinatario;

}else{

echo "Listar_Mensajes.php";

}

?>"

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
