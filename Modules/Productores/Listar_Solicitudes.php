<?php

include("../../Config/Middleware/Validar_Admin.php");

include("../../Config/conexion.php");

$query = "

    SELECT *

    FROM solicitudes_productor

    ORDER BY fecha DESC

";

$resultado = pg_query(

    $conn,

    $query

);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Solicitudes Productor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

.table td,
.table th{

    vertical-align: middle;

}

/* ID */

.ColumnaID{

    text-align: center;

}

/* Nombre */

.ColumnaNombre{

    text-align: left;

    vertical-align: middle;

}

/* Apellido */

.ColumnaApellido{

    text-align: left;

    vertical-align: middle;

}

/* DPI */

.ColumnaDpi{

    text-align: left;

    vertical-align: middle;

}

/* Estado */

.ColumnaEstado{

    text-align: left;

    vertical-align: middle;

}

/* Acciones */

.ColumnaAcciones{

    text-align: center;

    vertical-align: middle;

}

</style>

</head>

<body class="bg-light">

<div class="container mt-5">

<a
href="../../dashboard.php"
class="btn btn-secondary mb-3"

>

← Volver

</a>

<div class="card shadow">

<div class="card-body">

<h2 class="text-warning">

🌾 Solicitudes de Productor

</h2>

<hr>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Apellido</th>

<th>Teléfono</th>

<th>DPI</th>

<th>Estado</th>

<th>Documento</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php
while($fila = pg_fetch_assoc($resultado)){
?>

<tr>

<td class="ColumnaID">
    <?php echo $fila['id_solicitud']; ?>
</td>

<td class="ColumnaNombre">
    <?php echo $fila['nombre']; ?>
</td>

<td class="ColumnaApellido">
    <?php echo $fila['apellido']; ?>
</td>

<td><?php echo $fila['telefono']; ?></td>

<td class="ColumnaDpi">
    <?php echo $fila['dpi']; ?>
</td>

<td class="ColumnaEstado">
    <?php echo $fila['estado']; ?>
</td>

<td style="vertical-align: top;">

<?php

$consultaDocumentos = pg_query_params(

    $conn,

    "
    SELECT archivo
    FROM documentos_productor
    WHERE id_solicitud = $1
    ",

    array(

        $fila['id_solicitud']

    )

);

while(

    $documento =

    pg_fetch_assoc(

        $consultaDocumentos

    )

){

?>

<div class="mb-2">

<a

    href="../../Uploads/Productores/<?php echo $documento['archivo']; ?>"

    target="_blank"

    class="btn btn-info btn-sm w-100 text-start"

>

📄 <?php echo preg_replace('/^[0-9]+_/', '', $documento['archivo']); ?>

</a>

</div>

<?php

}

?>

</td>

</a>

</td>

<td class="ColumnaAcciones">

<?php

if($fila['estado'] == 'PENDIENTE'){

?>

<a
    href="Aprobar_Solicitud.php?id=<?php echo $fila['id_solicitud']; ?>"
    class="btn btn-success btn-sm"
>
Aprobar
</a>

<a
    href="Rechazar_Solicitud.php?id=<?php echo $fila['id_solicitud']; ?>"
    class="btn btn-danger btn-sm"
>
Rechazar
</a>

<?php

}else{

    echo "<strong>".$fila['estado']."</strong>";

}

?>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>
