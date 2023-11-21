<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "ieselrincon";
$password = "Elrincon123.";
$dbname = "ieselrincon";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

$stmt = $conn->query("SELECT iniciales, nombre_completo FROM modulos");
while ($row = $stmt->fetch()) {
    $modulos[$row['iniciales']] = $row['nombre_completo'];
}


//$modulos = $conn->query("SELECT iniciales, nombre_completo FROM modulos")->fetchAll(PDO::FETCH_COLUMN);
echo "<pre>";
print_r($modulos);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Módulo</title>
</head>
<body>

<h2>Editar Módulo</h2>
<form>
    <select name="modulo"><?php

    foreach($modulos as $clave => $valor) {
        echo "<option value='".$clave."'>".$valor."</option>";
    }

    ?>
    </select>
</form>

</body>
</html>
