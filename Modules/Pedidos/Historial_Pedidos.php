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

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Historial Pedidos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background: #f4f6f9;

}

.CardHistorial{

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

    ← Volver 

</a>

<div class="card CardHistorial shadow">

<div class="card-body">

<h2 class="Titulo mb-4">

    Historial Pedidos

</h2>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-success">

<tr>

<th>
Pedido
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
Seguimiento
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

Pedido #
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

/* =========================
   PENDIENTE
========================= */

if($pedido['estado'] == 'Pendiente'){

?>

<span class="badge bg-secondary">

    Pendiente

</span>

<?php
}
?>

<?php

/* =========================
   EN PROCESO
========================= */

if($pedido['estado'] == 'En Proceso'){

?>

<span class="badge bg-warning text-dark">

    En Proceso

</span>

<?php
}
?>

<?php

/* =========================
   ENTREGADO
========================= */

if($pedido['estado'] == 'Entregado'){

?>

<span class="badge bg-success">

    Entregado

</span>

<?php
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

<!-- HISTORIAL -->

<td>

<?php

/* =========================
   PENDIENTE
========================= */

if($pedido['estado'] == 'Pendiente'){

?>

<span class="badge bg-secondary">

    Pedido Recibido

</span>

<?php
}
?>

<?php

/* =========================
   EN PROCESO
========================= */

if($pedido['estado'] == 'En Proceso'){

?>

<span class="badge bg-warning text-dark">

    Preparando Pedido

</span>

<?php
}
?>

<?php

/* =========================
   ENTREGADO
========================= */

if($pedido['estado'] == 'Entregado'){

?>

<span class="badge bg-success">

    Pedido Entregado

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
