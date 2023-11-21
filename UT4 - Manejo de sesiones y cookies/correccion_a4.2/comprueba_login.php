<?php

    if (!isset($_SESSION["correo_electronico"]))
    {
        header("Location: login_form.php");
    }

?>
