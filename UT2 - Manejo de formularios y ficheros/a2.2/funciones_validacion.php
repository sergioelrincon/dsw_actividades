<?php

/**
 * Validamos los datos de un producto
 */
function valida_producto($tipo_producto) {
    if (($tipo_producto == "a") or ($tipo_producto == "b"))
        return true;
    else
        return false;

}

/**
 * Validamos los datos de usuario
 */
function valida_usuario($nombre_usuario) {
    if (strlen($nombre_usuario) > 100)
        return false;
    else
        return true;
}


?>