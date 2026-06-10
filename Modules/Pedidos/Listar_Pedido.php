<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   CONSULTAR PEDIDOS
========================= */

if($_SESSION['rol'] == 'comprador'){

    $query = "

SELECT DISTINCT

p.*,

pr.nombre AS producto,

u.nombre AS comprador,

up.nombre AS productor

FROM pedidos p

INNER JOIN detalle_pedido d
ON p.id_pedido = d.id_pedido

INNER JOIN productos pr
ON d.id_producto = pr.id_producto

INNER JOIN usuarios u
ON p.id_usuario = u.id_usuario

INNER JOIN usuarios up
ON pr.id_usuario = up.id_usuario

WHERE p.id_usuario = $1

ORDER BY p.id_pedido DESC

";

 $resultado = pg_query_params(

        $conn,

        $query,

        array($_SESSION['id_usuario'])

    );

}

elseif($_SESSION['rol'] == 'productor'){

    $query = "

SELECT DISTINCT

p.*,

pr.nombre AS producto,

u.nombre AS comprador,

up.nombre AS productor

FROM pedidos p

INNER JOIN detalle_pedido d
ON p.id_pedido = d.id_pedido

INNER JOIN productos pr
ON d.id_producto = pr.id_producto

INNER JOIN usuarios u
ON p.id_usuario = u.id_usuario

INNER JOIN usuarios up
ON pr.id_usuario = up.id_usuario

WHERE pr.id_usuario = $1

ORDER BY p.id_pedido DESC

";

 $resultado = pg_query_params(

        $conn,

        $query,

        array($_SESSION['id_usuario'])

    );

}

else{

$query = "

SELECT DISTINCT

p.*,

pr.nombre AS producto,

u.nombre AS comprador,

up.nombre AS productor

FROM pedidos p

INNER JOIN detalle_pedido d
ON p.id_pedido = d.id_pedido

INNER JOIN productos pr
ON d.id_producto = pr.id_producto

INNER JOIN usuarios u
ON p.id_usuario = u.id_usuario

INNER JOIN usuarios up
ON pr.id_usuario = up.id_usuario

ORDER BY p.id_pedido DESC

";

    $resultado = pg_query(

        $conn,

        $query

    );

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet"
href="../../Assets/css/mobile.css">

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

    ← Volver 

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
Comprador
</th>

<th>
Productor
</th>

<th>
Producto
</th>

<th>
Dirección
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

<!--Comprador-->

<td>

<?php
echo $pedido['comprador'];
?>

</td>

<!--Productor-->

<td>

<?php
echo $pedido['productor'];
?>

</td>

<!--Producto-->
<td>

<?php
echo $pedido['producto'];
?>

</td>

<!-- DIRECCIÓN-->

<td>

<?php echo $pedido['direccion']; ?>

</td>

<!-- FECHA -->

<td>

<?php
echo date(
    "d/m/Y H:i:s",
    strtotime($pedido['fecha'])
);
?>

</td>

<!-- ESTADO -->

<td>

<?php

if($pedido['estado'] == 'Pendiente de Confirmar'){

    echo "
    <span class='badge bg-warning text-dark'>
        Pendiente de Confirmar
    </span>
    ";

}elseif($pedido['estado'] == 'Pedido Rechazado'){

    echo "
    <span class='badge bg-danger'>
        Pedido Rechazado
    </span>
    ";

}elseif($pedido['estado'] == 'Aceptado por el Productor'){

    echo "
    <span class='badge bg-primary'>
        Aceptado por el Productor
    </span>
    ";

}elseif($pedido['estado'] == 'En Proceso de Entrega'){

    echo "
    <span class='badge bg-info text-dark'>
        En Proceso de Entrega
    </span>
    ";

}elseif($pedido['estado'] == 'Entregado'){

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

    if($pedido['estado'] == 'Pendiente de Confirmar'){

?>

<a
href="Cancelar_Pedido.php?id=<?php echo $pedido['id_pedido']; ?>"
class="btn btn-danger"
onclick="return confirm('¿Desea cancelar este pedido?')"
>

Cancelar Pedido

</a>

<?php

    }

    if($pedido['estado'] == 'Entregado'){

?>

<a
href="../Calificaciones/Crear_Calificacion.php?id=<?php echo $pedido['id_pedido']; ?>"
class="btn btn-warning btn-sm"
>

⭐ Calificar Producto

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

    if($pedido['estado'] == 'Pendiente de Confirmar'){

?>

<a
href="Cambiar_Estado.php?id=<?php echo $pedido['id_pedido']; ?>&estado=Aceptado por el Productor"
class="btn btn-success btn-sm mb-1"
>

Aceptar

</a>

<a
href="Cambiar_Estado.php?id=<?php echo $pedido['id_pedido']; ?>&estado=Pedido Rechazado"
class="btn btn-danger btn-sm"
>

Rechazar

</a>

<?php

    }

    elseif($pedido['estado'] == 'Aceptado por el Productor'){

?>

<a
href="Cambiar_Estado.php?id=<?php echo $pedido['id_pedido']; ?>&estado=En Proceso de Entrega"
class="btn btn-warning btn-sm"
>

En Proceso

</a>

<?php

    }

    elseif($pedido['estado'] == 'En Proceso de Entrega'){

?>

<a
href="Cambiar_Estado.php?id=<?php echo $pedido['id_pedido']; ?>&estado=Entregado"
class="btn btn-primary btn-sm"
>

Entregado

</a>

<?php

    }

    elseif($pedido['estado'] == 'Entregado'){

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
