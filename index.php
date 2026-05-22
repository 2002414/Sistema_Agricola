<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Sistema Agrícola</title>

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

        .CardLogin{

            border: none;
            border-radius: 25px;
            overflow: hidden;

        }

        .BotonTipo{

            width: 100%;

            margin-bottom: 10px;

            border-radius: 10px;

        }

        .Formulario{

            display: none;

        }

        .Activo{

            display: block;

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card CardLogin shadow-lg">

                <div class="card-body p-5">

                    <h2 class="text-center mb-4">

                        Sistema Agrícola

                    </h2>

                    <!-- BOTONES -->

                    <button
                        class="btn btn-success BotonTipo"
                        onclick="MostrarFormulario('comprador')"
                    >

                        Comprador

                    </button>

                    <button
                        class="btn btn-warning BotonTipo"
                        onclick="MostrarFormulario('productor')"
                    >

                        Productor

                    </button>

                    <button
                        class="btn btn-dark BotonTipo"
                        onclick="MostrarFormulario('asociado')"
                    >

                        Miembro Asociado

                    </button>

                    <hr>

                    <!-- COMPRADOR -->

                    <form
                        id="comprador"
                        class="Formulario Activo"
                        action="Modules/Login/Validar_Login.php"
                        method="POST"
                    >

                        <input
                            type="hidden"
                            name="tipo"
                            value="comprador"
                        >

                        <div class="mb-3">

                            <label>
                                Número de Teléfono
                            </label>

                            <input
                                type="text"
                                name="telefono"
                                class="form-control"
                                required
                            >

                        </div>

                        <button class="btn btn-success w-100">

                            Ingresar

                        </button>

                    </form>

                    <!-- PRODUCTOR -->

                    <form
                        id="productor"
                        class="Formulario"
                        action="Modules/Login/Validar_Login.php"
                        method="POST"
                    >

                        <input
                            type="hidden"
                            name="tipo"
                            value="productor"
                        >

                        <div class="mb-3">

                            <label>
                                Teléfono
                            </label>

                            <input
                                type="text"
                                name="telefono"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label>
                                DPI
                            </label>

                            <input
                                type="text"
                                name="dpi"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label>
                                Código de Mensaje
                            </label>

                            <input
                                type="text"
                                name="codigo_mensaje"
                                class="form-control"
                                required
                            >

                        </div>

                        <button class="btn btn-warning w-100">

                            Ingresar

                        </button>

                    </form>

                    <!-- ASOCIADO -->

                    <form
                    
                        id="asociado"
                        class="Formulario"
                        action="Modules/Login/Validar_Login.php"
                        method="POST"
                    >

                        <input
                            type="hidden"
                            name="tipo"
                            value="asociado"
                        >

                        <div class="mb-3">

                            <label>
                                Correo
                            </label>

                            <input
                                type="email"
                                name="correo"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label>
                                Contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <button class="btn btn-dark w-100">

                            Ingresar

                        </button>

                    </form>

                    <hr>

                        <a
                            href="Modules/Usuarios/Registro_Publico.php"
                            class="btn btn-outline-success w-100"
                        >

                        Crear Usuario

                        </a>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function MostrarFormulario(tipo){

    document
        .querySelectorAll(".Formulario")
        .forEach(formulario => {

            formulario.classList.remove("Activo");

        });

    document
        .getElementById(tipo)
        .classList.add("Activo");

}

</script>

</body>

</html>