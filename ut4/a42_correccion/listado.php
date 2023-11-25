<?php

    session_name("tiendaonline");
    session_start();

    require("comprueba_login.php");

    echo "<br>Usuario logueado: ".$_SESSION["correo_electronico"];

    echo "<h2>Listado</h2>";

?>

<nav class="menu">
  <ul>
    <li><a href="index.php">Inicio</a></li>
    <li><a href="logout.php">Salir</a></li>
  </ul>
</nav>