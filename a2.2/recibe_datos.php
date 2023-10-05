<?php

    $nombre_formulario = $_POST["nombre_formulario"];
    $mensaje = "";
    $campos_erroneos = "";

    // Dependiendo del formulario recibido validamos mediante una u otra función
    switch($formulario) {
        case "usuario":
            $validacion = valida_usuario($_POST["nombre_usuario"], $campos_erroneos);
            break;
        case "producto":
            $validacion = valida_producto($_POST["nombre_producto"], $campos_erroneos);
            break;
        default:
            $mensaje = "<h2>Error al recibir los datos del formulario</h2>";
    }

    // En función del resultado de la validación mostramos los datos o un mensaje de error
    if ($validacion)
    {
        $mensaje ="<h2>Datos recibidos y validados correctamente</h2>";
        foreach ($_POST as $clave => $valor)
        {
            if ($clave !== "nombre_formulario")
                echo "<br> - $clave: $valor";
        }
    }
    else
    {
        $mensaje = "<h2>Error al validar los siguientes datos:</h2>"
    }

?>

<html>
    <body>
        <?php echo $mensaje; ?>
    </body>
</html>