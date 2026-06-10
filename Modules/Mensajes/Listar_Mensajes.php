<?php

session_start();

include("../../Config/conexion.php");

if(!isset($_SESSION['usuario'])){

    header("Location: ../../index.php");
    exit();

}

$id_usuario = $_SESSION['id_usuario'];

$query = "

SELECT DISTINCT

CASE
WHEN emisor = $1 THEN receptor
ELSE emisor
END AS id_chat,

u.nombre

FROM mensajes

LEFT JOIN usuarios u

ON u.id_usuario =

CASE
WHEN emisor = $1 THEN receptor
ELSE emisor
END

WHERE emisor = $1
OR receptor = $1

ORDER BY u.nombre

";

$resultado = pg_query_params(
    $conn,
    $query,
    array($id_usuario)
);

?>

<!DOCTYPE html>

<html lang='es'>

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

<meta charset='UTF-8'>

<title>Mensajes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

a{

    text-decoration:none;

}

.ChatCard{

    transition:.3s;

}

.ChatCard:hover{

    transform:scale(1.02);

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

<a

href="Crear_Mensaje.php"

class="btn btn-success mb-4 ms-2"

>

<i class="fa-solid fa-plus"></i>

Nuevo Mensaje

</a>

<div class="card CardMensajes shadow">

<div class="card-body">

<h2 class="Titulo mb-4">

<i class="fa-solid fa-comments"></i>

Mensajes

</h2>

<?php

while($chat = pg_fetch_assoc($resultado)){

?>

<a

href="Abrir_Chat.php?id=<?php echo $chat['id_chat']; ?>"

>

<div class="card shadow mb-3 ChatCard">

<div class="card-body">

<h4 class="text-success">

<i class="fa-solid fa-user"></i>

<?php echo $chat['nombre']; ?>

</h4>

<p class="text-muted mb-0">

Abrir conversación

</p>

</div>

</div>

</a>

<?php

}

?>

</div>

</div>

</div>

</body>

</html>
