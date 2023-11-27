<?php

// Definimos los parámetros de conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'dsw');
define('DB_USERNAME', 'dsw');
define('DB_PASSWORD', 'Elrincon123.');
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

// Conectamos a la base de datos
try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: No se pudo conectar. " . $e->getMessage());
}


$usuario = $_POST['usuario']; // El usuario introduce algo como "sergio' or '1'='1"
$clave = $_POST['clave'];

// Código vulnerable a inyección SQL
/*
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' and clave='$clave'";
echo "<br>El SQL es $sql";
$stmt = $pdo->query($sql);
*/

// Código seguro
$sql = "SELECT * FROM usuarios WHERE usuario = :usuario and clave=:clave";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':clave', $clave);
$stmt->execute();

if ($stmt->rowCount() > 0)
{
    echo "<br>Sesión iniciada";
}
else
{
    echo "<br>Usuario o clave incorrectos";
}

?>