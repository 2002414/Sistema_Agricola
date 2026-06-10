<?php

session_start();

include("../../Config/conexion.php");

include("../../Config/Historial.php");

include("../../Config/Mensajes.php");

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$categoria = $_POST['categoria'];
$id_usuario = $_SESSION['id_usuario'];

$imagen = "";

if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){

    $imagen = $_FILES['imagen']['name'];

    $tmp = $_FILES['imagen']['tmp_name'];

    move_uploaded_file(
        $tmp,
        "../../Assets/img/" . $imagen
    );
}

$query = "INSERT INTO productos(
    nombre,
    descripcion,
    precio,
    stock,
    categoria,
    imagen,
    id_usuario
)
VALUES(
    $1,
    $2,
    $3,
    $4,
    $5,
    $6,
    $7
)";

$resultado = pg_query_params(
    $conn,
    $query,
    
    array(
    $nombre,
    $descripcion,
    $precio,
    $stock,
    $categoria,
    $imagen,
    $_SESSION['id_usuario']
)
);

if($resultado){

/* =========================
   HISTORIAL PRODUCTO
========================= */

RegistrarHistorial(

    $conn,

    $_SESSION['id_usuario'],

    $_SESSION['usuario'],

    'Creó producto: '.$nombre

);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<meta http-equiv="refresh"
      content="2;url=Listar_Productos.php">

</head>

<body class="container mt-5">

<?php

Mensaje(

    "success",
    "Producto guardado correctamente"

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
    "Error al guardar producto"

);

?>

</body>

</html>

<?php

}
?>
