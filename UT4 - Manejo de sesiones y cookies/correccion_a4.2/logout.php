<?php
session_name("tiendaonline");
session_start();

echo "<br>Salimos...";

// remove all session variables
session_unset();

// destroy the session
session_destroy();

?>

<nav class="menu">
  <ul>
    <li><a href="index.php">Inicio</a></li>
    <li><a href="logout.php">Salir</a></li>
  </ul>
</nav>