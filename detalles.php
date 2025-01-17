<?php
// detalles.php

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

$id_anunciantes = $_GET["id_anunciantes"];
$sql = "SELECT id_anunciantes, nombre, direccion, manager, telefono, email, nombre_anuncio, cantidad_anuncios, plan, tipo_de_empresa, fecha_inicio, fecha_vencimiento FROM clientes WHERE id_anunciantes = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_anunciantes);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2></h2>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p style='color: white;'>ID: " . $row["id_anunciantes"] . "</p>";
        echo "<p style='color: white;'>NOMBRE: " . $row["nombre"] . "</p>";
        echo "<p style='color: white;'>DIRECCION: " . $row["direccion"] . "</p>";
        echo "<p style='color: white;'>MANAGER: " . $row["manager"] . "</p>";
        echo "<p style='color: white;'>TELEFONO: " . $row["telefono"] . "</p>";
        echo "<p style='color: white;'>EMAIL: " . $row["email"] . "</p>";
        echo "<p style='color: white;'>NOMBRE DEL ANUNCIO:  " . $row["nombre_anuncio"] . "</p>";
        echo "<p style='color: white;'>CANTIDAD DE ANUNCIOS:  " . $row["cantidad_anuncios"] . "</p>";
        echo "<p style='color: white;'>PLAN:  " . $row["plan"] . "</p>";
        echo "<p style='color: white;'>TIPO DE EMPRESA:  " . $row["tipo_de_empresa"] . "</p>";
        echo "<p style='color: white;'>FECHA DE INICIO:  " . $row["fecha_inicio"] . "</p>";
        echo "<p style='color: white;'>FECHA DE VENCIMIENTO:  " . $row["fecha_vencimiento"] . "</p>";
    }
} else {
    echo "No se encontraron detalles";
}

$stmt->close();
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

