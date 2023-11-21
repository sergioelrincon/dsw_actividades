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

// Obtener las iniciales de la asignatura de la URL
$iniciales = $_GET['iniciales'];

// Obtener los datos de la asignatura de la base de datos
/* PREPARE */
/*
$stmt = $conn->prepare("SELECT * FROM modulos WHERE iniciales = :iniciales");
$stmt->bindParam(':iniciales', $iniciales);
$stmt->execute();
*/

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['boton'])) {
    $nombreCompleto = $_GET['nombre_completo'];
    $descripcion = $_GET['descripcion'];

    if (!empty($nombreCompleto)) {
        /* PREPARE */
        /*
        $updateStmt = $conn->prepare("UPDATE modulos SET nombre_completo = :nombre_completo, descripcion = :descripcion WHERE iniciales = :iniciales");
        $updateStmt->bindParam(':nombre_completo', $nombreCompleto);
        $updateStmt->bindParam(':descripcion', $descripcion);
        $updateStmt->bindParam(':iniciales', $iniciales);
        $updateStmt->execute();
        */

        /* QUERY */
        $updateStmt = $conn->query("UPDATE modulos SET nombre_completo = '$nombreCompleto', descripcion = '$descripcion' WHERE iniciales = '$iniciales'");

        echo "Módulo actualizado correctamente.";
    } else {
        echo "El nombre completo es obligatorio.";
    }
}

/* QUERY */
$stmt = $conn->query("SELECT * FROM modulos WHERE iniciales = '$iniciales'");
$modulo = $stmt->fetch(PDO::FETCH_ASSOC);

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
<form action="edita_modulo.php" method="get">
    Iniciales: <?php echo $modulo['iniciales']; ?><br><br>
    Nombre Completo: <input type="text" size='50' name="nombre_completo" value="<?php echo $modulo['nombre_completo']; ?>" required><br><br>
    Descripción: <textarea cols='50' name="descripcion"><?php echo $modulo['descripcion']; ?></textarea><br><br>
    <input type="hidden" name="iniciales" value="<?php echo $iniciales; ?>">
    <input type="submit" name="boton" value="Actualizar">
</form>

</body>
</html>
