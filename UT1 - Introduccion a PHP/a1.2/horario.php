<?php

include "horario_arrays.php";
include "horario_funciones.php";

define("RECREO", -1);
define("NO_LECTIVO", -2);

print_r($arrayHorario);

$indiceDia = date("N")-1;
$indiceHora = generaIndiceHora("09:00");

echo "\nEl índice del día es $indiceDia";
echo "\nEl índice de la hora es $indiceHora";

if ($indiceHora == RECREO)
    echo "\nEstamos en el recreo";
elseif ($indiceHora == NO_LECTIVO)
    echo "\nEstamos fuera del horario lectivo";
else
    echo "\nAhora se imparte '".$arrayHorario[$indiceDia][$indiceHora]["modulo"]."'";

?>