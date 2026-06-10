<?php

session_start();

include("../../Config/conexion.php");

if(!isset($_SESSION['usuario'])){

    header("Location: ../../index.php");

    exit();

}

$id_usuario = $_SESSION['id_usuario'];

$receptor = $_GET['id'];

/* =========================
   MARCAR LEIDOS
========================= */

pg_query_params(

    $conn,

    "
    UPDATE mensajes
    SET leido = TRUE
    WHERE receptor = $1
    ",

    array(
        $_SESSION['id_usuario']
    )

);

$queryProductor = "

SELECT nombre

FROM usuarios

WHERE id_usuario = $1

";

$resultadoProductor = pg_query_params(

    $conn,

    $queryProductor,

    array($receptor)

);

$datosProductor = pg_fetch_assoc(

    $resultadoProductor

);

/* =========================
   MENSAJES DEL USUARIO
========================= */
$query = "

SELECT

m.*,

TO_CHAR(

m.fecha,

'DD/MM/YYYY HH24:MI:SS'

)

AS fecha_formateada

FROM mensajes m

WHERE

(

m.emisor = $1

AND

m.receptor = $2

)

OR

(

m.emisor = $2

AND

m.receptor = $1

)

ORDER BY m.fecha ASC

";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $id_usuario,

        $receptor

    )

);

?>

<!DOCTYPE html>

	<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Mensajes</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background:#f4f6f9;

}

.CardMensajes{

    border:none;

    border-radius:20px;

}

.Titulo{

    color:#198754;

    font-weight:bold;

}

.Chat{

    height:550px;

    overflow-y:auto;

}

.BurbujaMia{

    background:#198754;

    color:white;

    border-radius:20px;

    padding:15px;

    max-width:70%;

}

.BurbujaOtro{

    background:white;

    color:black;

    border-radius:20px;

    padding:15px;

    max-width:70%;

}

</style>

</head>

<body>

<div class="container mt-5">

<a
href="../../dashboard.php"
class="btn btn-secondary mb-4"
>

← Volver

</a>

<div class="card CardMensajes shadow">

<div class="card-body">

<div class="d-flex justify-content-between mb-4">

<h2 class="Titulo">

<i class="fa-solid fa-comments"></i>

Conversación con el Productor

</h2>

</div>

<div class="Chat">

<?php

while(

$fila =

pg_fetch_assoc(

$resultado

)

){

?>

<div class="mb-3">

<?php

if(

$fila['emisor']

==

$_SESSION['id_usuario']

){

?>

<div class="alert alert-success">

<strong>

Yo

</strong>

<br><br>

<?php

echo nl2br(

$fila['mensaje']

);

?>

<br><br>

<small>

<?php

echo $fila['fecha_formateada'];

?>

</small>

</div>

<?php

}else{

?>

<div class="alert alert-light border">

<strong>

<?php

echo $datosProductor['nombre'];

?>

</strong>

<br><br>

<?php

echo nl2br(

$fila['mensaje']

);

?>

<br><br>

<small>

<?php

echo $fila['fecha_formateada'];

?>

</small>

</div>

<?php

}

?>

</div>

<?php

}

?>

<hr>

<form

action="Guardar_Mensaje.php"

method="POST"

>

<input

type="hidden"

name="receptor"

value="<?php echo $receptor; ?>"

>

<input

type="hidden"

name="chat_producto"

value="1"

>

<div class="mb-3">

<textarea

class="form-control"

name="mensaje"

rows="4"

placeholder="Escriba su mensaje..."

required

></textarea>

</div>

<button

type="submit"

class="btn btn-success w-100"

>

<i class="fa-solid fa-paper-plane"></i>

Enviar

</button>

</form>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
