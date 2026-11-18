<?php
require_once "conexion.php";

$edadMinima = 21;

$sql = "SELECT nombre, edad FROM alumnos WHERE edad >= ? ORDER BY edad, nombre";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $edadMinima);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    echo "Sin coincidencias";
} else {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Edad</th></tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila["nombre"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . (int)$fila["edad"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$resultado->free();
$stmt->close();
$db->close();
