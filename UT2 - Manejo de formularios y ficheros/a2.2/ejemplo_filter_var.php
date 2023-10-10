<?php

    // Probamos el uso de la función "filter_var" para validar correos electrónicos
    // Definimos las variables con los datos de prueba
    $correo_ok = "micorreo@midominio.com";
    $correo_error1 = "miemail.es@dominio";
    $correo_error2 = "micorreo@dominio.com.";
    $url_ok = "http://www.ieselrincon.es";
    $url_error1 = "http://www.iessselrincon.esss..";

    // Mostramos el resultado del filtrado
    echo "<br>Filtrado correo OK: ";
    var_dump(filter_var($correo_ok, FILTER_VALIDATE_EMAIL));
    echo "<br>Filtrado correo error1: ";
    var_dump(filter_var($correo_error1, FILTER_VALIDATE_EMAIL));
    echo "<br>Filtrado correo error2: ";
    var_dump(filter_var($correo_error2, FILTER_VALIDATE_EMAIL));
    echo "<br>Filtrado url OK: ";
    var_dump(filter_var($url_ok, FILTER_VALIDATE_URL));
    echo "<br>Filtrado url error: ";
    var_dump(filter_var($url_error1, FILTER_VALIDATE_URL));

?>