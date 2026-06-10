<?php

session_start();

include("../../Config/conexion.php");

$rol = strtolower(trim($_SESSION['rol']));

/* =========================
   ADMINISTRADOR
========================= */

if(
    $rol == 'Miembro Asociado'
    ||
    $rol == 'admin'
){

    $query = "
        SELECT

            r.*,

            u1.nombre AS reportante_nombre,

            u2.nombre AS reportado_nombre,
	    u2.estado AS estado_usuario

        FROM reportes r

        LEFT JOIN usuarios u1
        ON r.reportante = u1.id_usuario

        LEFT JOIN usuarios u2
        ON r.reportado = u2.id_usuario

        ORDER BY r.fecha DESC
    ";

    $resultado = pg_query(
        $conn,
        $query
    );

}

/* =========================
   COMPRADOR Y PRODUCTOR
========================= */

else{

    $query = "
        SELECT

            r.*,

            u2.nombre AS reportado_nombre,
	    u2.estado AS estado_usuario

        FROM reportes r

        LEFT JOIN usuarios u2
        ON r.reportado = u2.id_usuario

        WHERE r.reportante = $1

        ORDER BY r.fecha DESC
    ";

    $resultado = pg_query_params(
        $conn,
        $query,
        array($_SESSION['id_usuario'])
    );

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<link rel="stylesheet"
href="../../ssets/css/mobile.css">

<meta charset="UTF-8">

<title>Reportes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<a
href="../../dashboard.php"
class="btn btn-secondary mb-3"

>

← Volver

</a>

<a
href="Crear_Reporte.php"
class="btn btn-danger mb-3"

>

Nuevo Reporte

</a>

<?php
if(
    $rol == 'miembro asociado'
    ||
    $rol == 'admin'
){
?>

<div class="mb-3 d-flex gap-2 flex-wrap">

<a
href="Graficas.php"
class="btn btn-success"
>

📈 Gráficas

</a>

<a
href="Calendario.php"
class="btn btn-primary"
>

📅 Calendario

</a>

<a
href="Reporte_Productos_PDF.php"
class="btn btn-danger"
>

📄 PDF

</a>

<a
href="Reporte_Productos_Excel.php"
class="btn btn-warning"
>

📊 Excel

</a>

</div>

<?php
}
?>

<div class="card shadow">

<div class="card-body">

<h2 class="text-danger mb-4">

⚠️ Reportes

</h2>

<div class="table-responsive">

<table class="table table-bordered">

<thead class="table-danger">

<tr>

<th>ID</th>

<?php
if(
    $rol == 'Miembro Asociado'
    ||
    $rol == 'admin'
){
?>

<th>Reportante</th>

<?php
}
?>

<th>Reportado</th>

<th>Motivo</th>

<th>Evidencia</th>

<th>Estado</th>

<th>Fecha</th>

<?php
if(
    $rol == 'miembro asociado'
    ||
    $rol == 'admin'
){
?>

<th>Acciones</th>

<?php
}
?>

</tr>

</thead>

<tbody>

<?php
while($reporte = pg_fetch_assoc($resultado)){
?>

<tr>

<td>
<?php echo $reporte['id_reporte']; ?>

</td>

<?php
if(
    $rol == 'miembro asociado'
    ||
    $rol == 'admin'
){
?>

<td>

<?php echo $reporte['reportante_nombre']; ?>

</td>

<?php
}
?>

<td>

<?php echo $reporte['reportado_nombre']; ?>

</td>

<td>

<?php echo $reporte['motivo']; ?>

</td>

<td>

<?php

if(

!empty($reporte['evidencia'])

){

?>

<a

href="../../Assets/reportes/<?php echo $reporte['evidencia']; ?>"

target="_blank"

class="btn btn-info btn-sm"

>

Ver Evidencia

</a>

<?php

}else{

    echo "Sin evidencia";

}

?>

</td>

<td>

<?php

switch(strtoupper($reporte['estado_usuario'])){

    case 'ACTIVADO':
        echo '<span class="badge bg-success">🟢 Activado</span>';
        break;

    case 'DESACTIVADO':
        echo '<span class="badge bg-warning text-dark">🟡 Desactivado</span>';
        break;

    case 'BLOQUEADO':
        echo '<span class="badge bg-danger">🔴 Bloqueado</span>';
        break;

    default:
        echo '<span class="badge bg-secondary">Desconocido</span>';
}

?>

</td>

<td>

<?php 
echo date(
    "d/m/Y H:i:s",
    strtotime($reporte['fecha'])
);
?>

</td>

<?php
if(
    $rol == 'miembro asociado'
    ||
    $rol == 'admin'
){
?>

<td>

<?php
if(strtoupper($reporte['estado_usuario']) == 'BLOQUEADO'){
?>

<a
href="Desbloquear_Usuario.php?id=<?php echo $reporte['reportado']; ?>"
class="btn btn-success btn-sm"
>

Desbloquear

</a>

<?php
}else{
?>

<a
href="Confirmar_Bloqueo.php?id=<?php echo $reporte['reportado']; ?>&reporte=<?php echo $reporte['id_reporte']; ?>"
class="btn btn-danger btn-sm"
>

Bloquear

</a>

<a
href="Eliminar_Reporte.php?id=<?php echo $reporte['id_reporte']; ?>"
class="btn btn-secondary btn-sm mt-1"
onclick="return confirm('¿Desea eliminar este reporte?')"
>

Eliminar

</a>

<?php
}
?>

</td>

<?php
}
?>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>

</html>
