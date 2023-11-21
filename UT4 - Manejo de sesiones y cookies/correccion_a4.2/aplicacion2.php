<?php
phpinfo();

session_name("gestion");
session_start();

if (!isset($_SESSION["correo_electronico"]))
{

    echo "<br>No has iniciado sesión en gestion";

}

?>