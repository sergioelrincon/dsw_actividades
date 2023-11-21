<?php
include("config.php");
include("funciones.php");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}


// Obtener la lista de productos si no se proporciona un ID
if (!isset($_GET['id'])) {
    $productos = obtenerProductos($pdo);
}
else {
    $productoID = $_GET['id'];
    $producto = obtenerProductoPorID($pdo, $productoID);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        // El usuario ha confirmado la eliminación, proceder a eliminar el producto
        eliminarProductoPorID($pdo, $productoID);
        echo "Producto eliminado correctamente. <a href='index.php'>Volver al menú principal</a>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
</head>
<body>

<h1>Eliminar Producto</h1>

<?php if (isset($productos) && !isset($_GET['id'])): ?>
    <form method="get">
        <label for="id">Seleccione un producto:</label>
        <select name="id" id="id">
            <?php foreach ($productos as $prod): ?>
                <option value="<?php echo $prod['id']; ?>"><?php echo $prod['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Eliminar">
    </form>
<?php endif; ?>

<?php if (isset($producto)): ?>
    <h2>Confirmar eliminación</h2>
    <p>¿Está seguro de que desea eliminar el siguiente producto?</p>
    <ul>
        <li>ID: <?php echo $producto['id']; ?></li>
        <li>Nombre: <?php echo $producto['nombre']; ?></li>
        <li>Precio: <?php echo $producto['precio']; ?></li>
        <li>Categoría: <?php echo $producto['categoria']; ?></li>
        <li>Imagen: <?php echo $producto['imagen']; ?></li>
    </ul>
    <form method="post">
        <input type="hidden" name="confirmar" value="1">
        <input type="submit" value="Confirmar Eliminación">
    </form>
    <a href="index.php">Cancelar</a>
<?php endif; ?>
<?php include("footer.php") ?>
</body>
</html>
