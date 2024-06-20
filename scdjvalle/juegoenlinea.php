<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego Matemático y de Completar Palabras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            margin-top: 50px;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Datos</h2>

        <?php
        // Función para generar una operación matemática y una palabra a completar
        function generarPregunta() {
            $operando1 = rand(1, 10);
            $operando2 = rand(1, 10);

            // Generar un número aleatorio para determinar la operación (1: suma, 2: resta, 3: multiplicación, 4: división)
            $operacion = rand(1, 4);

            switch ($operacion) {
                case 1: // Suma
                    $respuesta = $operando1 + $operando2;
                    $pregunta = "$operando1 + $operando2 = ?";
                    break;
                case 2: // Resta
                    $respuesta = $operando1 - $operando2;
                    $pregunta = "$operando1 - $operando2 = ?";
                    break;
                case 3: // Multiplicación
                    $respuesta = $operando1 * $operando2;
                    $pregunta = "$operando1 * $operando2 = ?";
                    break;
                case 4: // División (asegurando división exacta para simplicidad)
                    $resultado = $operando1 * $operando2;
                    $respuesta = $operando1;
                    $operando1 = $resultado;
                    $pregunta = "$operando1 / $operando2 = ?";
                    break;
            }

            // Palabras a completar
            $palabras = ['elef_', 'perro_', 'gat_', 'manzan_', 'computad_'];
            $palabra = $palabras[array_rand($palabras)];

            return [
                'pregunta' => $pregunta,
                'respuesta' => $respuesta,
                'palabra' => $palabra
            ];
        }

        // Inicialización de variables y generación de la primera pregunta
        $intentos = 0;
        $pregunta = generarPregunta();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar respuesta de la operación matemática
            if (isset($_POST["respuesta_operacion"])) {
                $respuesta_operacion = (int) $_POST["respuesta_operacion"];
                $respuesta_correcta_operacion = $pregunta['respuesta'];

                if ($respuesta_operacion == $respuesta_correcta_operacion) {
                    echo "<p style='color: green;'>¡Respuesta correcta a la operación matemática!</p>";
                    $pregunta = generarPregunta(); // Generar una nueva pregunta
                } else {
                    echo "<p style='color: red;'>Respuesta incorrecta a la operación matemática. Inténtalo de nuevo.</p>";
                }
            }

            // Verificar respuesta para completar la palabra
            if (isset($_POST["respuesta_palabra"])) {
                $respuesta_palabra = strtolower(trim($_POST["respuesta_palabra"]));
                $palabra_completa = str_replace('_', '', $pregunta['palabra']);

                if ($respuesta_palabra == $palabra_completa) {
                    echo "<p style='color: green;'>¡Respuesta correcta al completar la palabra!</p>";
                    $pregunta = generarPregunta(); // Generar una nueva pregunta
                } else {
                    echo "<p style='color: red;'>Respuesta incorrecta al completar la palabra. Inténtalo de nuevo.</p>";
                }
            }

            $intentos++;
        }
        ?>

        <p><?php echo $pregunta['pregunta']; ?></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="respuesta_operacion">Respuesta operación matemática:</label>
            <input type="number" id="respuesta_operacion" name="respuesta_operacion" required>
            <br><br>
            <label for="respuesta_palabra">Completa la palabra <?php echo str_replace('_', '', $pregunta['palabra']); ?>:</label>
            <input type="text" id="respuesta_palabra" name="respuesta_palabra" required>
            <br><br>
            <input type="submit" value="Responder">
        </form>
    </div>
</body>
</html>
