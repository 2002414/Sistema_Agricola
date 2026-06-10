<?php

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

session_start();

/* =========================
   OBTENER DATOS
========================= */

$id = $_GET['id'];

$estado = $_GET['estado'];

/* =========================
   VALIDAR SI YA ESTÁ ENTREGADO
========================= */

$queryValidar = "
    SELECT estado
    FROM pedidos
    WHERE id_pedido = $1
";

$resultadoValidar = pg_query_params(

    $conn,

    $queryValidar,

    array($id)

);

$pedido = pg_fetch_assoc(
    $resultadoValidar
);

/* =========================
   SI YA ESTÁ ENTREGADO
========================= */

if($pedido['estado'] == 'Entregado'){

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<meta http-equiv="refresh"
      content="2;url=Listar_Pedido.php">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "warning",
    "El pedido ya fue entregado y no puede modificarse"

);

?>

</body>

</html>

<?php

exit();

}

/* =========================
   ACTUALIZAR ESTADO
========================= */

$query = "
    UPDATE pedidos
    SET estado = $1
    WHERE id_pedido = $2
";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $estado,
        $id

    )

);

/* =========================
   VALIDAR
========================= */

if($resultado){

    /* =========================
       MENSAJE
    ========================= */

    $mensaje = "";

    /* =========================
       EN PROCESO
    ========================= */

if($estado == "Aceptado por el Productor"){

    $mensaje =
    "Pedido aceptado correctamente";

}

elseif($estado == "Pedido Rechazado"){

    $mensaje =
    "Pedido rechazado correctamente";

}

elseif($estado == "En Proceso de Entrega"){

    $mensaje =
    "Pedido enviado a proceso de entrega";

}

    /* =========================
       ENTREGADO
    ========================= */

elseif($estado == "Entregado"){

    $mensaje =
    "Pedido entregado correctamente";

}

else{

    $mensaje =
    "Estado actualizado correctamente";

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<meta http-equiv="refresh"
      content="2;url=Listar_Pedido.php">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "success",
    $mensaje

);

?>

<div class="mt-4">

<a
    href="Listar_Pedido.php"
    class="btn btn-success"
>

    Volver a Pedidos

</a>

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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "danger",
    "Error al actualizar pedido"

);

?>

<div class="mt-4">

<a
    href="Listar_Pedido.php"
    class="btn btn-danger"
>

    Volver a Pedidos

</a>

</div>

</body>

</html>

<?php

}

?>
