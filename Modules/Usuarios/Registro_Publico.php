<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Registro Público</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{

            background: linear-gradient(
                135deg,
                #198754,
                #145c32
            );

            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

        }

        .CardRegistro{

            border: none;

            border-radius: 25px;

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card CardRegistro shadow-lg">

                <div class="card-body p-5">

                    <h2 class="text-center mb-4">

                        Registro Usuario

                    </h2>

                    <form
                        action="Guardar_Registro_Publico.php"
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
                                Teléfono
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

                        <!-- BOTÓN -->

                        <button class="btn btn-success w-100">

                            Registrarse

                        </button>

                        <a
                            href="../../index.php"
                            class="btn btn-secondary w-100 mt-3"
                        >

                            Volver Login

                        </a>

                    </form>

                </div>

            </div>

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
        "CampoCodigo"

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

}

</script>

</body>

</html>