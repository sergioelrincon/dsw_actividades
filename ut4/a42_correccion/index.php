<?php
    session_name("tiendaonline");
    session_start();

    include("comprueba_login.php");

    echo "<br>Usuario logueado: ".$_SESSION["correo_electronico"];
?>

<h2>Página de inicio</h2>
<nav class="menu">
  <ul>
    <li><a href="#">Inicio</a></li>
    <li><a href="listado.php">Listado</a></li>
    <li><a href="alta.php">Alta</a></li>
    <li><a href="logout.php">Salir</a></li>
  </ul>
</nav>