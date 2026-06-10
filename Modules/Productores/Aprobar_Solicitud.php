<?php

include("../../Config/conexion.php");

$id = $_GET['id'];

/* =========================
   GUARDAR APROBACIÓN
========================= */

if(isset($_POST['codigo_mensaje'])){

    $codigo = $_POST['codigo_mensaje'];

    /* =========================
       VALIDAR CÓDIGO
    ========================= */

    $validar = pg_query_params(

        $conn,

        "
        SELECT id_usuario
        FROM usuarios
        WHERE codigo_mensaje = $1
        ",

        array($codigo)

    );

    if(pg_num_rows($validar) > 0){

        die(

            "El Código de Mensaje ya existe."

        );

    }

    /* =========================
       OBTENER SOLICITUD
    ========================= */

    $resultado = pg_query_params(

        $conn,

        "
        SELECT *
        FROM solicitudes_productor
        WHERE id_solicitud = $1
        ",

        array($id)

    );

    $solicitud = pg_fetch_assoc(
        $resultado
    );

    /* =========================
       CREAR PRODUCTOR
    ========================= */

    pg_query_params(

        $conn,

        "
        INSERT INTO usuarios(

            nombre,
            telefono,
            dpi,
            codigo_mensaje,
            rol,
            estado

        )

        VALUES(

            $1,
            $2,
            $3,
            $4,
            'productor',
            'ACTIVADO'

        )
        ",

        array(

            $solicitud['nombre']
            .' '.
            $solicitud['apellido'],

            $solicitud['telefono'],

            $solicitud['dpi'],

            $codigo

        )

    );

    /* =========================
       ACTUALIZAR SOLICITUD
    ========================= */

    pg_query_params(

        $conn,

        "
        UPDATE solicitudes_productor

        SET

            estado = 'APROBADA',

            codigo_mensaje = $2

        WHERE id_solicitud = $1
        ",

        array(

            $id,

            $codigo

        )

    );

    header(

        "Location: Listar_Solicitudes.php"

    );

    exit();

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>

Aprobar Solicitud

</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-success">

🌾 Aprobar Solicitud

</h2>

<hr>

<form method="POST">

<label>

Código de Mensaje

</label>

<input

    type="text"

    name="codigo_mensaje"

    class="form-control"

    placeholder="Ejemplo: PROD-0001"

    required

>

<br>

<button
class="btn btn-success w-100"
>

Confirmar Aprobación

</button>

<a

href="Listar_Solicitudes.php"

class="btn btn-secondary w-100 mt-2"

>

Cancelar

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
