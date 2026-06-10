<?php

header("Content-Type: application/json");

include("../Config/conexion.php");

/* =========================
   RECIBIR JSON
========================= */

$data = json_decode(
    file_get_contents("php://input"),
    true
);

/* =========================
   VARIABLES
========================= */

$correo = $data['correo'];

$password = $data['password'];

/* =========================
   BUSCAR USUARIO
========================= */

$query = "
    SELECT *
    FROM usuarios
    WHERE correo = $1
";

$resultado = pg_query_params(
    $conn,
    $query,
    array($correo)
);

/* =========================
   VALIDAR USUARIO
========================= */

if(pg_num_rows($resultado) > 0){

    $usuario = pg_fetch_assoc($resultado);

    /* =========================
       VALIDAR PASSWORD
    ========================= */

    if(password_verify(
        $password,
        $usuario['password']
    )){

        echo json_encode([

            "success" => true,

            "mensaje" => "Login correcto",

            "usuario" => [

                "id" => $usuario['id_usuario'],

                "nombre" => $usuario['nombre'],

                "correo" => $usuario['correo'],

                "rol" => $usuario['rol']

            ]

        ]);

    }else{

        echo json_encode([

            "success" => false,

            "mensaje" => "Contraseña incorrecta"

        ]);

    }

}else{

    echo json_encode([

        "success" => false,

        "mensaje" => "Usuario no encontrado"

    ]);

}

?>