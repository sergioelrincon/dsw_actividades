<!DOCTYPE html>
<html>

<head>
    <title>Formulario</title>
</head>

<body>

    <?php

    $archivo_definicion = "estructura_formulario.cfg";
    $file = fopen($archivo_definicion, "r");

    // Leemos la primera línea que contiene los atributos básicos del formulario
    $atributos_formulario = explode(";", fgets($file));
    $action = trim($atributos_formulario[0]);
    $method = trim($atributos_formulario[1]);

    // Declaramos el formulario
    echo "<form action='$action' method='$method' enctype='multipart/form-data'>\n";

    // Leemos el resto del fichero para insertar los campos
    while (($linea = fgets($file)) !== false) {

        $campos = explode(";", $linea);
        $etiqueta = trim($campos[0]);
        $nombre_campo = trim($campos[1]);
        $tipo = trim($campos[2]);

        echo "<br>$etiqueta:";

        // En función del tipo del campo mostramos un código HTML u otro
        if (($tipo == "text") || ($tipo == "file")) {
            echo "<input type='$tipo' name='$nombre_campo'><br>";
        } elseif (($tipo == "radio") || ($tipo == "checkbox")) {
            echo "<br>";
            $valores = explode(",", $campos[3]);
            foreach($valores as $valor) {
                $valor = trim($valor);
                echo "<input type='$tipo' name='$nombre_campo' value='$valor'>$valor<br>";
            }

        }

    }

    // Incluimos el botón de envío
    echo " <input type='submit' value='Enviar'>
        </form>";


    fclose($file);

    ?>

</body>
</html>
