<?php

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

$pdf->Cell(70,10,'Descripcion',1,0,'C',true);

$pdf->Cell(30,10,'Precio',1,0,'C',true);

$pdf->Cell(30,10,'Stock',1,1,'C',true);

/* =========================
   DATOS
========================= */

$pdf->SetFont(
    'Arial',
    '',
    10
);

$pdf->SetTextColor(
    0,
    0,
    0
);

while($producto = pg_fetch_assoc($resultado)){

    $pdf->Cell(
        20,
        10,
        $producto['id_producto'],
        1
    );

    $pdf->Cell(
        40,
        10,
        utf8_decode(
            $producto['nombre']
        ),
        1
    );

    $pdf->Cell(
        70,
        10,
        utf8_decode(
            $producto['descripcion']
        ),
        1
    );

    $pdf->Cell(
        30,
        10,
        'Q. '.$producto['precio'],
        1
    );

    $pdf->Cell(
        30,
        10,
        $producto['stock'],
        1
    );

    $pdf->Ln();

}

/* =========================
   DESCARGAR PDF
========================= */

$pdf->Output(
    'D',
    'Reporte_Productos.pdf'
);

?>