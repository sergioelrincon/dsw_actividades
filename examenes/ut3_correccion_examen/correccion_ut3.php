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

/**
 * Crea la nueva categoría en la tabla
 */
function nueva_categoria($pdo, $nombreCategoria)
{
    // Generamos un número aleatorio para concatenárselo al nombre recibido por parámetro
    $nombreCategoria = $nombreCategoria . rand(1, 10000);

    // Insertamos la categoría
    $sql = "INSERT INTO categorias(nombre) VALUES ('$nombreCategoria')";
    //echo "<br>".$sql;
    $pdo->exec($sql);

    // Obtenemos el id del registro recién añadido. No era necesario implementarlo de esta forma en el examen, pero es la opción más sencilla
    $nuevoId = $pdo->lastInsertId();

    return $nuevoId;
}

/**
 * Inserta los nuevos tags
 */
function nuevos_tags($pdo, $nombreTag1, $nombreTag2)
{
    // Insertamos en la tabla sin usar "prepare - bindParam" (Riesgo de injección SQL)
    $sql = "INSERT INTO tags(nombre) VALUES ('$nombreTag1')";
    //echo "<br>".$sql;
    $pdo->exec($sql);

    // Obtenemos el mayor valor del id existente en la tabla. No es la forma más elegante pero nos permite resolver el problema planteado
    $sql = "SELECT MAX(id) as max_id FROM tags";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nuevoIdTag1 = $row["max_id"];

    // Insertamos en la tabla sin usar "prepare - bindParam" (Riesgo de injección SQL)
    $sql = "INSERT INTO tags(nombre) VALUES ('$nombreTag2')";
    //echo "<br>".$sql;
    $pdo->exec($sql);
    $nuevoIdTag2 = $pdo->lastInsertId();

    return [$nuevoIdTag1, $nuevoIdTag2];
}

/**
 * Modifica la entrada para asociarle la nueva categoría y los nuevos tags
 */
function modifica_entrada($pdo, $idCategoria, $idTag1, $idTag2)
{
    // Cambiamos la categoría de la entrada
    try {
        $sql = "UPDATE entradasblog SET categoriaid=$idCategoria WHERE id=1";
        //echo "<br>".$sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "<br>".$sql . "<br>" . $e->getMessage();
    }

    // Eliminamos la relación entre la entrada y los tags actuales
    try {
        $sql = "DELETE FROM entradastags WHERE entradaid = 1";
        //echo "<br>".$sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "<br>".$sql . "<br>" . $e->getMessage();
    }

    // Relacionamos la entrada con los dos nuevos tags utilizando prepare - bindParam
    try {
        $sql = "INSERT INTO entradastags (entradaid, tagid) VALUES (1, :idTag1), (1, :idTag2)";
        //echo "<br>".$sql;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idTag1', $idTag1);
        $stmt->bindParam(':idTag2', $idTag2);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "<br>".$sql . "<br>" . $e->getMessage();
    }

    // Cambiamos el título de la entrada
    try {
        $sql = "UPDATE entradasblog SET titulo='entrada modificada' WHERE id=1";
        //echo "<br>".$sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "<br>".$sql . "<br>" . $e->getMessage();
    }
}

// Creamos la nueva categoría
$nuevoIdCategoria = nueva_categoria($pdo, "NuevaCategoria");
echo "<br>La categoría nueva tiene el id $nuevoIdCategoria";

// Creamos los nuevos tags
list($nuevoIdTag1, $nuevoIdTag2) = nuevos_tags($pdo, "Gaming", "IA");
echo "<br>Los nuevos tags tienen los ids $nuevoIdTag1 y $nuevoIdTag2";

// Modificamos la entrada
modifica_entrada($pdo, $nuevoIdCategoria, $nuevoIdTag1, $nuevoIdTag2);

?>