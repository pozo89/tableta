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
        }
    </style>
</head>
<body>
    <h1></h1>
    <p></p>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada y Salida de Datos</title>
    <style>
        .container {
            display: flex;
        }
        .input-section, .output-section, .details-section {
            flex: 33%;
            padding: 10px;
        }
    </style>
    <script>
        function mostrarDetalles(url) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("detalles").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    
    <div class="container">
        <div class="input-section">
            <h2 style="color: white;">CLIENTES</h2>
            <?php include 'https://pozo89.github.io/tableta/entrada.php'; ?>
        </div>
        <div class="output-section">
            <h2></h2>
            <div id="salida">
                <?php include 'https://pozo89.github.io/tableta/salida.php'; ?>
            </div>
        </div>
        <div class="details-section">
            <h2 style="color: white;">DETALLES</h2>
            <div id="detalles">
                <p>Seleccione un nombre para ver los detalles</p>
                <?php include 'https://pozo89.github.io/tableta/salida.php'; ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var enlaces = document.querySelectorAll(".output-section a");
            enlaces.forEach(function (enlace) {
                enlace.addEventListener("click", function (event) {
                    event.preventDefault();
                    mostrarDetalles(enlace.href);
                });
            });
        });
    </script>
</body>
</html>
