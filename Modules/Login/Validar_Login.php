<?php

session_start();

include("../../Config/conexion.php");

include("../../Config/FuncionesHistorial.php");

/* =========================
   TIPO LOGIN
========================= */

$tipo = $_POST['tipo'];

/* =========================================================
   LOGIN COMPRADOR
========================================================= */

if($tipo == "comprador"){

    $telefono = $_POST['telefono'];

    $query = "
        SELECT *
        FROM usuarios
        WHERE telefono = $1
        AND rol = 'comprador'
    ";

    $resultado = pg_query_params(
        $conn,
        $query,
        array($telefono)
    );

    if(pg_num_rows($resultado) > 0){

        $usuario = pg_fetch_assoc($resultado);

        if($usuario['estado'] != 'ACTIVADO'){

    echo "
    <script>

        alert('Su cuenta se encuentra bloqueada temporalmente. Revise sus mensajes.');

        window.location='../../index.php';

    </script>
    ";

    exit();

}

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

guardarHistorial(
    $conn,
    $usuario['id_usuario'],
    $usuario['nombre'],
    "Inició sesión como comprador"
);

        header("Location: ../../dashboard.php");

    }else{

        echo "
        <script>

            alert('Comprador no encontrado');

            window.location='../../index.php';

        </script>
        ";

    }

}

/* =========================================================
   LOGIN PRODUCTOR
========================================================= */

elseif($tipo == "productor"){

    $telefono = $_POST['telefono'];

    $dpi = $_POST['dpi'];

    $codigo = $_POST['codigo_mensaje'];

    $query = "
        SELECT *
        FROM usuarios
        WHERE telefono = $1
        AND dpi = $2
        AND codigo_mensaje = $3
        AND rol = 'productor'
    ";

    $resultado = pg_query_params(
        $conn,
        $query,
        array(
            $telefono,
            $dpi,
            $codigo
        )
    );

    if(pg_num_rows($resultado) > 0){

        $usuario = pg_fetch_assoc($resultado);

if($usuario['estado'] != 'ACTIVADO'){

    echo "
    <script>

        alert('Su cuenta se encuentra bloqueada temporalmente.');

        window.location='../../index.php';

    </script>
    ";

    exit();

}

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        
        $_SESSION['usuario'] = $usuario['nombre'];

        $_SESSION['rol'] = $usuario['rol'];

guardarHistorial(
    $conn,
    $usuario['id_usuario'],
    $usuario['nombre'],
    "Inició sesión como productor"
);  

      header("Location: ../../dashboard.php");

    }else{

        echo "
        <script>

            alert('Datos productor incorrectos');

            window.location='../../index.php';

        </script>
        ";

    }

}

/* =========================================================
   LOGIN ASOCIADO
========================================================= */

elseif($tipo == "asociado"){

    $correo = $_POST['correo'];

    $password = $_POST['password'];

    $query = "
        SELECT *
FROM usuarios
WHERE correo = $1
AND rol = 'admin'
    ";

    $resultado = pg_query_params(
        $conn,
        $query,
        array($correo)
    );

    if(pg_num_rows($resultado) > 0){

        $usuario = pg_fetch_assoc($resultado);

        if($usuario['estado'] != 'ACTIVADO'){

 echo "
    <script>

        alert('Su cuenta se encuentra bloqueada temporalmente.');

        window.location='../../index.php';

    </script>
    ";

    exit();
}

            if(password_verify(
            $password,
            $usuario['password']
        )){

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            
            $_SESSION['usuario'] = $usuario['nombre'];
            
            $_SESSION['rol'] = $usuario['rol'];

guardarHistorial(
    $conn,
    $usuario['id_usuario'],
    $usuario['nombre'],
    "Inició sesión como administrador"
);

            header("Location: ../../dashboard.php");

        }else{

            echo "
            <script>

                alert('Contraseña incorrecta');

                window.location='../../index.php';

            </script>
            ";

        }

    }else{

        echo "
        <script>

            alert('Asociado no encontrado');

            window.location='../../index.php';

        </script>
        ";

    }
}

