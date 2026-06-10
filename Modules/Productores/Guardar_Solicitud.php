<?php

include("../../Config/conexion.php");

/* =========================
   DATOS
========================= */

$nombre = $_POST['nombre'];

$apellido = $_POST['apellido'];

$telefono = $_POST['telefono'];

$dpi = $_POST['dpi'];

/* =========================
   VALIDAR TELÉFONO
========================= */

$validarTelefono = pg_query_params(

    $conn,

    "
    SELECT id_usuario
    FROM usuarios
    WHERE telefono = $1
    ",

    array($telefono)

);

if(pg_num_rows($validarTelefono) > 0){

    die("El teléfono ya se encuentra registrado");

}

/* =========================
   VALIDAR DPI
========================= */

$validarDpi = pg_query_params(

    $conn,

    "
    SELECT id_usuario
    FROM usuarios
    WHERE dpi = $1
    ",

    array($dpi)

);

if(pg_num_rows($validarDpi) > 0){

    die("El DPI ya se encuentra registrado");

}

/* =========================
   GUARDAR SOLICITUD
========================= */

$query = "

    INSERT INTO solicitudes_productor(

    nombre,
    apellido,
    telefono,
    dpi

)

VALUES(

    $1,
    $2,
    $3,
    $4

)

RETURNING id_solicitud

";

$resultado = pg_query_params(

    $conn,

    $query,

array(

    $nombre,
    $apellido,
    $telefono,
    $dpi

)

);

$solicitud = pg_fetch_assoc($resultado);

$id_solicitud =
    $solicitud['id_solicitud'];

/* =========================
   DOCUMENTOS
========================= */

foreach(
    $_FILES['documentos']['tmp_name']
    as $indice => $tmp
){

    $nombreArchivo =

        time().'_'.

        $_FILES['documentos']['name'][$indice];

    $rutaDestino =

        "/var/www/html/Uploads/Productores/".

        $nombreArchivo;

    if(

        move_uploaded_file(

            $tmp,

            $rutaDestino

        )

    ){

        pg_query_params(

            $conn,

            "
            INSERT INTO documentos_productor(

                id_solicitud,
                archivo

            )

            VALUES(

                $1,
                $2

            )
            ",

            array(

                $id_solicitud,

                $nombreArchivo

            )

        );

    }else{

        die(

            "No se pudo guardar el archivo: "

            .$nombreArchivo

        );

    }

}


    pg_query_params(

        $conn,

        "
        INSERT INTO documentos_productor(

            id_solicitud,
            archivo

        )

        VALUES(

            $1,
            $2

        )
        ",

        array(

            $id_solicitud,

            $nombreArchivo

        )

    );

if($resultado){

    /* =========================
   CREAR NOTIFICACION
========================= */

pg_query_params(

    $conn,

    "
    INSERT INTO notificaciones(

        id_usuario,
        mensaje

    )

    VALUES(

        $1,
        $2

    )
    ",

    array(

        2,

        'Nueva solicitud de productor pendiente de revisión'

    )

);           

    echo "

    <script>

        alert('Solicitud enviada correctamente');

        window.location='../../productor.php';

    </script>

    ";

}else{

    echo pg_last_error($conn);

}

?>

