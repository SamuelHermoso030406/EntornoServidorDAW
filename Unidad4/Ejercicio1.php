<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>
<body>
    <?php

    $ciudades = [
        "Granada" => 150000,
        "Madrid" => 3000000,
        "Barcelona" => 2879200,
        "Málaga" => 240000,
        "Sevilla" => 500000,
        "Valencia" => 1584600,
        "Tarragona" => 485210
    ];

    echo "<h2>Lista de ciudades</h2>";

    foreach ($ciudades as $ciudad => $poblacion) {
        echo "$ciudad: $poblacion habitantes<br>";
    }

    ksort($ciudades);

    echo "<h2>Ciudades ordenadas alfabéticamente</h2>";

    foreach ($ciudades as $ciudad => $poblacion) {
        echo "$ciudad: $poblacion habitantes<br>";
    }

    asort($ciudades);

    echo "<h2>Ciudades ordenadas por población</h2>";

    foreach ($ciudades as $ciudad => $poblacion) {
        echo "$ciudad: $poblacion habitantes<br>";
    }

    $ciudadMayor = array_search(max($ciudades), $ciudades);

    $ciudadMenor = array_search(min($ciudades), $ciudades);

    echo "<h2>Mayor y menor población</h2>";
    echo "Ciudad con más población: $ciudadMayor<br>";
    echo "Ciudad con menos población: $ciudadMenor";

    ?>
</body>
</html>