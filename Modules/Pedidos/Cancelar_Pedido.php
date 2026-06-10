<?php

session_start();

include("../../Config/conexion.php");

$id = $_GET['id'];

pg_query_params(

    $conn,

    "

    DELETE FROM detalle_pedido

    WHERE id_pedido = $1

    ",

    array($id)

);

pg_query_params(

    $conn,

    "

    DELETE FROM pedidos

    WHERE id_pedido = $1

    ",

    array($id)

);

header("Location: Listar_Pedido.php");

?>
