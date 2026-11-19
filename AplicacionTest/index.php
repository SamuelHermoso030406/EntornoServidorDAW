<?php
$preguntas = [
    ["pregunta" => "¿Qué lenguaje se ejecuta habitualmente en el servidor para generar páginas dinámicas?", "opciones" => ["HTML", "CSS", "PHP", "XML"], "correcta" => 2],
    ["pregunta" => "¿Qué método de un formulario envía los datos en el cuerpo de la petición?", "opciones" => ["GET", "POST", "LINK", "OPEN"], "correcta" => 1],
    ["pregunta" => "¿Qué instrucción de PHP permite recorrer los elementos de un array?", "opciones" => ["foreach", "switch", "echo", "include"], "correcta" => 0],
    ["pregunta" => "¿Qué etiqueta HTML se utiliza para crear un formulario?", "opciones" => ["<table>", "<section>", "<input>", "<form>"], "correcta" => 3],
    ["pregunta" => "¿Qué propiedad CSS cambia el color del texto?", "opciones" => ["background", "color", "padding", "border"], "correcta" => 1],
    ["pregunta" => "¿Qué sentencia SQL se utiliza para consultar datos de una tabla?", "opciones" => ["INSERT", "DELETE", "SELECT", "UPDATE"], "correcta" => 2],
    ["pregunta" => "¿Con qué símbolo empiezan las variables en PHP?", "opciones" => ["$", "#", "@", "%"], "correcta" => 0],
    ["pregunta" => "¿Qué función de PHP devuelve el número de elementos de un array?", "opciones" => ["length()", "size()", "total()", "count()"], "correcta" => 3],
    ["pregunta" => "¿Qué atributo de un input permite agrupar opciones para elegir solo una?", "opciones" => ["id", "name", "class", "placeholder"], "correcta" => 1],
    ["pregunta" => "¿Qué código HTTP indica que una página se ha encontrado correctamente?", "opciones" => ["404", "500", "200", "301"], "correcta" => 2],
    ["pregunta" => "¿Qué operador se usa en PHP para concatenar cadenas de texto?", "opciones" => [".", "+", "&", "::"], "correcta" => 0],
    ["pregunta" => "¿Qué tipo de input HTML permite seleccionar una sola opción dentro de un grupo?", "opciones" => ["checkbox", "text", "file", "radio"], "correcta" => 3]
];

function mostrarPreguntas($preguntas) {
    echo '<form action="index.php" method="post">';
    foreach ($preguntas as $numero => $datos) {
        echo '<fieldset class="pregunta">';
        echo '<legend>Pregunta ' . ($numero + 1) . '</legend>';
        echo '<p class="enunciado">' . htmlspecialchars($datos['pregunta']) . '</p>';
        foreach ($datos['opciones'] as $indice => $opcion) {
            echo '<label class="opcion">';
            echo '<input type="radio" name="respuestas[' . $numero . ']" value="' . $indice . '" required>';
            echo '<span>' . htmlspecialchars($opcion) . '</span>';
            echo '</label>';
        }
        echo '</fieldset>';
    }
    echo '<button type="submit" class="boton">Corregir mi test</button>';
    echo '</form>';
}

function corregirTest($preguntas, $respuestas) {
    $aciertos = 0;
    $fallos = 0;
    $total = count($preguntas);
    $detalle = '';

    foreach ($preguntas as $numero => $datos) {
        $correcta = $datos['correcta'];
        $contestada = isset($respuestas[$numero]) && is_scalar($respuestas[$numero]);
        $elegida = $contestada ? (string)$respuestas[$numero] : '';
        $esCorrecta = $contestada && $elegida === (string)$correcta;

        if ($esCorrecta) {
            $aciertos++;
            $detalle .= '<div class="revision acierto"><strong>Pregunta ' . ($numero + 1) . ': correcta</strong><p>' . htmlspecialchars($datos['pregunta']) . '</p></div>';
        } else {
            $fallos++;
            $textoElegido = 'Sin responder';
            if ($contestada && ctype_digit($elegida) && isset($datos['opciones'][(int)$elegida])) {
                $textoElegido = $datos['opciones'][(int)$elegida];
            }
            $detalle .= '<div class="revision error"><strong>Pregunta ' . ($numero + 1) . ': incorrecta</strong>';
            $detalle .= '<p>' . htmlspecialchars($datos['pregunta']) . '</p>';
            $detalle .= '<p>Tu respuesta: ' . htmlspecialchars($textoElegido) . '</p>';
            $detalle .= '<p class="solucion">Respuesta correcta: ' . htmlspecialchars($datos['opciones'][$correcta]) . '</p></div>';
        }
    }

    $nota = $total > 0 ? ($aciertos / $total) * 10 : 0;
    echo '<section class="resultados">';
    echo '<h2>Resultado del examen</h2>';
    echo '<div class="estadisticas">';
    echo '<div><span>' . $aciertos . '</span><small>Aciertos</small></div>';
    echo '<div><span>' . $fallos . '</span><small>Fallos</small></div>';
    echo '<div><span>' . number_format($nota, 2, ',', '.') . '/10</span><small>Nota</small></div>';
    echo '</div>';
    echo '<p class="resumen">Has acertado ' . $aciertos . ' de ' . $total . ' preguntas.</p>';
    echo '<h3>Corrección de las preguntas</h3>';
    echo $detalle;
    echo '<a href="index.php" class="boton enlace">Volver a intentarlo</a>';
    echo '</section>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de programación sencillo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main class="contenedor">
        <header class="cabecera">
            <div class="etiqueta">2.º DAW · Programación web</div>
            <h1><span class="simbolo">&lt;/&gt;</span> CodeQuiz</h1>
            <p>¿Sabes programar? Responde a las preguntas y descubre tu nota.</p>
            <div class="info">Una respuesta válida por pregunta · <?php echo count($preguntas); ?> preguntas · Nota sobre 10</div>
        </header>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $respuestas = [];
            if (isset($_POST['respuestas']) && is_array($_POST['respuestas'])) {
                $respuestas = $_POST['respuestas'];
            }
            corregirTest($preguntas, $respuestas);
        } else {
            mostrarPreguntas($preguntas);
        }
        ?>
        <footer>Proyecto de formularios · Desarrollo Web en Entorno Servidor</footer>
    </main>
</body>
</html>
