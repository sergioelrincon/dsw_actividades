<?php

include("config.php");
include("funciones.php");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Array donde se registrarán los errores de validación
$errores = array();

// Procesa el formulario de edición. El id del producto a modificar se pasa por parámetro, junto a la imagen actual (por si no hay que modificarla)
function procesarFormularioEdicion($pdo, $productoID, $imagen_actual)
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
        $imagen = DIR_UPLOAD.$_FILES["imagen"]["name"];
        $imagen_tmp = $_FILES["imagen"]["tmp_name"];

        // Mover la imagen a la carpeta de destino
        $ruta_destino =  $imagen;
        move_uploaded_file($imagen_tmp, $ruta_destino);
    } else {
        // Si no se selecciona una nueva imagen, mantener la imagen actual
        $imagen = $imagen_actual;
    }

    // Si no hay errores, actualizar en la base de datos
    if (empty($errores)) {
        try {
            $stmt = $pdo->prepare("UPDATE productos SET nombre = ?, precio = ?, imagen = ?, categoria = ? WHERE id = ?");
            $stmt->execute([$nombre, $precio, $imagen, $categoria, $productoID]);

            // Mostrar mensaje de confirmación
            echo "Producto actualizado correctamente. <a href='index.php'>Volver al menú principal</a>";
            exit();
        } catch (PDOException $e) {
            $errores[] = "Error al actualizar el producto en la base de datos: " . $e->getMessage();
        }
    }


    return ($errores);
}

// Si no se proporciona un ID obtenemos la lista de productos para mostrarlos en el desplegable
if (!isset($_GET['id'])) {
    $productos = obtenerProductos($pdo);
    $producto = null;   // La variable $producto tendrá un null cuando no se haya especificado por get el id del producto a editar       
}
else { // Si recibimos ID por Get, cargamos de la BD los datos del producto y procesamos el formulario de edición (en caso de recibirlo)
    $productoID = $_GET['id'];

    // Obtener datos del producto por su ID para mostrarlos en el formulario
    $producto = obtenerProductoPorID($pdo, $productoID); 

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
        $errores = procesarFormularioEdicion($pdo, $productoID, $producto['imagen']);

} 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>

<h1>Editar Producto</h1>

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

<?php if (!$producto): ?>
    <form method="get">
        <label for="id">Seleccione un producto:</label>
        <select name="id" id="id">
            <?php foreach ($productos as $prod): ?>
                <option value="<?php echo $prod['id']; ?>"><?php echo $prod['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Editar">
    </form>
    <hr>
<?php endif; ?>


<form method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $producto['nombre'] ?? ''; ?>" required><br>

    <label for="precio">Precio:</label>
    <input type="text" name="precio" id="precio" value="<?php echo $producto['precio'] ?? ''; ?>" required><br>

    <label for="categoria">Categoría:</label>
    <select name="categoria" id="categoria" required>
        <option value="">Seleccione una categoría</option>
        <?php
        $categorias = obtenerCategorias($pdo);
        foreach ($categorias as $categoria) {
            $selected = ($producto['categoria'] ?? 0) == $categoria['id'] ? 'selected' : '';
            echo "<option value=\"{$categoria['id']}\" $selected>{$categoria['nombre']}</option>";
        }
        ?>
    </select><br>

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" id="imagen"><br>

    <?php if ($producto && !empty($producto['imagen'])): ?>
        <img src="<?php echo $producto['imagen']; ?>" alt="Imagen actual" width="100"><br>
    <?php endif; ?>

    <input type="submit" value="Guardar">
</form>


<?php include("footer.php") ?>
</body>
</html>
