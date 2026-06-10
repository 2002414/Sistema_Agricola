<?php

include("../../Config/conexion.php");

include("../../Config/Mensajes.php");

$id = $_POST['id_producto'];

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$categoria = $_POST['categoria'];

$query = "UPDATE productos
          SET
              nombre = $1,
              descripcion = $2,
              precio = $3,
              stock = $4,
              categoria = $5
          WHERE id_producto = $6";

$resultado = pg_query_params(
    $conn,
    $query,
    array(
        $nombre,
        $descripcion,
        $precio,
        $stock,
        $categoria,
        $id
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
        'Agregó un producto'
    )
);

if($resultado){

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
    "Producto actualizado correctamente"

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
    "Error al actualizar producto"

);

?>

</body>

</html>

<?php

}
?>