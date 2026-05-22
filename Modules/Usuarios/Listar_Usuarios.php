<?php

include("../../Config/Middleware/Validar_Admin.php");

include("../../Config/conexion.php");

/* =========================
   CONSULTAR USUARIOS
========================= */

$query = "
    SELECT *
    FROM usuarios
    ORDER BY id_usuario DESC
";

$resultado = pg_query(
    $conn,
    $query
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Usuarios</title>

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

            <div class="d-flex justify-content-between mb-4">

                <h2>

                    Lista Usuarios

                </h2>

                <a href="Crear_Usuario.php"
                   class="btn btn-success">

                    Nuevo Usuario

                </a>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-success">

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Nombre
                            </th>

                            <th>
                                Tipo Usuario
                            </th>

                            <th>
                                Información
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    while($usuario = pg_fetch_assoc($resultado)){
                    ?>

                        <tr>

                            <td>

                                <?php
                                echo $usuario['id_usuario'];
                                ?>

                            </td>

                            <td>

                                <?php
                                echo $usuario['nombre'];
                                ?>

                            </td>

                            <td>

                                <?php

                                if(
                                    $usuario['rol']
                                    ==
                                    'admin'
                                ){

                                    echo "Miembro Asociado";

                                }

                                elseif(
                                    $usuario['rol']
                                    ==
                                    'productor'
                                ){

                                    echo "Productor";

                                }

                                elseif(
                                    $usuario['rol']
                                    ==
                                    'comprador'
                                ){

                                    echo "Comprador";

                                }

                                ?>

                            </td>

                            <td>

                                <?php

                                /* =========================
                                   COMPRADOR
                                ========================= */

                                if(
                                    $usuario['rol']
                                    ==
                                    'comprador'
                                ){

                                    echo "
                                    <strong>
                                    Teléfono:
                                    </strong>
                                    ";

                                    echo $usuario['telefono'];

                                }

                                /* =========================
                                   PRODUCTOR
                                ========================= */

                                elseif(
                                    $usuario['rol']
                                    ==
                                    'productor'
                                ){

                                    echo "
                                    <strong>
                                    Teléfono:
                                    </strong>
                                    ";

                                    echo $usuario['telefono'];

                                    echo "<br>";

                                    echo "
                                    <strong>
                                    DPI:
                                    </strong>
                                    ";

                                    echo $usuario['dpi'];

                                }

                                /* =========================
                                   ASOCIADO
                                ========================= */

                                elseif(
                                    $usuario['rol']
                                    ==
                                    'admin'
                                ){

                                    echo "
                                    <strong>
                                    Correo:
                                    </strong>
                                    ";

                                    echo $usuario['correo'];

                                }

                                ?>

                            </td>

                            <td>

                                <a
                                    href="Editar_Usuario.php?id=<?php echo $usuario['id_usuario']; ?>"
                                    class="btn btn-primary btn-sm"
                                >

                                    Editar

                                </a>

                                <a
    href="Eliminar_Usuario.php?id=<?php echo $usuario['id_usuario']; ?>"
    class="btn btn-danger btn-sm"

    onclick="return confirm(
        '¿Desea eliminar este usuario?'
    )"

>

    Eliminar

</a>

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