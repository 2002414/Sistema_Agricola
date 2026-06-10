<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Acceso Compradores</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background:
        linear-gradient(
            rgba(0,0,0,0.45),
            rgba(0,0,0,0.45)
        ),
        url('Assets/img/fondo_agricola.jpg');

    background-size: cover;

    background-position: center;

    background-repeat: no-repeat;

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

}

.CardLogin{

    border:none;

    border-radius:25px;

    background:rgba(255,255,255,0.95);

    backdrop-filter: blur(5px);

    box-shadow:
    0 20px 50px rgba(0,0,0,.35);

}

</style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card CardLogin shadow-lg">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <h1 class="fw-bold text-success">

                            🛒 Compradores

                        </h1>

                        <p class="text-muted">

                            Acceso para compradores registrados

                        </p>

                    </div>

                    <form
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

                        <button
                            class="btn btn-success w-100"
                        >

                            Ingresar

                        </button>

                        <hr>

<a
    href="Modules/Usuarios/Registro_Publico.php"
    class="btn btn-outline-success w-100"
>

    👤 Crear Usuario

</a>

<a
    href="index.php"
    class="btn btn-secondary w-100 mt-3"
>

    Volver

</a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
