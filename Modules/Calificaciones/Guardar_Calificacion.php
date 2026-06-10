<?php

session_start();

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

/* =========================
   VARIABLES
========================= */

$id_pedido = $_POST['id_pedido'];

$comprador = $_SESSION['usuario'];

$estrellas = $_POST['estrellas'];

$comentario = $_POST['comentario'];

/* =========================
   PRODUCTOR
========================= */

$productor = "Productor";

/* =========================
   INSERTAR CALIFICACIÓN
========================= */

$query = "
    INSERT INTO calificaciones(

        id_pedido,
        productor,
        comprador,
        estrellas,
        comentario

    )
    VALUES(

        $1,
        $2,
        $3,
        $4,
        $5

    )
";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $id_pedido,
        $productor,
        $comprador,
        $estrellas,
        $comentario

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
      content="2;url=../Pedidos/Listar_Pedido.php">

</head>

<body class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-4"
>

    ← Volver

</a>

<?php

Mensaje(

    "success",
    "Calificación enviada correctamente"

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
    "Error al guardar calificación"

);

?>

</body>

</html>

<?php

}

?>