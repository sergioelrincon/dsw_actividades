<?php

include("config.php");
include("funciones.php");

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE, DB_USER, DB_PASSWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Array donde se registrarán los errores de validación
$errores = array();


function procesarFormulario($pdo)
{
    $errores = array();

    // Validar nombre
    $nombre = trim($_POST["nombre"]);
    if (empty($nombre) || strlen($nombre) > 255) {
        $errores[] = "El nombre es obligatorio y no debe exceder los 255 caracteres.";
    }

    // Validar precio
    $precio = trim($_POST["precio"]);
    if (!is_numeric($precio) || $precio <= 0) {
        $errores[] = "El precio debe ser un número positivo.";
    }

    // Validar categoría
    $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : 0;
    if ($categoria <= 0) {
        $errores[] = "Seleccione una categoría válida.";
    }

    // Validar imagen
    if (!empty($_FILES["imagen"]["name"])) {
        $imagen = $_FILES["imagen"]["name"];
        $imagen_tmp = $_FILES["imagen"]["tmp_name"];

        $carpeta_destino = DIR_UPLOAD;

        // Mover la imagen a la carpeta de destino
        $ruta_destino = $carpeta_destino . $imagen;
        //echo "<br>Movemos $imagen_tmp a $ruta_destino";
        move_uploaded_file($imagen_tmp, $ruta_destino);
    } else {
        $errores[] = "Seleccione una imagen.";
    }

    // Si no hay errores, insertar en la base de datos
    if (empty($errores)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, imagen, categoria) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nombre, $precio, DIR_UPLOAD.$imagen, $categoria]);

            // Mostrar mensaje de confirmación
            echo "Registro insertado correctamente. <a href='index.php'>Volver al menú principal</a>";
            exit();
        } catch (PDOException $e) {
            $errores[] = "Error al insertar el registro en la base de datos: " . $e->getMessage();
        }
    }


    return $errores;
}


// Procesamos el formulario si nos lo envían
if ($_SERVER["REQUEST_METHOD"] == "POST")
    $errores = procesarFormulario($pdo);

// Cargamos las categorías de la base de datos para crear el desplegable
$categorias = obtenerCategorias($pdo);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulario de creación de productos</title>
</head>
<body>

<h1>Formulario de creación de productos</h1>

<?php
// Mostrar errores si los hay
if (!empty($errores)) {
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}
?>

<form method="post" action="crear_producto.php" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required><br>

    <label for="precio">Precio:</label>
    <input type="text" name="precio" id="precio" required><br>

    <label for="categoria">Categoría:</label>
    <select name="categoria" id="categoria" required>
        <option value="">Seleccione una categoría</option>
        <?php
        foreach ($categorias as $categoria) {
            echo "<option value='".$categoria['id']."'>{$categoria['nombre']}</option>";
        }
        ?>
    </select><br>

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" id="imagen" required><br>

    <input type="submit" value="Guardar">
</form>
<?php include("footer.php") ?>
</body>
</html>
