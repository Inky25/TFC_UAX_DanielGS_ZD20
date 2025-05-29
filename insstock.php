<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Stock</title>
    <link rel="icon" href="zonad20.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary">Resultado de la Actualización</h1>
            <p class="text-center">Estado de la operación:</p>
            <div class="alert alert-info" role="alert">
                <?php
                require("conexion.php");

                $codigo = $_POST['producto'];
                $cantidad = intval($_POST['cantidad']);

                // Obtener stock actual y nombre
                $result = $connection->query("SELECT Stock, Nombre FROM Producto WHERE codigo = '$codigo'");
                if ($result && $row = $result->fetch_assoc()) {
                    $stockActual = intval($row['Stock']);
                    $nombreProducto = $row['Nombre'];
                    $nuevoStock = $stockActual + $cantidad;
                
                    // Comprobación de que el stock nuevo sea positivo    
                    if ($nuevoStock < 0) {
                        echo "<p class='text-danger fw-bold'>Error: no se puede restar esa cantidad porque el stock resultante sería negativo. 
                        Stock actual: <strong>$stockActual</strong>, intento de restar: <strong>$cantidad</strong>.</p>";
                    } else {
                        $sql = "UPDATE Producto SET Stock = $nuevoStock WHERE codigo = '$codigo'";
                        if ($connection->query($sql) === TRUE) {
                            echo "<p class='text-success fw-bold'>El stock del producto <strong>$nombreProducto</strong> se actualizó correctamente. 
                            Nuevo stock: <strong>$nuevoStock</strong>.</p>";
                        } else {
                            echo "<p class='text-danger fw-bold'>Error al actualizar el stock del producto.</p>";
                        }
                    }
                } else {
                    echo "<p class='text-danger fw-bold'>Producto no encontrado.</p>";
                }

                $connection->close();
                ?>
            </div>

            <div class="text-center mt-3">
                <a href="stock.php" class="btn btn-primary">Actualizar otro</a>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </div>
    </div>
</body>
</html>