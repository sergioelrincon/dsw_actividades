<?php
    $contrasena = "Aabc1"; // Contraseña de ejemplo

    /**
     * Expresión regular
     * 
     * ^: Indica el inicio de la cadena.
     * [A-Z]: letra mayúscula al comienzo de la cadena.
     * [a-zA-Z0-9]*: cualquier número de letras (mayúsculas o minúsculas) y/o dígitos en el medio de la cadena (cero o más caracteres).
     * [0-9]: Un dígito al final de la cadena.
     * $: Indica el final de la cadena.
     */
    $patron = '/^[A-Z][a-zA-Z0-9]*[0-9]$/';

    if (preg_match($patron, $contrasena)) {
        echo "La contraseña es válida.";
    } else {
        echo "La contraseña no cumple con los criterios.";
    }
?>
