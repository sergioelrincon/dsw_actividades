<?php


    if (isset($_POST['nombre_campo'])) {
        // El campo ha sido enviado
        echo "<br>Campo 'nombre_campo' enviado";

        $valorCampo = $_POST['nombre_campo'];
    
        // Usando empty()
        if (empty($valorCampo)) {
            // El campo está vacío
            echo "<br>Campo vacío";
        } else {
            // El campo no está vacío
            echo "<br>Campo no vacío";
        }
    
        // O verificación manual
        if ($valorCampo === "") {
            // El campo está vacío
            echo "<br>Campo vacío";
        } else {
            // El campo no está vacío
            echo "<br>Campo no vacío";
        }

        
    }

    if (isset($_POST['campo_no_enviado'])) 
        // El campo ha sido enviado
        echo "<br>Campo 'campo_no_enviado' enviado";
    else
        // El campo no ha sido enviado
        echo "<br>Campo 'campo_no_enviado' no enviado";




?>