<?php
require_once "conexion.php";

$sql = "SELECT nombre, edad FROM alumnos ORDER BY edad DESC, nombre";
$resultado = $db->query($sql);

echo "Total de alumnos: " . $resultado->num_rows;
echo "<table>";
echo "<tr><th>Nombre</th><th>Edad</th></tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila["nombre"], ENT_QUOTES, "UTF-8") . "</td>";
    echo "<td>" . (int)$fila["edad"] . "</td>";
    echo "</tr>";
}

echo "</table>";
$resultado->free();
$db->close();
