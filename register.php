<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar el formulario de registro
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    // Hash de la contraseña (asegúrate de usar un método seguro)
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO trabajador (nombre_trabajador, apellido_trabajador, correo_trabajador, telefono_trabajador, contrasenya) 
            VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error al registrar el usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="register.php" method="post">
            <label for="nombre">Nom:</label>
            <input type="text" name="nombre" required>
            <label for="apellido">Cognom:</label>
            <input type="text" name="apellido" required>
            <label for="correo">Correu:</label>
            <input type="email" name="correo" required>
            <label for="telefono">Numero Telefon:</label>
            <input type="text" name="telefono" required>
            <label for="contrasena">Contrasenya:</label>
            <input type="password" name="contrasena" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>Ja tens un compte? <a href="login.php">Iniciar sesió</a></p>
    </div>
</body>
</html>