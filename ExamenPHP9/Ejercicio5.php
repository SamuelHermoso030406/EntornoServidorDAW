<?php
require_once "conexion.php";

$dni = "88888888B";
$nombre = "Lucía Vega";
$edad = 22;

$sql = "INSERT INTO alumnos (dni, nombre, edad) VALUES (?, ?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("ssi", $dni, $nombre, $edad);
$stmt->execute();

if ($stmt->affected_rows === 1) {
    echo "Alumno insertado";
}

$stmt->close();
$db->close();
