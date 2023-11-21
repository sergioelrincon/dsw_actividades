
<?php

include("config.php");

// Conexión a la base de datos utilizando PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Obtener todos los productos con información de categoría asociada
$sql = "SELECT productos.id, productos.nombre AS nombre_producto, precio, imagen, categorias.nombre AS nombre_categoria
        FROM productos, categorias
        WHERE productos.categoria = categorias.id";
$stmt = $pdo->query($sql);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>

<h1>Lista de Productos</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Categoría</th>
            <th>Eliminar</th>
            <th>Modificar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto) : ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre_producto']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><img src="<?php echo $producto['imagen']; ?>" width="50"></td>
                <td><?php echo $producto['nombre_categoria']; ?></td>
                <td><a href="editar_producto.php?id=<?php echo $producto['id'] ?>">Editar</a></td>
                <td><a href="eliminar_producto.php?id=<?php echo $producto['id'] ?>">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include("footer.php") ?>
</body>
</html>
