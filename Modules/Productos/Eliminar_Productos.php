<?php

include("../../config/conexion.php");

include("../../Config/Mensajes.php");

$id = $_GET['id'];

$query = "DELETE FROM productos
          WHERE id_producto = $1";

$resultado = pg_query_params(
    $conn,
    $query,
    array($id)
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

    "warning",
    "Producto eliminado correctamente"

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
    "Error al eliminar producto"

);

?>

</body>

</html>

<?php

}
?>