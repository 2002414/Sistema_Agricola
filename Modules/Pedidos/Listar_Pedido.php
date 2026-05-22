<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   CONSULTAR PEDIDOS
========================= */

$query = "
    SELECT *
    FROM pedidos
    ORDER BY id_pedido DESC
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

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Pedidos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background: #f4f6f9;

}

.CardPedidos{

    border: none;

    border-radius: 20px;

}

.Titulo{

    color: #198754;

    font-weight: bold;

}

</style>

</head>

<body>

<div class="container mt-5">

<!-- VOLVER -->

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-4"
>

    ← Volver Dashboard

</a>

<div class="card CardPedidos shadow">

<div class="card-body">

<h2 class="Titulo mb-4">

    Lista Pedidos

</h2>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-success">

<tr>

<th>
ID Pedido
</th>

<th>
Fecha
</th>

<th>
Estado
</th>

<th>
Total
</th>

<th>
Acciones
</th>

</tr>

</thead>

<tbody>

<?php
while($pedido = pg_fetch_assoc($resultado)){
?>

<tr>

<!-- ID -->

<td>

<?php
echo $pedido['id_pedido'];
?>

</td>

<!-- FECHA -->

<td>

<?php
echo $pedido['fecha'];
?>

</td>

<!-- ESTADO -->

<td>

<?php

if($pedido['estado'] == 'Pendiente'){

    echo "
    <span class='badge bg-secondary'>
        Pendiente
    </span>
    ";

}

elseif($pedido['estado'] == 'En Proceso'){

    echo "
    <span class='badge bg-warning text-dark'>
        En Proceso
    </span>
    ";

}

elseif($pedido['estado'] == 'Entregado'){

    echo "
    <span class='badge bg-success'>
        Entregado
    </span>
    ";

}

?>

</td>

<!-- TOTAL -->

<td>

Q.
<?php
echo $pedido['total'];
?>

</td>

<!-- ACCIONES -->

<td>

<!-- =========================
     COMPRADOR
========================= -->

<?php
if($_SESSION['rol'] == 'comprador'){
?>

<span class="badge bg-primary">

    Seguimiento Pedido

</span>

<?php
if($pedido['estado'] == 'Entregado'){
?>

<a
    href="../Calificaciones/Crear_Calificacion.php?id=<?php echo $pedido['id_pedido']; ?>"
    class="btn btn-warning btn-sm mt-2"
>

    ⭐ Calificar Productor

</a>

<?php
}
?>

<?php
}
?>

<!-- =========================
     PRODUCTOR
========================= -->

<?php
if($_SESSION['rol'] == 'productor'){
?>

<?php
if($pedido['estado'] != 'Entregado'){
?>

<a
    href="Cambiar_Estado.php?id=<?php echo $pedido['id_pedido']; ?>&estado=En Proceso"
    class="btn btn-warning btn-sm"
>

    En Proceso

</a>

<a
    href="Cambiar_Estado.php?id=<?php echo $pedido['id_pedido']; ?>&estado=Entregado"
    class="btn btn-success btn-sm"
>

    Entregado

</a>

<?php
}else{
?>

<span class="badge bg-success">

    Pedido Finalizado

</span>

<?php
}
?>

<?php
}
?>

<!-- =========================
     ADMIN
========================= -->

<?php
if($_SESSION['rol'] == 'admin'){
?>

<span class="badge bg-dark">

    Control Total

</span>

<?php
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

</div>

</body>

</html>