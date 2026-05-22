<?php

session_start();

include("../../Config/conexion.php");

/* =========================
   OBTENER USUARIOS
========================= */

$queryUsuarios = "
    SELECT *
    FROM usuarios
    ORDER BY nombre ASC
";

$resultadoUsuarios = pg_query(
    $conn,
    $queryUsuarios
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Enviar Mensaje</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<a
    href="../../dashboard.php"
    class="btn btn-secondary mb-3"
>

    ← Volver Dashboard

</a>

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Nuevo Mensaje
            </h2>

            <form action="Guardar_Mensaje.php"
                  method="POST">

                <div class="mb-3">

                    <label>Destinatario</label>

                    <select
                        name="receptor"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione usuario
                        </option>

                        <?php
                        while($usuario = pg_fetch_assoc($resultadoUsuarios)){
                        ?>

                            <option
                                value="<?php echo $usuario['id_usuario']; ?>">

                                <?php echo $usuario['nombre']; ?>

                            </option>

                        <?php
                        }
                        ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Mensaje</label>

                    <textarea
                        name="mensaje"
                        class="form-control"
                        rows="5"
                        required
                    ></textarea>

                </div>

                <button class="btn btn-success w-100">

                    Enviar Mensaje

                </button>

                <a href="Listar_Mensajes.php"
                   class="btn btn-secondary">

                    Ver Mensajes

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>