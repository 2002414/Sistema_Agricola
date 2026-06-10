<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   DATOS
========================= */

$reportante = $_SESSION['id_usuario'];

$reportado = $_POST['reportado'];

$motivo = $_POST['motivo'];

/* =========================
   EVIDENCIA
========================= */

$evidencia = "";

if(

isset($_FILES['evidencia'])

&&

$_FILES['evidencia']['error'] == 0

){

    $evidencia =

    time()

    ."_"

    .basename(

        $_FILES['evidencia']['name']

    );

    move_uploaded_file(

        $_FILES['evidencia']['tmp_name'],

        "../../Assets/reportes/"

        .$evidencia

    );

}

/* =========================
   GUARDAR REPORTE
========================= */

$query = "

INSERT INTO reportes(

    reportante,
    reportado,
    motivo,
    evidencia

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

        $reportante,
        $reportado,
        $motivo,
	$evidencia

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
        'Creó un reporte'
    )
);

/* =========================
   HISTORIAL
========================= */

$queryHistorial = "
    INSERT INTO historial_actividades(

        usuario,
        accion

    )
    VALUES(

        $1,
        $2

    )
";

pg_query_params(

    $conn,

    $queryHistorial,

    array(

        $_SESSION['usuario'],

        'Creó un reporte'

    )

);

/* =========================
   REDIRECCION
========================= */

header(
    "Location: Listar_Reportes.php"
);

exit();

?>
