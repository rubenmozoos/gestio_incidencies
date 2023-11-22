<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si los índices 'username' y 'password' están definidos en $_POST
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($username !== null && $password !== null) {
        // Procesar el formulario de inicio de sesión
        $sql = "SELECT * FROM trabajador WHERE nombre_trabajador='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hash_guardat = $row['contrasenya'];
            $salt = $row['salt'];

            if (password_verify($password . $salt, $hash_guardat)) {
                // Inicio de sesión exitoso
                $_SESSION['username'] = $username;
                $_SESSION['id_trabajador'] = $row['id_trabajador'];

                // Redirige a crear_incidencia.php
                header("Location: crear_incidencia.php");
                exit();
            } else {
                $error = "Nom d'usuari o contrasenya incorrectes";
            }
        }  
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['register'])) {
    // Si se solicita la página de registro
    include 'register.php';
    exit();
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
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="login.php" method="post">
            <label for="username">Nom:</label>
            <input type="text" name="username" required>
            <label for="password">Contrasenya:</label>
            <input type="password" name="password" required>
            <button type="submit">Iniciar sesió</button>
        </form>
        <p>No tens un compte? <a href="login.php?register">REGISTRAT!</a></p>
    </div>
</body>
</html>