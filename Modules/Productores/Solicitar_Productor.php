<?php
session_start();
?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
   content="width=device-width, initial-scale=1.0">

<title>Solicitud Productor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-warning">

🌾 Solicitud de Cuenta Productor

</h2>

<hr>

<form
    action="Guardar_Solicitud.php"
    method="POST"
    enctype="multipart/form-data"
>

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
required

>

</div>

<div class="mb-3">

<label>Apellido</label>

<input
type="text"
name="apellido"
class="form-control"
required

>

</div>

<div class="mb-3">

<label>Teléfono</label>

<input
type="text"
name="telefono"
class="form-control"
required

>

</div>

<div class="mb-3">

<label>DPI</label>

<input
type="text"
name="dpi"
class="form-control"
required

>

</div>

<div class="mb-3">

<label>Documento Legal</label>

<input
type="file"
id="documentos"
name="documentos[]"
class="form-control"
accept=".pdf,.jpg,.jpeg,.png"
multiple
required

>

<div id="ListaDocumentos" class="mt-3">

</div>

</div>

<button
class="btn btn-warning"

>

Enviar Solicitud

</button>

<a
href="../../productor.php"
class="btn btn-secondary"

>

Volver

</a>

</form>

</div>

</div>

</div>

<script>

let archivosSeleccionados = [];

const inputDocumentos =
    document.getElementById("documentos");

const lista =
    document.getElementById("ListaDocumentos");

inputDocumentos.addEventListener(
    "change",
    function(){

        Array.from(this.files)
        .forEach(archivo => {

            archivosSeleccionados.push(
                archivo
            );

        });

        ActualizarLista();

    }
);

function ActualizarLista(){

    lista.innerHTML = "";

    const dt = new DataTransfer();

    archivosSeleccionados.forEach(
        (archivo,index)=>{

            dt.items.add(archivo);

            let item =
                document.createElement("div");

            item.className =
                "alert alert-secondary d-flex justify-content-between align-items-center";

            item.innerHTML = `

                <span>
                    📄 ${archivo.name}
                </span>

                <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    onclick="EliminarArchivo(${index})"
                >
                    ✖
                </button>

            `;

            lista.appendChild(item);

        }
    );

    inputDocumentos.files =
        dt.files;

}

function EliminarArchivo(index){

    archivosSeleccionados.splice(
        index,
        1
    );

    ActualizarLista();

}

</script>

</body>

</html>
