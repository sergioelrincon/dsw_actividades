<?php

// Función para obtener las categorías desde la base de datos
function obtenerCategorias($pdo)
{
    $stmt = $pdo->query("SELECT id, nombre FROM categorias");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todos los productos
function obtenerProductos($pdo)
{
    $stmt = $pdo->query("SELECT id, nombre FROM productos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener un producto por su ID
function obtenerProductoPorID($pdo, $productoID)
{
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$productoID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Función para eliminar un producto por su ID
function eliminarProductoPorID($pdo, $productoID)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->execute([$productoID]);
    } catch (PDOException $e) {
        die("Error al eliminar el producto de la base de datos: " . $e->getMessage());
    }
}
