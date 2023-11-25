<?php

// Directorio donde almacenaremos los ficheros (debe estar creada previamente)
$directorio = "./ficheros/";
$datos_formulario = "";

// Recorremos todos los campos
foreach ($_REQUEST as $campo => $valor) {
    $datos_formulario .= "$campo - $valor\n";
}

// Recorremos todos los ficheros
foreach ($_FILES as $campo => $archivo) {
    $nombre_archivo = $archivo["name"];
    
    // Registramos el nombre del campo tipo file y su ubicación
    $datos_formulario .= "$campo - $directorio$nombre_archivo\n";
    // Movemos el fichero
    move_uploaded_file($archivo["tmp_name"], $directorio.$nombre_archivo);
}

$datos_formulario .= "\n";

// Almacenamos toda la información en el fichero
file_put_contents("formulario_recibido.txt", $datos_formulario, FILE_APPEND);

?>