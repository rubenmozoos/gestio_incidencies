<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Procesar el formulario de creación de incidencia
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_equipo = $_POST['id_equipo'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_reporte = $_POST['fecha_reporte'];
    $estado = $_POST['estado'];

    // Obtener el ID del trabajador desde la sesión
    $id_trabajador = $_SESSION['id_trabajador'];

    // Insertar la nueva incidencia en la base de datos
    $sql = "INSERT INTO incidencias (id_equipo, titulo_incidencia, descripcion_incidencia, fecha_reporte, estado_incidencia, id_trabajador) 
            VALUES ('$id_equipo', '$titulo', '$descripcion', '$fecha_reporte', '$estado', '$id_trabajador')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Incidencia creada correctamente.";
    } else {
        $error = "Error al crear la incidencia: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (código del encabezado) -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Crear Incidencia</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <?php if (isset($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>
        <form action="crear_incidencia.php" method="post">
            <label for="id_equipo">ID Equipo:</label>
            <input type="text" name="id_equipo" required>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" rows="4" required></textarea>
            <label for="fecha_reporte">Fecha de Reporte:</label>
            <input type="date" name="fecha_reporte" required>
            <label for="estado">Estado:</label>
            <select name="estado" required>
                <option value="abierta">Abierta</option>
                <option value="en_proceso">En Proceso</option>
                <option value="cerrada">Cerrada</option>
            </select>
            <button type="submit">Crear Incidencia</button>
        </form>
        <form action="login.php" method="post">
            <button type="submit">Cerrar Sesión</button>
        </form>

    </div>
</body>
</html>