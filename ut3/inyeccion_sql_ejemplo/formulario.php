<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Inicio de Sesión</title>
</head>
<body>
    <form action="recibe_formulario.php" method="post">
        <div>
            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        <div>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" required>
        </div>
        <div>
            <button type="submit">Iniciar Sesión</button>
        </div>
    </form>
</body>
</html>
