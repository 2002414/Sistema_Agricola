<?php

include("../../Config/Middleware/Validar_Admin.php");

include("../../Config/conexion.php");

/* =========================
   OBTENER ID
========================= */

$id = $_GET['id'];

/* =========================
   CONSULTAR USUARIO
========================= */

$query = "
    SELECT *
    FROM usuarios
    WHERE id_usuario = $1
";

$resultado = pg_query_params(
    $conn,
    $query,
    array($id)
);

$usuario = pg_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Editar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">

                Editar Usuario

            </h2>

            <form
                action="Actualizar_Usuario.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="id_usuario"
                    value="<?php echo $usuario['id_usuario']; ?>"
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

                        <option
                            value="comprador"
                            <?php
                            if($usuario['rol']=='comprador'){
                                echo "selected";
                            }
                            ?>
                        >
                            Comprador
                        </option>

                        <option
                            value="productor"
                            <?php
                            if($usuario['rol']=='productor'){
                                echo "selected";
                            }
                            ?>
                        >
                            Productor
                        </option>

                        <option
                            value="admin"
                            <?php
                            if($usuario['rol']=='admin'){
                                echo "selected";
                            }
                            ?>
                        >
                            Miembro Asociado
                        </option>

                    </select>

                </div>

                <!-- NOMBRE -->

                <div class="mb-3">

                    <label>
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="<?php echo $usuario['nombre']; ?>"
                        required
                    >

                </div>

                <!-- TELÉFONO -->

                <div
                    class="mb-3"
                    id="CampoTelefono"
                >

                    <label>
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                        value="<?php echo $usuario['telefono']; ?>"
                    >

                </div>

                <!-- DPI -->

                <div
                    class="mb-3"
                    id="CampoDpi"
                >

                    <label>
                        DPI
                    </label>

                    <input
                        type="text"
                        name="dpi"
                        class="form-control"
                        value="<?php echo $usuario['dpi']; ?>"
                    >

                </div>

                <!-- CÓDIGO -->

                <div
                    class="mb-3"
                    id="CampoCodigo"
                >

                    <label>
                        Código Mensaje
                    </label>

                    <input
                        type="text"
                        name="codigo_mensaje"
                        class="form-control"
                        value="<?php echo $usuario['codigo_mensaje']; ?>"
                    >

                </div>

                <!-- CORREO -->

                <div
                    class="mb-3"
                    id="CampoCorreo"
                >

                    <label>
                        Correo
                    </label>

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                        value="<?php echo $usuario['correo']; ?>"
                    >

                </div>

                <!-- PASSWORD -->

                <div
                    class="mb-3"
                    id="CampoPassword"
                >

                    <label>
                        Nueva Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                    >

                </div>

                <button class="btn btn-success w-100">

                    Actualizar Usuario

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

    document
        .getElementById("CampoTelefono")
        .style.display = "none";

    document
        .getElementById("CampoDpi")
        .style.display = "none";

    document
        .getElementById("CampoCodigo")
        .style.display = "none";

    document
        .getElementById("CampoCorreo")
        .style.display = "none";

    document
        .getElementById("CampoPassword")
        .style.display = "none";

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
       ADMIN
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

/* =========================
   EJECUTAR AL CARGAR
========================= */

CambiarFormulario();

</script>

</body>

</html>