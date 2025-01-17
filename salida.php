<?php
// salida.php

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "base12";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los registros en orden inverso
    
// Obtener los registros en orden inverso
$sql = "SELECT id_anunciantes, nombre, direccion, manager, telefono, email, nombre_anuncio, cantidad_anuncios, plan, fecha_inicio, fecha_vencimiento   FROM clientes ORDER BY id_anunciantes DESC";
$result = $conn->query($sql);

echo "<h2 style='color: white;'>NOMBRE</h2>";

if ($result->num_rows > 0) {
    $first = true; // Variable para identificar el primer registro
    while ($row = $result->fetch_assoc()) {
        if ($first) {
            // Mostrar el primer registro en color rojo
            echo "<p style='color: #ff3c00ea;'><a href='detalles.php?id_anunciantes=" . $row["id_anunciantes"] . "' style='color: #ff3c00ea;'>" . $row["nombre"] .  "</a></p>";
            $first = false;
        } else {
            // Mostrar el resto de los registros en color amarillo
            echo "<p style='color: white;'><a href='detalles.php?id_anunciantes=" . $row["id_anunciantes"] . "' style='color: white;'>" . $row["nombre"] .  "</a></p>";
        }
    }
} else {
    echo "<p style='color: white;'>0 resultados</p>";
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Fondo Azul Fuerte</title>
    <style>
        body {
            background-color: #020230; /* Azul fuerte */
            color: white; /* Texto blanco para contraste */
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h1></h1>
    <p></p>
</body>
</html>




