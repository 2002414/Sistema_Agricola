<?php

include("../../Config/conexion.php");

/* =========================
   VARIABLES
========================= */

$nombre = $_POST['nombre'];

$rol = "comprador";

$telefono = $_POST['telefono'] ?? null;



$verificar = pg_query_params(
    $conn,
    "SELECT id_usuario FROM usuarios WHERE telefono = $1",
    array($telefono)
);

if(pg_num_rows($verificar) > 0){

    echo "
    <script>
        alert('Este número de teléfono ya está registrado');
        window.location='Registro_Publico.php';
    </script>
    ";

    exit();
}

/* =========================
   INSERTAR
========================= */

$query = "
    INSERT INTO usuarios(
        nombre,
        rol,
        telefono,
        estado
    )
    VALUES(
        $1,
        $2,
        $3,
        'ACTIVADO'
    )
";

$resultado = pg_query_params(

    $conn,

    $query,

    array(

        $nombre,
        $rol,
        $telefono
    )

);

/* =========================
   VALIDAR
========================= */
if(!$resultado){

    echo pg_last_error($conn);

}

if($resultado){

    echo "
    <script>

        alert('Registro exitoso');

        window.location='../../index.php';

    </script>
    ";

}else{

    echo "
    <script>

        alert('Error al registrar');

        window.location='Registro_Publico.php';

    </script>
    ";

}

?>
