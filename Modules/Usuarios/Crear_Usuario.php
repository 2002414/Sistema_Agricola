<?php

include("../../Config/Middleware/Validar_Admin.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Nuevo Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-body">

            <h1 class="mb-4">

                Nuevo Usuario

            </h1>

            <form
                action="Guardar_Usuario.php"
                method="POST"
            >

                <!-- ROL -->

                <div class="mb-3">

                    <label>
                        Tipo Usuario
                    </label>

                    <select
                        name="rol"
                        id="rol"
                        class="form-select"
                        onchange="CambiarFormulario()"
                        required
                    >

                        <option value="">
                            Seleccione
                        </option>

                        <option value="comprador">
                            Comprador
                        </option>

                        <option value="productor">
                            Productor
                        </option>

                        <option value="admin">
                            Miembro Asociado
                        </option>

                    </select>

                </div>

                <!-- NOMBRE -->

                <div
                    class="mb-3"
                    id="CampoNombre"
                    style="display:none;"
                >

                    <label>
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                    >

                </div>

                <!-- TELÉFONO -->

                <div
                    class="mb-3"
                    id="CampoTelefono"
                    style="display:none;"
                >

                    <label>
                        Número de Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                    >

                </div>

                <!-- DPI -->

                <div
                    class="mb-3"
                    id="CampoDpi"
                    style="display:none;"
                >

                    <label>
                        DPI
                    </label>

                    <input
                        type="text"
                        name="dpi"
                        class="form-control"
                    >

                </div>

                <!-- CÓDIGO -->

                <div
                    class="mb-3"
                    id="CampoCodigo"
                    style="display:none;"
                >

                    <label>
                        Código de Mensaje
                    </label>

                    <input
                        type="text"
                        name="codigo_mensaje"
                        class="form-control"
                    >

                </div>

                <!-- CORREO -->

                <div
                    class="mb-3"
                    id="CampoCorreo"
                    style="display:none;"
                >

                    <label>
                        Correo
                    </label>

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                    >

                </div>

                <!-- PASSWORD -->

                <div
                    class="mb-3"
                    id="CampoPassword"
                    style="display:none;"
                >

                    <label>
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                    >

                </div>

                <!-- BOTÓN -->

                <button class="btn btn-success w-100">

                    Guardar Usuario

                </button>

            </form>

        </div>

    </div>

</div>

<script>

function CambiarFormulario(){

    let rol = document
        .getElementById("rol")
        .value;

    /* =========================
       OCULTAR TODO
    ========================= */

    let campos = [

        "CampoNombre",
        "CampoTelefono",
        "CampoDpi",
        "CampoCodigo",
        "CampoCorreo",
        "CampoPassword"

    ];

    campos.forEach(campo => {

        document
            .getElementById(campo)
            .style.display = "none";

    });

    /* =========================
       MOSTRAR NOMBRE
    ========================= */

    document
        .getElementById("CampoNombre")
        .style.display = "block";

    /* =========================
       COMPRADOR
    ========================= */

    if(rol == "comprador"){

        document
            .getElementById("CampoTelefono")
            .style.display = "block";

    }

    /* =========================
       PRODUCTOR
    ========================= */

    if(rol == "productor"){

        document
            .getElementById("CampoTelefono")
            .style.display = "block";

        document
            .getElementById("CampoDpi")
            .style.display = "block";

        document
            .getElementById("CampoCodigo")
            .style.display = "block";

    }

    /* =========================
       ASOCIADO
    ========================= */

    if(rol == "admin"){

        document
            .getElementById("CampoCorreo")
            .style.display = "block";

        document
            .getElementById("CampoPassword")
            .style.display = "block";

    }

}

</script>

</body>

</html>