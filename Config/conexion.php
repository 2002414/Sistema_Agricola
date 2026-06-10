<?php

$host = "postgres";
$port = "5432";
$dbname = "Sistema_Agricola";
$user = "postgres";
$password = "33016690";

$conn = pg_connect("
    host=$host
    port=$port
    dbname=$dbname
    user=$user
    password=$password
");

if(!$conn){
    die("Error de conexión con PostgreSQL");
}

?>