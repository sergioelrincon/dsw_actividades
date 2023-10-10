<?php
/**
 * Función que devuelve el índice para acceder a la hora correcta del horario en función de una string con formato HH:MM
 * 
 * $hora Contiene la hora en formato HH:MM
 * 
 * Salida: 
 *  Si la hora está fuera del horario lectivo devuelve NO_LECTIVO
 *  Si la hora pertenece al recreo, devuelve RECREO
 */
function generaIndiceHora($hora) {

    if ($hora >= '08:00' && $hora < '08:55')
        return 0;
    elseif (($hora >= '08:55') && ($hora < '09:50'))
        return 1;
    elseif (($hora >= '09:50') && ($hora < '10:45'))
        return 2;
    elseif (($hora >= '10:45') && ($hora < '11:15'))
        return RECREO;
    elseif (($hora >= '11:15') && ($hora < '12:10'))
        return 3;
    elseif (($hora >= '12:10') && ($hora < '13:05'))
        return 4;
    elseif (($hora >= '13:05') && ($hora <= '14:00'))
        return 5;
    else
    {   
        return NO_LECTIVO;
    }

}

?>