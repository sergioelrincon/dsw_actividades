<?php

// Valor que deberá estar seleccionado
$array_valores_defecto = array ("color_seleccionado" => "verde");

// Inicializamos las variables a ""
$selected_rojo = $selected_verde = $selected_azul = "";

// En función del valor por defecto, seleccionamos una u otra opción
switch ($array_valores_defecto["color_seleccionado"]) {
    case "rojo":
        $selected_rojo = "selected";
        break;
    case "verde":
        $selected_verde = "selected";
        break;
    case "azul":
        $selected_azul = "selected";
        break;
}


?>

<html>

    <select name="color" multiple>
        <option value="rojo"    <?= $selected_rojo ?>   >Rojo</option>
        <option value="verde"   <?= $selected_verde ?>  >Verde</option>
        <option value="azul"    <?php echo $selected_azul ?>   >Azul</option>
    </select>

</html>