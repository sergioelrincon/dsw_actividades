<?php

// Inicializamos el array que contiene los periódicos y sus enlaces
$periodicos = [
    "elpais" => "https://elpais.com",
    "elmundo" => "https://elmundo.es",
    "abc" => "https://abc.es",
    "lavanguardia" => "https://lavanguardia.com",
    "elperiodico" => "https://elperiodico.com"
];


// Recibimos por get un periódico a visitar
if (isset($_GET['periodico']) && isset($periodicos[$_GET['periodico']])) {
    $nombrePeriodico = $_GET['periodico'];
    
    // Aumentamos el contador del periódico. Si no existe la cookie, su valor será "1"
    $contador = isset($_COOKIE[$nombrePeriodico]) ? $_COOKIE[$nombrePeriodico] + 1 : 1;

    // Actualizamos la cookie asignándole el valor calculado anteriormente
    setcookie($nombrePeriodico, $contador, time() + 180); // Expira en 3 minutos

    // Redirigimos al usuario a la URL del periódico en el que ha hecho click en la página anterior
    header("Location: " . $periodicos[$nombrePeriodico]);
    exit;
}

// Mostramos los periódicos registrados en el array
$body = "";
foreach ($periodicos as $nombre => $url) {
    // Cargamos el número de accesos. Si no existe la cookie, el número de accesos será 0
    $accesos = isset($_COOKIE[$nombre]) ? $_COOKIE[$nombre] : 0;

    // Mostramos los enlaces junto al número de accesos
    $body .= "<p><a href='?periodico=$nombre'>$nombre</a> - Accesos: $accesos</p>";
}
?>


<html>
    <head>Periódicos</head>
    <body>
        <h1>Enlaces a periódicos</h1>
        <?php echo $body; ?>
    </body>
</html>
