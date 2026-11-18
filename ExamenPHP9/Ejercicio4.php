<?php
require_once "conexion.php";

$texto = "a";
$patron = "%" . $texto . "%";

$sql = "SELECT dni, nombre FROM alumnos WHERE nombre LIKE ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patron);
$stmt->execute();
$resultado = $stmt->get_result();

echo "<table>";
echo "<tr><th>DNI</th><th>Nombre</th></tr>";
while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila["dni"], ENT_QUOTES, "UTF-8") . "</td>";
    echo "<td>" . htmlspecialchars($fila["nombre"], ENT_QUOTES, "UTF-8") . "</td>";
    echo "</tr>";
}
echo "</table>";

$resultado->free();
$stmt->close();
$db->close();
