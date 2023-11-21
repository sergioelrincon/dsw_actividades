<?php
// Inicio de sesión
session_name("tiendaonline");
session_start();

//print_r($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar las credenciales del formulario
    $correo_form = $_POST["correo_electronico"];
    $contrasena_form = $_POST["contrasena"];

    try {
        // Establecer la conexión a la base de datos (reemplazar con tus propios detalles)
        $dsn = "mysql:host=localhost;dbname=ut4";
        $usuario = "dsw";
        $contrasena = "Elrincon1234.";

        $conexion = new PDO($dsn, $usuario, $contrasena);

        // Habilitar el manejo de errores de PDO
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obtener el hash de la contraseña asociada al correo electrónico ingresado
        $consulta = "SELECT contrasena_hash FROM usuarios WHERE correo_electronico = '$correo_form'";
        $resultado = $conexion->query($consulta);

        // Obtener el hash de la contraseña desde la base de datos
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);
        $contrasena_hash_db = $fila['contrasena_hash'];

        // Verificar la contraseña utilizando password_verify()
        if (password_verify($contrasena_form, $contrasena_hash_db)) {
            // La contraseña es correcta, inicio de sesión OK
            echo "Inicio de sesión correcto. Bienvenido, $correo_form!";
            // Almacenamos información del usuario en la sesión
            $_SESSION['correo_electronico'] = $correo_form; 
            $_SESSION['color_favorito'] = "rojo"; 

            // Redirigimos al usuario a otra página después del inicio de sesión
            header("Location: index.php");
            exit();            
        } else {
            // La contraseña es incorrecta
            echo "Contraseña incorrecta. Por favor, inténtalo de nuevo.";
        }
    } catch (PDOException $e) {
        // Error en la conexión o consulta
        echo "Error al conectar con la base de datos: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $conexion = null;
    }
}
?>
