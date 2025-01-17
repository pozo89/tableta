<?php
// entrada.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Función para validar fecha
    function validateDate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    // Obtener y sanitizar datos del formulario
    $id_anunciantes = $conn->real_escape_string($_POST["id_anunciantes"]);
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $direccion = $conn->real_escape_string($_POST["direccion"]);
    $manager = $conn->real_escape_string($_POST["manager"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $nombre_anuncio = $conn->real_escape_string($_POST["nombre_anuncio"]);
    $cantidad_anuncios = $conn->real_escape_string($_POST["cantidad_anuncios"]);
    $plan = $conn->real_escape_string($_POST["plan"]);
    $tipo_de_empresa = $conn->real_escape_string($_POST["tipo_de_empresa"]);
    $fecha_inicio = $conn->real_escape_string($_POST["fecha_inicio"]);
    $fecha_vencimiento = $conn->real_escape_string($_POST["fecha_vencimiento"]);

    // Validar fechas
    if (!validateDate($fecha_inicio) || !validateDate($fecha_vencimiento)) {
        die("<p style='color: white;'>Error: Fecha de inicio o fecha de vencimiento no válida</p>");
    }

    // Preparar y vincular
    $stmt = $conn->prepare("INSERT INTO clientes (id_anunciantes, nombre, direccion, manager, telefono, email, nombre_anuncio, cantidad_anuncios, plan, tipo_de_empresa, fecha_inicio, fecha_vencimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $id_anunciantes, $nombre, $direccion, $manager, $telefono, $email, $nombre_anuncio, $cantidad_anuncios, $plan, $tipo_de_empresa, $fecha_inicio, $fecha_vencimiento);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<p style='color: white;'>Nuevo registro creado exitosamente</p>";
    } else {
        echo "<p style='color: white;'>Error: " . $stmt->error . "</p>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
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
    <!-- Incluir jQuery y jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#fecha_inicio, #fecha_vencimiento").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</head>
<body>
    <h1></h1>
    <p></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="id_anunciantes" style="color: white;">ID:</label>
        <input type="text" name="id_anunciantes" id="id_anunciantes" required>
        <br><br>
        <label for="nombre" style="color: white;">NOMBRE:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br><br>
        <label for="direccion" style="color: white;">DIRECCION:</label>
        <input type="text" name="direccion" id="direccion" required>
        <br><br>
        <label for="manager" style="color: white;">MANAGER:</label>
        <input type="text" name="manager" id="manager" required>
        <br><br>
        <label for="telefono" style="color: white;">TELEFONO:</label>
        <input type="text" name="telefono" id="telefono" required>
        <br><br>
        <label for="email" style="color: white;">EMAIL:</label>
        <input type="text" name="email" id="email" required>
        <br><br>
        <label for="nombre_anuncio" style="color: white;">NOMBRE DEL ANUNCIO:</label>
        <input type="text" name="nombre_anuncio" id="nombre_anuncio" required>
        <br><br>
        <label for="cantidad_anuncios" style="color: white;">CANTIDAD DE ANUNCIOS:</label>
        <input type="text" name="cantidad_anuncios" id="cantidad_anuncios" required>
        <br><br>
        <label for="plan" style="color: white;">PLAN:</label>
        <select name="plan" id="plan" required>
            <option value="Basico">Basico</option>
            <option value="Avanzado">Avanzado</option>
            <option value="Premium">Premium</option>
            <option value="Waow">Waow</option>
        </select>
        <br><br>
        <label for="tipo_de_empresa" style="color: white;">TIPO DE EMPRESA:</label>
        <input type="text" name="tipo_de_empresa" id="tipo_de_empresa" required>
        <br><br>
        <label for="fecha_inicio" style="color: white;">FECHA DE INICIO:</label>
        <input type="text" name="fecha_inicio" id="fecha_inicio" required>
        <br><br>
        <label for="fecha_vencimiento" style="color: white;">FECHA DE VENCIMIENTO:</label>
        <input type="text" name="fecha_vencimiento" id="fecha_vencimiento" required>
        <br><br>
        <input type="submit" name="submit" value="AGREGAR">
    </form>
</body>
</html>
