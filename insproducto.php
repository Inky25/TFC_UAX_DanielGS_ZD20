<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Producto</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Conexión con Base de Datos Exitosa</h1>
            <p class="text-center">Inserción de Datos:</p>
            <div class="alert alert-info" role="alert">
                <?php
                require("conexion.php");
                $Nombre = $_POST['Nombre'];
                $Descripcion = $_POST['Descripcion'];
                $Stock = $_POST['Stock'];
                $Precio = $_POST['Precio'];
                $IDcategoria = $_POST['IDcategoria'];
                $IDfabricante = $_POST['IDfabricante'];
                $sql = "INSERT INTO producto (Nombre, Descripcion, Stock, Precio, IDcategoria, IDfabricante) VALUES ('".$Nombre."', '".$Descripcion."', '".$Stock."', '".$Precio."', '".$IDcategoria."', '".$IDfabricante."')";
                
                if ($connection->query($sql) === TRUE) {
                    echo "<p class='text-success fw-bold'>Inserción del Producto <strong>$Nombre</strong> correcta.</p>";
                } else {
                    echo "<p class='text-danger fw-bold'>Fallo en la inserción.</p>";
                }
                $connection->close();
                ?>
            </div>

            <div class="text-center mt-3">
                <a href="producto.php" class="btn btn-primary">Añadir otro</a>
            </div>
        </div>
    </div>
                <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
            </div>
</body>
</html>