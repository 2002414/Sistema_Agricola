<?php

error_reporting(E_ERROR | E_PARSE);

require('../../fpdf/fpdf.php');

include("../../Config/conexion.php");

/* =========================
   CONSULTAR PRODUCTOS
========================= */

$query = "
    SELECT *
    FROM productos
    ORDER BY id_producto DESC
";

$resultado = pg_query(
    $conn,
    $query
);

/* =========================
   CREAR PDF
========================= */

$pdf = new FPDF();

$pdf->AddPage();

/* =========================
   TITULO
========================= */

$pdf->SetFont(
    'Arial',
    'B',
    18
);

$pdf->SetTextColor(
    0,
    128,
    0
);

$pdf->Cell(

    190,
    15,

    'Reporte Productos',

    0,
    1,
    'C'

);

$pdf->Ln(10);

/* =========================
   CABECERAS
========================= */

$pdf->SetFont(
    'Arial',
    'B',
    12
);

$pdf->SetFillColor(
    34,
    139,
    34
);

$pdf->SetTextColor(
    255,
    255,
    255
);

$pdf->Cell(20,10,'ID',1,0,'C',true);
$pdf->Cell(40,10,'Nombre',1,0,'C',true);
$pdf->Cell(80,10,'Descripcion',1,0,'C',true);
$pdf->Cell(25,10,'Precio',1,0,'C',true);
$pdf->Cell(25,10,'Stock',1,1,'C',true);

/* =========================
   DATOS
========================= */

$pdf->SetFont(
    'Arial',
    '',
    12
);

$pdf->SetTextColor(
    0,
    0,
    0
);

while($producto = pg_fetch_assoc($resultado)){

    // Datos
    $id = $producto['id_producto'];

    $nombre = mb_convert_encoding(
        $producto['nombre'],
        'ISO-8859-1',
        'UTF-8'
    );

    $descripcion = mb_convert_encoding(
        $producto['descripcion'],
        'ISO-8859-1',
        'UTF-8'
    );

    $precio = 'Q. '.$producto['precio'];
    $stock = $producto['stock'];

    // Guardar posición inicial
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    // Calcular altura necesaria para descripción
    $anchoDescripcion = 80;

$lineas = ceil(
    $pdf->GetStringWidth($descripcion)
    / ($anchoDescripcion - 5)
);

if($lineas < 1){
    $lineas = 1;
}

$altoLinea = 10;
$altoFila = $lineas * $altoLinea;

    // ID
    $pdf->Cell(
    20,
    $altoFila,
    $id,
    1,
    0,
    'C'
);

    // Nombre
    $pdf->Cell(40, $altoFila, $nombre, 1);

    // Guardar posición antes de MultiCell
    $xDesc = $pdf->GetX();
    $yDesc = $pdf->GetY();

    // Descripción (permite varias líneas)
    // Dibujar el borde completo primero
$pdf->Rect(
    $xDesc,
    $yDesc,
    80,
    $altoFila
);

// Escribir el texto sin borde
$pdf->MultiCell(
    80,
    8,
    $descripcion,
    0,
    'L'
);

    // Volver a la misma fila
    $pdf->SetXY(
    $xDesc + 80,
    $yDesc
);

    // Precio
    $pdf->Cell(
    25,
    $altoFila,
    $precio,
    1,
    0,
    'C'
);

$pdf->Cell(
    25,
    $altoFila,
    $stock,
    1,
    0,
    'C'
);

    $pdf->SetY(
    max(
        $pdf->GetY(),
        $y + $altoFila
    )
);

}
/* =========================
   DESCARGAR PDF
========================= */

$pdf->Output(
    'D',
    'Reporte_Productos.pdf'
);

?>