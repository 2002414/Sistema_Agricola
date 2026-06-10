<?php

include("../../Config/conexion.php");

/* =========================
   DATOS
========================= */

$telefono = $_POST['telefono'];

$dpi = $_POST['dpi'];

/* =========================
   BUSCAR SOLICITUD
========================= */

$query = "

    SELECT *

    FROM solicitudes_productor

    WHERE telefono = $1

    AND dpi = $2

";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $telefono,

        $dpi

    )

);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>

Estado de Solicitud

</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-body p-5">

<h2 class="text-center text-success">

🌾 Estado de Solicitud

</h2>

<hr>

<?php

if(

    pg_num_rows($resultado) == 0

){

?>

<div class="alert alert-danger">

No se encontró ninguna solicitud.

</div>

<?php

}else{

    $fila = pg_fetch_assoc(

        $resultado

    );

    if(

        $fila['estado']

        ==

        'PENDIENTE'

    ){

?>

<div class="alert alert-warning">

<h4>

🟡 PENDIENTE

</h4>

Su solicitud está siendo revisada.

</div>

<?php

    }

    if(

        $fila['estado']

        ==

        'RECHAZADA'

    ){

?>

<div class="alert alert-danger">

<h4>

🔴 RECHAZADA

</h4>

Su solicitud fue rechazada.

Comuníquese con la administración.

</div>

<?php

    }

    if(

        $fila['estado']

        ==

        'APROBADA'

    ){

?>

<div class="alert alert-success">

<h4>

🟢 APROBADA

</h4>

Su solicitud fue aprobada.

<br><br>

Su Código de Mensaje es:

<br><br>

<strong>

<?php

echo $fila['codigo_mensaje'];

?>

</strong>

</div>

<?php

    }

}

?>

<a
href="../../Consultar_Solicitud.php"
class="btn btn-secondary w-100"
>

Volver

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
