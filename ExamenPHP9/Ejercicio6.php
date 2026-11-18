<?php
require_once "conexion.php";

$nuevaNota = 7.75;
$dni = "55555555Z";
$codigo = 2;
$anio = 2026;

$sql = "UPDATE matriculas SET nota = ? WHERE dni = ? AND codigo = ? AND anio = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("dsii", $nuevaNota, $dni, $codigo, $anio);
$stmt->execute();

if ($stmt->affected_rows === 1) {
    echo "Nota actualizada";
} else {
    echo "Sin cambios";
}

$stmt->close();
$db->close();
